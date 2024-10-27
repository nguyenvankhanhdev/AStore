<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\VariantColors;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $productsSold = OrderDetails::with('variantColors.variant.product')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->selectRaw('variant_color_id, SUM(quantity) as total_sold, SUM(total_price) as total_revenue')
            ->groupBy('variant_color_id')
            ->get();

        $report = $productsSold->map(function ($product) {
            // Find variant color by variant_color_id from order_details
            $variantColor = VariantColors::with('color', 'variant')->find($product->variant_color_id);

            if (!$variantColor) {
                return [
                    'product_name' => 'Unknown product',
                    'total_sold' => $product->total_sold,
                    'stock' => 0,
                    'revenue' => 0,
                    'profit' => 0,
                    'quantity_imported' => 0,
                    'warehouse_price' => 0,
                    'offer_price' => 0,
                    'inventory_value' => 0,
                ];
            }

            // Get product details
            $productVariant = $variantColor->variant;
            $productModel = Products::find($productVariant->pro_id);

            if (!$productModel) {
                return [
                    'product_name' => 'Unknown product',
                    'total_sold' => $product->total_sold,
                    'stock' => 0,
                    'revenue' => 0,
                    'profit' => 0,
                    'quantity_imported' => 0,
                    'warehouse_price' => 0,
                    'offer_price' => 0,
                    'inventory_value' => 0,
                ];
            }

            // Extract product details including warehouse price and offer price
            $productName = $productModel->name;
            $variantName = $productVariant->GB;
            $colorName = $variantColor->color->name;
            $quantityImported = $variantColor->quantity; // Số lượng nhập
            $warehousePrice = $variantColor->warehouse_price; // Giá nhập kho
            $offerPrice = $variantColor->offer_price; // Giá bán
            $totalSold = $product->total_sold; // Số lượng đã bán
            $remainingStock = $quantityImported - $totalSold; // Số lượng tồn kho

            // Calculate profit based on quantity sold
            $profit = ($offerPrice * $totalSold) - ($warehousePrice * $totalSold);

            // Calculate inventory value (remaining stock * warehouse price)
            $inventoryValue = $remainingStock * $warehousePrice;

            return [
                'product_name' => $productName,
                'variant_name' => $variantName,
                'color_name' => $colorName,
                'total_sold' => $totalSold,
                'quantity_imported' => $quantityImported,
                'stock' => $remainingStock,
                'revenue' => $totalSold * $offerPrice, // Revenue from sold items
                'profit' => $profit, // Profit from sold items
                'inventory_value' => $inventoryValue, // Inventory value of remaining stock
                'warehouse_price' => $warehousePrice,
                'offer_price' => $offerPrice,
            ];
        });

        $totalQuantityImported = $report->sum('quantity_imported');
        $totalSold = $report->sum('total_sold');
        $totalInventoryValue = $report->sum('inventory_value');
        $totalRevenue = $report->sum('revenue');
        $totalProfit = $report->sum('profit');


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

        $categoriesSold = OrderDetails::with('variantColors.variant.product.category')
            ->whereBetween('order_details.created_at', [$fromDate, $toDate])
            ->selectRaw('products.cate_id as category_id, SUM(order_details.quantity) as total_sold, SUM(order_details.total_price) as total_revenue')
            ->join('variant_colors', 'order_details.variant_color_id', '=', 'variant_colors.id')
            ->join('product_variants', 'variant_colors.variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.pro_id', '=', 'products.id')
            ->groupBy('products.cate_id')
            ->get();

        // Tính toán doanh thu và lợi nhuận cho từng danh mục
        $report = $categoriesSold->map(function ($categoryData) {
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

            // Tính tổng chi phí của tất cả sản phẩm trong danh mục
            $productsInCategory = Products::where('cate_id', $category->id)->get();
            $totalCost = $productsInCategory->sum(function ($product) {
                $totalSoldQuantity = OrderDetails::whereHas('variantColors.variant.product', function ($query) use ($product) {
                    $query->where('products.id', $product->id);
                })->sum('quantity');

                return $product->cost_price * $totalSoldQuantity;
            });

            $totalQuantityImported = $productsInCategory->sum('quantity');

            return [
                'category_name' => $category->name,
                'total_sold' => $categoryData->total_sold,
                'revenue' => $categoryData->total_revenue,
                'profit' => $categoryData->total_revenue - $totalCost,
                'quantity_imported' => $totalQuantityImported,
            ];
        });

        // Tính tổng cộng cho các cột
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
