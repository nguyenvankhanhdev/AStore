<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\ColorProduct;
use App\Models\StorageProduct;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        $product = Products::findOrFail($request->product);
        return $dataTable->render('backend.admin.product.product_variant.index', compact('product'));
    }

    public function create(Request $request)
    {
        $colors = ColorProduct::all();
        $storages = StorageProduct::all();
        $product = Products::findOrFail($request->product);
        return view('backend.admin.product.product_variant.create', compact('colors', 'storages', 'product'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'quantity' => ['required'],
            'price' => ['required'],
            'offer_price' => ['required'],
            'color' => ['required'],
            'storage' => ['required'],
        ]);
        $variant = new ProductVariant();
        $variant->quantity = $request->quantity;
        $variant->price = $request->price;
        $variant->offer_price = $request->offer_price;
        $variant->color_id = $request->color;
        $variant->storage_id = $request->storage;
        $variant->pro_id = $request->product;
        $variant->save();
        return redirect()->route('admin.products-variant.index',['product'=> $request->product])->with('success', 'Product Variant created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();
        return response(['status' => 'success','message'=> 'Deleted Successfully!']);
    }
}
