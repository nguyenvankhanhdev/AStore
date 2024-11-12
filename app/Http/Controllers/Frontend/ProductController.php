<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use App\Models\StorageProduct;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\VariantColors;
use App\Models\Comments;
use function App\Helper\getTotal;

class ProductController extends Controller
{
    public function productsIndex(Request $request)
    {
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
        $products = collect();
        $subcategories = collect();
        $categories = null;
        if ($request->has('categories')) {
            $categories = Categories::where('slug', $request->categories)->firstOrFail();
            $subcategories = SubCategories::where('cate_id', $categories->id)->get();
            $products = Products::where([
                'cate_id' => $categories->id,
                'status' => 1,
            ])->get();
        }
        return view('frontend.user.categories.index', compact('products', 'categories', 'subcategories'));
    }

    public function showProduct(string $slug, Request $request)
    {
        $product = Products::with(relations: ['productImages', 'variants.variantColors', 'ratings', 'category', 'subcategory'])->where(column: [
            'slug' => $slug,
            'status' => 1
        ])->first();
        $selectedVariantId = $request->query('variant', $product->variants->first()->id);
        $colors = VariantColors::where('variant_id', $selectedVariantId)->get();
        if (Auth::id() > 0) {
            $user = User::find(Auth::id());
            $comment = Comments::with('user')
                ->where([
                    'pro_id' => $product->id,
                    'status' => 0,
                    'cmt_id' => 0
                ])
                ->orderBy('created_at', 'desc')
                ->paginate(6); // Phân trang với 6 bình luận mỗi trang
            //->get();
            return view('frontend.user.home.product_details', compact('product', 'user', 'comment', 'selectedVariantId', 'colors'));
        } else {
            $comment = Comments::with('user')
                ->where([
                    'pro_id' => $product->id,
                    'status' => 0,
                    'cmt_id' => 0

                ])
                ->orderBy('created_at', 'desc')
                ->paginate(6); // Phân trang với 6 bình luận mỗi trang
            //->get();
            return view('frontend.user.home.product_details', compact('product',  'comment', 'selectedVariantId', 'colors'));
        }
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

            foreach ($products as $product) {
                $product->variants = ProductVariant::where('pro_id', $product->id)->get();
            };
        }
        return view('frontend.user.categories.index', compact('products', 'categories', 'subcategories'));
    }
    public function getPrice(Request $request)
    {
        $variant = $request->variant_id;
        $color = $request->color_id;
        $price = VariantColors::where([
            'color_id' => $color,
            'variant_id' => $variant
        ])->first();
        $storage = ProductVariant::where([
            'id' => $variant
        ])->first();
        return response()->json(['price' => $price, 'storage' => $storage]);
    }
}
