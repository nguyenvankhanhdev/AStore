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
                    'inventory_value' => 0,
                    'new_imports' => 0,
                ];
            }

            $productVariant = $variantColor->variant;
            $productModel = Products::find($productVariant->pro_id);

            if (!$productModel) {
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
                    'inventory_value' => 0,
                    'new_imports' => 0,
                ];
            }

            $productName = $productModel->name;
            $variantName = $productVariant->storage->GB;
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

            // Tính số lượng tồn kho cuối cùng sau khi bán hàng trong tháng
            $totalSold = $product->total_sold;
            $remainingStock = $previousStock + $newImports - $totalSold;

            // Lấy giá nhập kho trung bình
            $warehousePrice = WarehouseDetails::where('variant_color_id', $variantColor->id)
                ->whereHas('warehouse', function ($query) use ($toDate) {
                    $query->whereDate('import_date', '<=', $toDate);
                })
                ->avg('warehouse_price');

            $originalPrice = $variantColor->price; // Lấy giá gốc từ cột price
            $discountedPrice = $originalPrice - $variantColor->offer_price; // Tính giá bán sau khi giảm giá

            // Tính lợi nhuận và giá trị tồn kho
            $revenue = $totalSold * $discountedPrice;
            $profit = ($discountedPrice * $totalSold) - ($warehousePrice * $totalSold);
            $inventoryValue = $remainingStock * $warehousePrice;

            return [
                'product_name' => $productName,
                'variant_name' => $variantName,
                'color_name' => $colorName,
                'total_sold' => $totalSold,
                'quantity_imported' => $newImports,
                'stock' => $remainingStock,
                'revenue' => $revenue,
                'profit' => $profit,
                'inventory_value' => $inventoryValue,
                'warehouse_price' => $warehousePrice,
                'price' => $originalPrice, // Đảm bảo giá gốc được trả về
                'offer_price' => $variantColor->offer_price,
                'new_imports' => $newImports,
            ];
        });

        // Tính tổng các giá trị cho toàn bộ báo cáo
        $totalQuantityImported = $report->sum('quantity_imported');
        $totalSold = $report->sum('total_sold');
        $totalInventoryValue = $report->sum('inventory_value');
        $totalRevenue = $report->sum('revenue');
        $totalProfit = $report->sum('profit');

        // Trả dữ liệu về view
        return view('backend.admin.reports.index', compact(
            'report',
            'totalQuantityImported',
            'totalSold',
            'totalInventoryValue',
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

        // Lấy danh sách các danh mục đã có sản phẩm bán trong khoảng thời gian
        $categoriesSold = OrderDetails::with('variantColors.variant.product.category')
            ->whereDate('order_details.created_at', '>=', $fromDate)
            ->whereDate('order_details.created_at', '<=', $toDate)
            ->selectRaw('products.cate_id as category_id, SUM(order_details.quantity) as total_sold, SUM(order_details.quantity * order_details.total_price) as total_revenue')
            ->join('variant_colors', 'order_details.variant_color_id', '=', 'variant_colors.id')
            ->join('product_variants', 'variant_colors.variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.pro_id', '=', 'products.id')
            ->groupBy('products.cate_id')
            ->get();

        // Tính toán doanh thu và lợi nhuận cho từng danh mục
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

            // Tính tổng chi phí dựa trên số lượng thực tế trong order_details và giá nhập kho từ warehouse_details trong khoảng thời gian
            $totalCost = OrderDetails::whereHas('variantColors.variant.product', function ($query) use ($categoryData) {
                $query->where('products.cate_id', $categoryData->category_id);
            })
                ->whereDate('order_details.created_at', '>=', $fromDate)
                ->whereDate('order_details.created_at', '<=', $toDate)
                ->with('variantColors')
                ->get()
                ->groupBy('variant_color_id') // Nhóm theo variant_color_id để tránh tính trùng lặp
                ->sum(function ($orderDetails) {
                    $orderDetail = $orderDetails->first(); // Lấy một bản ghi đại diện cho nhóm
                    $warehouseDetails = WarehouseDetails::where('variant_color_id', $orderDetail->variant_color_id)->first();
                    if (!$warehouseDetails) {
                        Log::warning("Không tìm thấy giá nhập kho cho variant_color_id: " . $orderDetail->variant_color_id);
                        return 0;
                    }
                    $costPrice = $warehouseDetails->warehouse_price;
                    $quantitySold = $orderDetails->sum('quantity'); // Tính tổng số lượng bán ra của nhóm

                    // echo "Variant Color ID: {$orderDetail->variant_color_id}, ";
                    // echo "Cost Price: {$costPrice}, ";
                    // echo "Quantity Sold: {$quantitySold}, ";
                    // echo "Total Cost for this variant color: " . ($costPrice * $quantitySold) . "<br>";

                    return $costPrice * $quantitySold;
                });

            $totalQuantityImported = WarehouseDetails::whereHas('variantColor.variant.product', function ($query) use ($category) {
                $query->where('products.cate_id', $category->id);
            })->sum('quantity');


            // echo "Category: {$category->name}, ";
            // echo "Total Revenue: {$categoryData->total_revenue}, ";
            // echo "Total Cost: {$totalCost}, ";
            // echo "Profit: " . ($categoryData->total_revenue - $totalCost) . "<br>";

            return [
                'category_name' => $category->name,
                'total_sold' => $categoryData->total_sold,
                'revenue' => $categoryData->total_revenue,
                'profit' => $categoryData->total_revenue - $totalCost, // Lợi nhuận là doanh thu trừ đi tổng chi phí
                'quantity_imported' => $totalQuantityImported,
            ];
        });

        // Tính tổng cộng cho các cột
        $totalQuantityImported = $report->sum('quantity_imported');
        $totalSold = $report->sum('total_sold');
        $totalRevenue = $report->sum('revenue');
        $totalProfit = $report->sum('profit');


        // echo "Total Quantity Imported: {$totalQuantityImported}, ";
        // echo "Total Sold: {$totalSold}, ";
        // echo "Total Revenue: {$totalRevenue}, ";
        // echo "Total Profit: {$totalProfit}<br>";

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
