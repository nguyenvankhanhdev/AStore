<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WarehouseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\VariantColors;
use App\Models\Warehouse;
use App\Models\WarehouseDetails;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(WarehouseDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.warehouse.index');
    }


    public function createImport()
    {
        $variantColors = VariantColors::with([
            'variant.product',
            'variant.storage',
            'color'
        ])->get();
        $products = Products::all();
        $warehouses = Warehouse::all();
        $nextWarehouseId = Warehouse::max('id') + 1;

        return view('backend.admin.warehouse.import', compact('warehouses', 'variantColors', 'products', 'nextWarehouseId'));
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.variant_color_id' => 'required|exists:variant_colors,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.warehouse_price' => 'required|numeric|min:1',
        ]);

        // Tính tổng số mặt hàng
        $totalItems = count($request->products);

        // Tạo phiếu nhập mới (warehouse)
        $warehouse = Warehouse::create([
            'import_date' => now(),
            'total_quantity' => $totalItems, // Số mặt hàng
            'total_price' => 0, // Khởi tạo total_price là 0, sẽ tính sau
        ]);

        //logger("Warehouse Created: ", $warehouse->toArray());

        $totalPrice = 0; // Biến để tính tổng tiền của tất cả sản phẩm

        // Lưu danh sách sản phẩm vào WarehouseDetails
        foreach ($request->products as $product) {

            //logger("Product Data: ", $product);

            $productTotalPrice = ($product['quantity'] * $product['warehouse_price']);
            $totalPrice += $productTotalPrice; // Cộng tổng tiền của sản phẩm vào biến tổng
            //logger("Calculated Total Price: $productTotalPrice for Variant Color ID: {$product['variant_color_id']}");

            WarehouseDetails::create([
                'warehouse_id' => $warehouse->id,
                'variant_color_id' => $product['variant_color_id'],
                'quantity' => $product['quantity'],
                'warehouse_price' => $product['warehouse_price'],
                'total_price' => $productTotalPrice,
            ]);
        }

        // Cập nhật tổng tiền cho phiếu nhập kho (warehouse)
        $warehouse->update([
            'total_price' => $totalPrice,
        ]);
        //Cập nhật số lượng trong vâriant color
        $variantColor = VariantColors::find($product['variant_color_id']);
        if ($variantColor) {
            $variantColor->quantity += $product['quantity'];
            $variantColor->save();
        }
        return redirect()->route('admin.warehouse')->with('success', 'Phiếu nhập kho đã được lưu thành công!');
    }
}
