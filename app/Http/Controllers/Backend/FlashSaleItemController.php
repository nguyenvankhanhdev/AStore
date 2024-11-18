<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSaleItem;
use App\Models\FlashSales;
use App\Models\SubCategories;
use App\DataTables\FlashSaleItemDataTable;

class FlashSaleItemController extends Controller
{
    public function index(Request $request, FlashSaleItemDataTable $dataTable)
    {
        $flashSaleDate = FlashSales::findOrFail($request->flashsale);
        $categories = SubCategories::all();
        return $dataTable->render('backend.admin.flash-sales.flash-sale-item', compact('flashSaleDate', 'categories'));

    }

    public function addCategories(Request $request)
    {
        $request->validate([
            'categories' => ['required', 'unique:flash_sale_items,sub_categories_id'],
            'offer_price' => ['required'],
            'status' => ['required'],
        ],[
            'categories.unique' => 'The product is already in flash sale!'
        ]);

        $flashSaleItem = new FlashSaleItem();
        $flashSaleItem->sub_categories_id = $request->categories;
        $flashSaleItem->offer_price = $request->offer_price;
        $flashSaleItem->flash_sale_id = $request->flash_sale_id;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();
        return redirect()->back()->withSuccess('Thêm thành công!');

    }

    public function destroy(string $id)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($id);
        $flashSaleItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
    public function changeStatus(Request $request)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->status = $request->status == 'true' ? 1 : 0;
        $flashSaleItem->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function chageShowAtHomeStatus(Request $request)
    {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->show_at_home = $request->status == 'true' ? 1 : 0;
        $flashSaleItem->save();

        return response(['message' => 'Status has been updated!']);
    }

}
