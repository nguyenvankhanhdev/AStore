<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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


        // Get the dates from the request
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');


        // Set default dates if they are missing
        if (!$fromDate || !$toDate) {
            $fromDate = Carbon::now()->startOfMonth();
            $toDate = Carbon::now()->endOfMonth();
        } else {
            // Parse the dates from the input
            $fromDate = Carbon::parse($fromDate);
            $toDate = Carbon::parse($toDate);
        }

        // Fetch products sold between the selected dates
        $productsSold = OrderDetails::with('variantColors.variant.product')
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->selectRaw('variant_color_id, SUM(quantity) as total_sold, SUM(total_price) as total_revenue')
            ->groupBy('variant_color_id')
            ->get();


        $report = $productsSold->map(function ($product) {
            // Tìm variant color dựa trên variant_color_id từ order_details
            $variantColor = VariantColors::with('color', 'variant')->find($product->variant_color_id);

            if (!$variantColor) {
                return [
                    'product_name' => 'Unknown product',
                    'total_sold' => $product->total_sold,
                    'stock' => 0,
                    'revenue' => $product->total_revenue,
                    'profit' => 0,
                    'quantity_imported' => 0, // Nếu không tìm thấy variant color, set số lượng nhập bằng 0
                ];
            }

            // Tìm variant dựa trên variant_id từ bảng product_variants
            $productVariant = $variantColor->variant;

            // Tìm sản phẩm dựa trên pro_id từ bảng product_variants
            $productModel = Products::find($productVariant->pro_id);

            if (!$productModel) {
                return [
                    'product_name' => 'Unknown product',
                    'total_sold' => $product->total_sold,
                    'stock' => 0,
                    'revenue' => $product->total_revenue,
                    'profit' => 0,
                    'quantity_imported' => 0, // Nếu không tìm thấy sản phẩm, set số lượng nhập bằng 0
                ];
            }

            // Lấy chi tiết dung lượng (storage) và màu sắc
            $productName = $productModel->name;
            $variantName = $productVariant->GB; // Chỉ lấy thuộc tính GB
            $colorName = $variantColor->color->name; // Chỉ lấy thuộc tính name của color
            $quantityImported = $variantColor->quantity; // Số lượng nhập từ bảng variant_colors

            return [
                'product_name' => $productName,
                'variant_name' => $variantName,
                'color_name' => $colorName,
                'total_sold' => $product->total_sold,
                'stock' => $productModel->quantity,
                'revenue' => $product->total_revenue,
                'profit' => $product->total_revenue - ($productModel->cost_price * $product->total_sold),
                'quantity_imported' => $quantityImported, // Thêm số lượng nhập vào kết quả trả về
            ];
        });
        // Return the view with the report data
        return view('backend.admin.reports.index', compact('report', 'fromDate', 'toDate'));
    }
}
