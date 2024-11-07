<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\VariantColors;
use App\Models\WarehouseDetails;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if (!$fromDate || !$toDate) {
            $fromDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $toDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        } else {
            $fromDate = Carbon::parse($fromDate)->format('Y-m-d');
            $toDate = Carbon::parse($toDate)->format('Y-m-d');
        }

        // Lấy sản phẩm đã bán trong khoảng thời gian đó
        $productsSold = OrderDetails::with('variantColors.variant.product')
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->selectRaw('variant_color_id, SUM(quantity) as total_sold, SUM(total_price) as total_revenue')
            ->groupBy('variant_color_id')
            ->get();

        $report = $productsSold->map(function ($product) use ($fromDate, $toDate) {
            $variantColor = VariantColors::with('color', 'variant.storage')->find($product->variant_color_id);

            if (!$variantColor) {
                return [
                    'product_name' => 'Unknown product',
                    'variant_name' => 'N/A',
                    'color_name' => 'N/A',
                    'total_sold' => $product->total_sold,
                    'stock' => 0,
                    'revenue' => 0,
                    'profit' => 0,
                    'quantity_imported' => 0,
                    'warehouse_price' => 0,
                    'price' => 0,
                    'offer_price' => 0,
                    'total_import_cost' => 0,
                    'new_imports' => 0,
                    'remaining_cost' => 0
                ];
            }

            $productName = $variantColor->variant->product->name;
            $variantName = $variantColor->variant->storage->GB;
            $colorName = $variantColor->color->name;

            // Tính tồn kho từ các tháng trước
            $previousStock = WarehouseDetails::where('variant_color_id', $variantColor->id)
                ->whereHas('warehouse', function ($query) use ($fromDate) {
                    $query->whereDate('import_date', '<', $fromDate);
                })
                ->sum('quantity') - OrderDetails::where('variant_color_id', $variantColor->id)
                ->whereDate('created_at', '<', $fromDate)
                ->sum('quantity');

            // Lấy số lượng nhập kho trong tháng hiện tại
            $newImports = WarehouseDetails::where('variant_color_id', $variantColor->id)
                ->whereHas('warehouse', function ($query) use ($fromDate, $toDate) {
                    $query->whereBetween('import_date', [$fromDate, $toDate]);
                })
                ->sum('quantity');

            // Tổng số lượng cần xuất kho (tổng số lượng đã bán)
            $totalSold = $product->total_sold;

            // Lấy danh sách các lô hàng nhập theo thứ tự FIFO (ngày nhập sớm nhất trước)
            $fifoEntries = WarehouseDetails::where('variant_color_id', $variantColor->id)
                ->join('warehouses', 'warehouse_details.warehouse_id', '=', 'warehouses.id')
                ->whereDate('warehouses.import_date', '<=', $toDate)
                ->orderBy('warehouses.import_date', 'asc')
                ->select('warehouse_details.*', 'warehouses.import_date')
                ->get();


            // Nếu không có nhập kho mới trong tháng hiện tại, lấy giá nhập từ lô hàng tồn cuối cùng của tháng trước
            if ($newImports == 0 && $previousStock > 0) {
                $lastStockEntry = $fifoEntries->filter(function ($entry) use ($fromDate) {
                    return $entry->import_date < $fromDate;
                })->last(); // Lấy lô cuối cùng từ tháng trước

                if ($lastStockEntry) {
                    $fifoEntries = collect([$lastStockEntry]); // Chỉ sử dụng lô cuối cùng từ tháng trước
                }
            }

            // Tính chi phí nhập kho theo phương pháp FIFO cho sản phẩm đã bán
            $remainingQuantityToSell = $totalSold;
            $fifoCost = 0;

            foreach ($fifoEntries as $entry) {
                if ($remainingQuantityToSell <= 0) {
                    break;
                }

                if ($entry->quantity <= $remainingQuantityToSell) {
                    $fifoCost += $entry->quantity * $entry->warehouse_price;
                    $remainingQuantityToSell -= $entry->quantity;
                } else {
                    $fifoCost += $remainingQuantityToSell * $entry->warehouse_price;
                    $remainingQuantityToSell = 0;
                }
            }
            // Tính số lượng tồn kho cuối cùng sau khi bán hàng trong tháng
            $remainingStock = $previousStock + $newImports - $totalSold;

            // Giá gốc và giá bán sau khi giảm giá
            $originalPrice = $variantColor->price;
            $discountedPrice = $originalPrice - $variantColor->offer_price;

            // Doanh thu và lợi nhuận
            $revenue = $totalSold * $discountedPrice;
            $profit = $revenue - $fifoCost;

            return [
                'product_name' => $productName,
                'variant_name' => $variantName,
                'color_name' => $colorName,
                'total_sold' => $totalSold,
                'quantity_imported' => $newImports,
                'stock' => $remainingStock,
                'revenue' => $revenue,
                'profit' => $profit,
                'fifo_cost' => $fifoCost,
                'warehouse_price' => $fifoCost / max($totalSold, 1),
                'price' => $originalPrice,
                'offer_price' => $variantColor->offer_price,
                'new_imports' => $newImports,
            ];
        });

        // Tính tổng các giá trị cho toàn bộ báo cáo
        $totalQuantityImported = $report->sum('quantity_imported');
        $totalSold = $report->sum('total_sold');
        $totalFifoCost = $report->sum('fifo_cost');
        $totalRevenue = $report->sum('revenue');
        $totalProfit = $report->sum('profit');

        // Trả dữ liệu về view
        return view('backend.admin.reports.index', compact(
            'report',
            'totalQuantityImported',
            'totalSold',
            'totalFifoCost',
            'totalRevenue',
            'totalProfit',
            'fromDate',
            'toDate'
        ));
    }

    public function reportByCategory(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if (!$fromDate || !$toDate) {
            $fromDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $toDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        } else {
            $fromDate = Carbon::parse($fromDate)->format('Y-m-d');
            $toDate = Carbon::parse($toDate)->format('Y-m-d');
        }

        $categoriesSold = OrderDetails::with(['variantColors'])
            ->whereDate('order_details.created_at', '>=', $fromDate)
            ->whereDate('order_details.created_at', '<=', $toDate)
            ->selectRaw('products.cate_id as category_id, SUM(order_details.quantity) as total_sold, SUM(order_details.quantity * order_details.total_price) as total_revenue')
            ->join('variant_colors', 'order_details.variant_color_id', '=', 'variant_colors.id')
            ->join('product_variants', 'variant_colors.variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.pro_id', '=', 'products.id')
            ->groupBy('products.cate_id')
            ->get();

        $report = $categoriesSold->map(function ($categoryData) use ($fromDate, $toDate) {
            $category = Categories::find($categoryData->category_id);

            if (!$category) {
                return [
                    'category_name' => 'Unknown Category',
                    'total_sold' => $categoryData->total_sold,
                    'revenue' => $categoryData->total_revenue,
                    'profit' => 0,
                    'quantity_imported' => 0,
                ];
            }

            $totalCost = OrderDetails::whereHas('variantColors.variant.product', function ($query) use ($categoryData) {
                $query->where('products.cate_id', $categoryData->category_id);
            })
                ->whereDate('order_details.created_at', '>=', $fromDate)
                ->whereDate('order_details.created_at', '<=', $toDate)
                ->with('variantColors')
                ->get()
                ->sum(function ($orderDetail) use ($fromDate, $toDate) {
                    $totalCostForOrder = 0;
                    $remainingQuantityToSell = $orderDetail->quantity;

                    // Bước 1: Kiểm tra lô hàng tồn kho cuối cùng từ tháng trước
                    // Bước 1: Kiểm tra lô hàng tồn kho cuối cùng từ tháng trước
                    $lastStockEntry = WarehouseDetails::where('variant_color_id', $orderDetail->variant_color_id)
                        ->join('warehouses', 'warehouse_details.warehouse_id', '=', 'warehouses.id')
                        ->whereDate('warehouses.import_date', '<', $fromDate)
                        ->orderBy('warehouses.import_date', 'desc')
                        ->orderBy('warehouse_details.id', 'desc') // Sắp xếp thêm theo ID để lấy lô nhập cuối cùng
                        ->select('warehouse_details.*', 'warehouses.import_date')
                        ->first();



                    // Bước 2: Lấy danh sách FIFO của lô hàng nhập từ đầu đến cuối tháng hiện tại
                    $fifoEntries = WarehouseDetails::where('variant_color_id', $orderDetail->variant_color_id)
                        ->join('warehouses', 'warehouse_details.warehouse_id', '=', 'warehouses.id')
                        ->whereDate('warehouses.import_date', '<=', $toDate)
                        ->orderBy('warehouses.import_date', 'asc')
                        ->select('warehouse_details.*', 'warehouses.import_date')
                        ->get();


                    // Nếu không có lô hàng trong tháng hiện tại, sử dụng lô hàng cuối từ tháng trước
                    if ($fifoEntries->isEmpty() && $lastStockEntry) {
                        $fifoEntries = collect([$lastStockEntry]);
                    } elseif ($lastStockEntry) {
                        // Nếu có lô hàng trong tháng, thêm lô cuối của tháng trước vào đầu danh sách
                        $fifoEntries->prepend($lastStockEntry);
                    }

                    foreach ($fifoEntries as $entry) {
                        if ($remainingQuantityToSell <= 0) {
                            break;
                        }

                        if ($entry->quantity <= $remainingQuantityToSell) {
                            $costForThisEntry = $entry->quantity * $entry->warehouse_price;
                            $totalCostForOrder += $costForThisEntry;
                            $remainingQuantityToSell -= $entry->quantity;
                        } else {
                            $costForThisEntry = $remainingQuantityToSell * $entry->warehouse_price;
                            $totalCostForOrder += $costForThisEntry;
                            $remainingQuantityToSell = 0;
                        }
                    }

                    return $totalCostForOrder;
                });

            $totalQuantityImported = WarehouseDetails::whereHas('variantColor.variant.product', function ($query) use ($category) {
                $query->where('products.cate_id', $category->id);
            })
                ->whereDate('created_at', '>=', $fromDate)
                ->whereDate('created_at', '<=', $toDate)
                ->sum('quantity');

            $profit = $categoryData->total_revenue - $totalCost;

            return [
                'category_name' => $category->name,
                'total_sold' => $categoryData->total_sold,
                'revenue' => $categoryData->total_revenue,
                'profit' => $profit,
                'quantity_imported' => $totalQuantityImported,
            ];
        });

        $totalQuantityImported = $report->sum('quantity_imported');
        $totalSold = $report->sum('total_sold');
        $totalRevenue = $report->sum('revenue');
        $totalProfit = $report->sum('profit');

        return view('backend.admin.reports.byCategory', compact(
            'report',
            'totalQuantityImported',
            'totalSold',
            'totalRevenue',
            'totalProfit',
            'fromDate',
            'toDate'
        ));
    }
}
