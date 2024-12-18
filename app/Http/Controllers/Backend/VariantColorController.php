<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\VariantColorsDataTable;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ColorProduct;
use App\Models\VariantColors;

class VariantColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, VariantColorsDataTable $dataTable)
    {
        $variants = ProductVariant::findOrFail($request->variants);
        $products = $variants->product;
        return $dataTable->render('backend.admin.product.variant_colors.index', compact('products', 'variants'));
    }

    public function getColorsByVariant($variantId)
    {
        $colors = VariantColors::where('variant_id', $variantId)
            ->with('color')
            ->get();

        if ($colors->isEmpty()) {
            return response()->json(['error' => 'No colors found'], 404);
        }

        return response()->json($colors);
    }

    public function getVariantColor($variant_id, $color_id)
    {
        $variantColor = VariantColors::where('variant_id', $variant_id)
            ->where('color_id', $color_id)
            ->first();

        if ($variantColor) {
            return response()->json([
                'variant_color_id' => $variantColor->id,
            ]);
        }

        return response()->json([
            'message' => 'Không tìm thấy Variant Color ID phù hợp.',
        ], 404);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $colors = ColorProduct::all();
        $variants = ProductVariant::findOrFail($request->variants);
        return view('backend.admin.product.variant_colors.create', compact('colors', 'variants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'colors' => ['required'],
            'price' => ['required'],
            'offer_price' => ['required'],
        ]);
        $color = new VariantColors();
        $color->color_id = $request->colors;
        $color->variant_id = $request->variants;
        $color->price = $request->price;
        $color->offer_price = $request->offer_price;
        $color->quantity = $request->quantity??0;
        $color->save();
        return redirect()->route('admin.variant-colors.index', ['variants' => $request->variants])->withSuccess('Thêm thành công');
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
        $variantColor = VariantColors::findOrFail($id);
        $colors = ColorProduct::all();
        return view('backend.admin.product.variant_colors.edit', compact('variantColor', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'colors' => ['required'],
            'price' => ['required'],
            'offer_price' => ['required'],
            'quantity' => ['required'],
        ]);
        $color = VariantColors::findOrFail($id);
        $color->color_id = $request->colors;
        $color->price = $request->price;
        $color->offer_price = $request->offer_price;
        $color->quantity = $request->quantity;
        $color->save();
        return redirect()->route('admin.variant-colors.index', ['variants' => $color->variant_id])->withSuccess('Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variantColor = VariantColors::findOrFail($id);
        $variantColor->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
