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
        $storages = StorageProduct::all();
        $product = Products::findOrFail($request->product);
        return view('backend.admin.product.product_variant.create', compact('storages', 'product'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'storage' => ['required'],
        ]);
        $variant = new ProductVariant();
        $variant->storage_id = $request->storage;
        $variant->pro_id = $request->product;
        $variant->save();
        return redirect()->route('admin.products-variant.index', ['product' => $request->product])->with('success', 'Product Variant created successfully');
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
        $variant = ProductVariant::findOrFail($id);
        $storages = StorageProduct::all();
        return view('backend.admin.product.product_variant.edit', compact('variant', 'storages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'storage' => ['required', 'exists:storage_products,id'],
        ]);

        $variant = ProductVariant::findOrFail($id);
        $variant->storage_id = $request->storage;
        $variant->save();

        return redirect()->route('admin.products-variant.index', ['product' => $variant->pro_id])->with('success', 'Product Variant updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
