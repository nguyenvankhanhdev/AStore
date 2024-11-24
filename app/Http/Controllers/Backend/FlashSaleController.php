<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\FlashSaleItem;
use App\DataTables\FlashSalesDataTable;
use App\Models\FlashSales;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FlashSalesDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.flash-sales.index');
    }
    public function create()
    {
        return view('backend.admin.flash-sales.create');
    }
    public function store(Request $request) {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $flashSale = new FlashSales();
        $flashSale->start_date = $request->start_date;
        $flashSale->end_date = $request->end_date;
        $flashSale->status = 0;
        $flashSale->save();
        return redirect()->route('admin.flash-sale.index')->withSuccess('Tạo mới thành công!');

    }
    public function show($id) {}
    public function edit($id) {
        $flashSale = FlashSales::findOrFail($id);
        return view('backend.admin.flash-sales.edit', compact('flashSale'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $flashSale = FlashSales::findOrFail($id);
        $flashSale->start_date = $request->start_date;
        $flashSale->end_date = $request->end_date;
        $flashSale->status = 0;
        $flashSale->save();

        return redirect()->route('admin.flash-sale.index')->withSuccess('Cập nhật thành công!');

    }
    public function destroy($id) {
        $flashSale = FlashSales::findOrFail($id);
        $flashSale->delete();
        return response()->json(['status' => 'success', 'message' => 'Xóa thành công!']);
    }

    public function changeStatus(Request $request)
    {
        $flashSale = FlashSales::findOrFail($request->id);
        $flashSale->status = $request->status == 'true' ? 1 : 0;
        $currentDate = Carbon::now();
        if( $flashSale->start_date > $currentDate || $flashSale->end_date < $currentDate){
            return response()->json(['status' => 'error', 'message' => 'Flash sale is not active!']);
        }

        if ($flashSale->status == 1 && $flashSale->start_date <= $currentDate && $flashSale->end_date >= $currentDate) {
            $this->updateFlashSaleItems($flashSale->id, 'sale_product', true);
            $flashSale->save();
            return response()->json(['status' => 'success', 'message' => 'Status has been updated!']);
        }

        if ($flashSale->status == 0) {
            $this->updateFlashSaleItems($flashSale->id, 'best_product', false);
            $flashSale->save();
            return response()->json(['status' => 'success', 'message' => 'Status has been updated!']);
        }
    }

    private function updateFlashSaleItems($flashSaleId, $productType, $isAdding)
    {
        $flashSaleItems = FlashSaleItem::where('flash_sale_id', $flashSaleId)->get();

        foreach ($flashSaleItems as $item) {
            $offerPrice = $item->offer_price;
            if ($item->subcategories && $item->subcategories->products) {
                foreach ($item->subcategories->products as $product) {
                    $product->update(['product_type' => $productType]);

                    foreach ($product->variants as $variant) {
                        foreach ($variant->variantColors as $variantColor) {
                            $productPrice = $variantColor->offer_price;
                            $finalPrice = $isAdding ? $productPrice + $offerPrice : $productPrice - $offerPrice;
                            $variantColor->update(['offer_price' => $finalPrice]);
                        }
                    }
                }
            }
        }
    }
}
