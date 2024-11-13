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
use App\Models\Ratings;
use function App\Helper\getTotal;

class ProductController extends Controller
{
    public function productsIndex(Request $request)
    {
        $search = $request->input('search');

        $productsNewArrival = Products::where('status', 1)
            ->where('product_type', 'new_arrival')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $productsFeatured = Products::where('status', 1)
            ->where('product_type', 'featured_product')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $productsTop = Products::where('status', 1)
            ->where('product_type', 'top_product')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate(6);

        $productsBest = Products::where('status', 1)
            ->where('product_type', 'best_product')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('id', 'DESC')
            ->paginate(6);

        return view('frontend.user.layouts.section_cate', compact('productsNewArrival', 'productsFeatured', 'productsTop', 'productsBest', 'search'));
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
            $userID = Auth::id();
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
            $infoRating = Ratings::where('pro_id', $product->id)
                ->where('user_id', $userID)
                ->first();
            $ratingsCount = Ratings::getCountByStar($product->id);
            return view('frontend.user.home.product_details', compact('infoRating', 'product', 'user', 'comment', 'selectedVariantId', 'colors', 'ratingsCount'));
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
            $ratingsCount = Ratings::getCountByStar($product->id);

            return view('frontend.user.home.product_details', compact('product',  'comment', 'selectedVariantId', 'colors', 'ratingsCount'));
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

    // public function rating(Request $request)
    // {
    //     try {
    //         if (!Auth::check()) {
    //             return redirect()->route('auth.admin')->with('error','Vui lòng đăng nhập');
    //         }

    //         $userId = Auth::id();
    //         $productId = $request->pro_id;

    //         // $hasPurchased = Products::hasUserPurchasedProduct($userId, $productId);

    //         // if (!$hasPurchased) {
    //         //     return response()->json(['message' => 'Bạn chưa mua sản phẩm này'], 403);
    //         // }

    //         $existingRating = Ratings::where('user_id', $userId)
    //                                 ->where('pro_id', $productId)
    //                                 ->first();

    //         if ($existingRating) {
    //             $existingRating->point = $request->point;
    //             $existingRating->save();
    //             return response()->json(['message' => 'Bạn đã sửa đánh giá sản phẩm thành công'], 200);
    //         }

    //         $rating = new Ratings();
    //         $rating->point = $request->point;
    //         $rating->user_id = $userId;
    //         $rating->pro_id = $productId;
    //         $rating->save();



    //         return response()->json(['message' => 'Đánh giá của bạn đã được lưu'], 200);
    //     } catch (\Exception $e) {
    //         \Log::error($e->getMessage()); // Ghi lại lỗi vào log
    //         return response()->json(['message' => 'Đã xảy ra lỗi hệ thống.'], 500);
    //     }
    // }

    public function rating(Request $request)
    {

        try {
            // Kiểm tra xem người dùng đã đăng nhập chưa
            if (!Auth::check()) {
                return response()->json(['message' => 'Vui lòng đăng nhập'], 401);
            }

            $userId = Auth::id();
            $productId = $request->pro_id;

            $hasPurchased = Products::hasUserPurchasedProduct($userId, $productId);

            if (!$hasPurchased) {
                return response()->json(['message' => 'Bạn chưa mua sản phẩm này'], 403);
            }

            // Kiểm tra xem người dùng đã đánh giá sản phẩm chưa
            $existingRating = Ratings::where('user_id', $userId)
                ->where('pro_id', $productId)
                ->first();

            // Nếu người dùng đã đánh giá, cập nhật lại điểm
            if ($existingRating) {
                $existingRating->point = $request->point;
                $existingRating->save();
                $message = 'Bạn đã sửa đánh giá sản phẩm thành công';
            } else {
                // Nếu chưa có đánh giá, tạo đánh giá mới
                $rating = new Ratings();
                $rating->point = $request->point;
                $rating->user_id = $userId;
                $rating->pro_id = $productId;
                $rating->save();
                $message = 'Đánh giá của bạn đã được lưu';
            }

            // Tính điểm trung bình của sản phẩm
            $averageRating = Ratings::getAverageRating($productId);

            // Cập nhật lại điểm trung bình của sản phẩm
            $product = Products::find($productId);
            if ($product) {
                $product->point = $averageRating; // Cập nhật lại thuộc tính point
                $product->save();
            }
            $ratingsCount = Ratings::getCountByStar($product->id);
            $infoRating = Ratings::where('pro_id', $product->id)
                ->where('user_id', $userId)
                ->first();
            // Trả về thông báo thành công
            return response()->json(['infoRating' => $infoRating, 'message' => $message, 'averageRating' => $averageRating, 'ratingsCount' => $ratingsCount], 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage()); // Ghi lại lỗi vào log
            return response()->json(['message' => 'Đã xảy ra lỗi hệ thống.'], 500);
        }
    }
}
