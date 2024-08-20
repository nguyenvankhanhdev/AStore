<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Models\SubCategories;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Options\Languages\Paginate;
use Illuminate\Support\Facades\Auth;

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

        $productsNewArrival = Products::where('status', 1)
            ->where('product_type', 'new_arrival')
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $productsFeatured = Products::where('status', 1)
            ->where('product_type', 'featured_product')
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $productsTop = Products::where('status', 1)
            ->where('product_type', 'top_product')
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $productsBest = Products::where('status', 1)
            ->where('product_type', 'best_product')
            ->orderBy('id', 'DESC')
            ->paginate(6);



        return view('frontend.user.layouts.section_cate', compact('productsNewArrival', 'productsFeatured', 'productsTop', 'productsBest'));
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
        if (Auth::id() > 0) {
            $user = User::find(Auth::id());
            $product = Products::with(['productImages'])->where([
                'slug' => $slug,
                'status' => 1
            ])->firstOrFail();
            $cate = Categories::where('id', $product->cate_id)->first();
            $comment = Comments::with('user')
                ->where([
                    'pro_id'=> $product->id,
                    'status'=> 0,
                    'cmt_id' => 0
                    ])
                ->orderBy('created_at', 'desc')
                ->paginate(6); // Phân trang với 6 bình luận mỗi trang
                //->get();
            return view('frontend.user.home.product_details', compact('product', 'cate', 'user', 'comment'));
        } else {
            $product = Products::with(['productImages'])->where([
                'slug' => $slug,
                'status' => 1
            ])->firstOrFail();
            $cate = Categories::where('id', $product->cate_id)->first();
            $comment = Comments::with('user')
            ->where([
                'pro_id'=> $product->id,
                'status'=> 0,
                'cmt_id' => 0

                ])
                ->orderBy('created_at', 'desc')
                ->paginate(6); // Phân trang với 6 bình luận mỗi trang
                //->get();
            return view('frontend.user.home.product_details', compact('product', 'cate', 'comment'));
        }
    }
}
