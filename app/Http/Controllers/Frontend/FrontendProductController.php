<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Options\Languages\Paginate;

class FrontendProductController extends Controller
{
    public function productsIndex(Request $request)
    {
        // if ($request->has('categories')) {
        //     $categories = Categories::where('slug', $request->categories)->firstOrFail();
        //     $products = Products::withAvg('rating', 'point')->withCount('rating')
        //         ->with(['product_variant', 'categories', 'productImages'])
        //         ->where([
        //             'cate_id' => $categories->id,
        //             'status' => 1,
        //         ])
        //         ->when($request->has('range'), function ($query) use ($request) {
        //             $price = explode(';', $request->range);
        //             $from = $price[0];
        //             $to = $price[1];
        //             return $query->where('price', '>=', $from)->where('price', '<=', $to);
        //         })
        //         ->paginate(5);
        // } elseif ($request->has('subcategory')) {
        //     $categories = SubCategories::where('slug', $request->subcategory)->firstOrFail();
        //     $products = Products::withAvg('rating', 'point')->withCount('rating')
        //         ->with(['product_variant', 'categories', 'productImages'])
        //         ->where([
        //             'sub_cate_id' => $categories->id,
        //             'status' => 1,
        //         ])
        //         ->when($request->has('range'), function ($query) use ($request) {
        //             $price = explode(';', $request->range);
        //             $from = $price[0];
        //             $to = $price[1];

        //             return $query->where('price', '>=', $from)->where('price', '<=', $to);
        //         })
        //         ->paginate(12);
        // }
        // elseif($request->has('search')){
        //     $products = Products::withAvg('rating', 'point')->withCount('rating')
        //     ->with(['product_variant', 'category', 'productImages'])
        //     ->where(['status' => 1])
        //     ->where(function ($query) use ($request){
        //         $query->where('name', 'like', '%'.$request->search.'%')
        //             ->orWhere('long_description', 'like', '%'.$request->search.'%')
        //             ->orWhereHas('categories', function($query) use ($request){
        //                 $query->where('name', 'like', '%'.$request->search.'%')
        //                     ->orWhere('long_description', 'like', '%'.$request->search.'%');
        //             });
        //     })
        //     ->paginate(12);
        // }
        // else{
        //     $products = Products::withAvg('rating', 'point')->withCount('rating')
        //     ->with(['product_variant', 'category', 'productImages'])
        //     ->where(['status' => 1])->orderBy('id', 'DESC')->paginate(12);
        // }
        // $categories = Categories::all();
        // return view('frontend.user.pages.product', compact('products', 'categories'));

        $products = Products::where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('frontend.user.layouts.section_cate', compact('products'));
    }

    public function productCategories(Request $request)
    {
        if ($request->has('categories')) {
            $categories = Categories::where('slug', $request->categories)->firstOrFail();
            $subcategories= SubCategories::where( 'cate_id', $categories->id )->get();
            $products = Products::where([
                'cate_id' => $categories->id,
                'status' => 1,
            ])
                ->paginate(5);
        }
        return view('frontend.user.categories.index', compact('products','categories','subcategories'));


    }

    public function productSubCategories(Request $request)
    {
        if ($request->has('subcategories')) {
            $subcategory= SubCategories::where( 'slug', $request->subcategories )->first();
            $categories = Categories::where('id', $subcategory->cate_id)->firstOrFail();
            $subcategories= SubCategories::where( 'cate_id', $categories->id )->get();
            $products = Products::where([
                            'sub_cate_id' => $subcategory->id,
                            'status' => 1,
                         ])

                ->paginate(5);
        }
        return view('frontend.user.categories.index', compact('products','categories','subcategories'));
    }
    public function showProduct(string $slug)
    {
        $product = Products::with(['productImages','variant'])->where([
            'slug' => $slug,
            'status' => 1
        ])->firstOrFail();
        $cate = Categories::where('id', $product->cate_id)->first();
        $productvariant = ProductVariant::where('pro_id', $product->id)->get();

        return view('frontend.user.home.product_details', compact('product', 'cate','productvariant'));
    }
}
