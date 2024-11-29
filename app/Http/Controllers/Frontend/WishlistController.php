<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Auth;
use Illuminate\Http\Request;
use Log;

class WishlistController extends Controller
{

    public function index()
    {
        $userId = auth()->id();
        $wishlist = Wishlist::with([
            'variantColor.variant.storage',
            'variantColor.color',
            'product'
        ])->where('user_id', $userId)->get();

        return view('frontend.user.dashboard.wishlist.index', compact('wishlist'));
    }



    public function add(Request $request)
    {
        \Log::info('Request data:', $request->all());

        $validated = $request->validate([
            'pro_id' => 'required|exists:products,id',
            'variant_color_id' => 'required|exists:variant_colors,id',
        ]);

        \Log::info('Validated data:', $validated);

        $exists = Wishlist::where([
            ['user_id', auth()->id()],
            ['pro_id', $validated['pro_id']],
            ['variant_color_id', $validated['variant_color_id']],
        ])->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Sản phẩm đã có trong danh sách yêu thích!',
                'status' => 'error',
            ], 409);
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'pro_id' => $validated['pro_id'],
            'variant_color_id' => $validated['variant_color_id'],
        ]);

        return response()->json([
            'message' => 'Sản phẩm đã được thêm vào danh sách yêu thích!',
            'status' => 'success'
        ]);
    }


    public function remove($id)
    {
        $wishlist = Wishlist::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$wishlist) {
            return response()->json(['message' => 'Sản phẩm không tồn tại trong danh sách yêu thích!'], 404);
        }

        $wishlist->delete();

        return response()->json(['message' => 'Xóa sản phẩm khỏi danh sách yêu thích thành công!']);
    }
}
