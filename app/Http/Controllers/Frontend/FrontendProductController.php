<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function productsIndex(Request $request)
    {
        if ($request->has('categories')) {
            $categories = Categories::where('slug', $request->categories)->firstOrFail();
            $products = Products::withCount('ratings')
                ->with(['product_variant', 'categories', 'productImages'])
                ->where([
                    'cate_id' => $categories->id,
                    'status' => 1,
                ])
                ->paginate(5);
        } elseif ($request->has('subcategory')) {
            $categories = SubCategories::where('slug', $request->subcategory)->firstOrFail();
            $products = Products::withCount('ratings')
                ->with(['product_variant', 'categories', 'productImages'])
                ->where([
                    'sub_cate_id' => $categories->id,
                    'status' => 1,
                ])
                ->paginate(12);
        }
        elseif($request->has('search')){
            $products = Products::withCount('ratings')
            ->with(['product_variant', 'category', 'productImages'])
            ->where(['status' => 1])
            ->where(function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('long_description', 'like', '%'.$request->search.'%')
                    ->orWhereHas('categories', function($query) use ($request){
                        $query->where('name', 'like', '%'.$request->search.'%')
                            ->orWhere('long_description', 'like', '%'.$request->search.'%');
                    });
            })
            ->paginate(12);
        }
        else{
            
            $products = Products::all();
        }

        $categories = Categories::all();
        return view('frontend.user.pages.product', compact('products', 'categories'));

    }
}
