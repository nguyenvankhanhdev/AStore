<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\SubCategories;
use App\Models\VariantColors;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Options\Languages\Paginate;

class FrontendProductController extends Controller
{
    public function productsIndex(Request $request)
    {
        $products = Products::where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('frontend.user.layouts.section_cate', compact('products'));
    }

    public function productCategories(Request $request)
    {
        if ($request->has('categories')) {
            $categories = Categories::where('slug', $request->categories)->firstOrFail();
            $subcategories = SubCategories::where('cate_id', $categories->id)->get();
            $products = Products::where([
                'cate_id' => $categories->id,
                'status' => 1,
            ])
                ->paginate(5);
        }
        return view('frontend.user.categories.index', compact('products', 'categories', 'subcategories'));
    }

    public function productSubCategories(Request $request)
    {
        if ($request->has('subcategories')) {
            $subcategory = SubCategories::where('slug', $request->subcategories)->first();
            $categories = Categories::where('id', $subcategory->cate_id)->firstOrFail();
            $subcategories = SubCategories::where('cate_id', $categories->id)->get();
            $products = Products::where([
                'sub_cate_id' => $subcategory->id,
                'status' => 1,
            ])

                ->paginate(5);
        }
        return view('frontend.user.categories.index', compact('products', 'categories', 'subcategories'));
    }
    public function showProduct(string $slug)
    {
        $product = Products::with(['productImages', 'variant', 'variantColors', 'storage'])->where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();
        $cate = Categories::where('id', $product->cate_id)->first();
        $productvariant = ProductVariant::where('pro_id', $product->id)->get();

        return view('frontend.user.home.product_details', compact('product', 'cate', 'productvariant'));
    }
    public function getPriceByVariantAndColor(Request $request)
    {
        $request->validate([
            'variant_id' => 'required',
            'color_id' => 'required',
        ]);
        $variantColors = VariantColors::where([
            'variant_id' => $request->variant_id,
            'color_id' => $request->color_id,
        ])->firstOrFail();

        return response()->json([
            'status' => 'success',
            'price' => $variantColors,
            'storage' => $variantColors->variant->storage,
        ]);
    }
    public function getPriceByVariant(Request $request)
    {
        $variant = ProductVariant::find($request->variantId);
        $firstPrice = $variant->variantColors->first();
        return response()->json([
            'status' => 'success',
            'variantColors' => $firstPrice,
        ]);
    }
}
