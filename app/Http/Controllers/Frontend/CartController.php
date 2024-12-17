<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use App\Models\VariantColors;
use App\Models\Carts;
use App\Models\Districts;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Provinces;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\ProductVariant;
use App\Models\UserCoupons;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function getDistricts($province_id)
    {
        $districts = Provinces::find($province_id)->districts;
        return response()->json($districts);
    }

    public function getWards($district_id)
    {
        $wards = Districts::find($district_id)->wards;
        return response()->json($wards);
    }

    public function index()
    {
        if (!auth()->check()) {
            Session::flash('error', 'Bạn cần đăng nhập để thực hiện chức năng này.');
            return redirect()->back();
        } else {
            $userId = Auth::user()->id;
            $carts = Carts::with(['product', 'variant_color', 'user'])->where('user_id', $userId)->get();
            $provinces = Provinces::all();
            $user_address = UserAddress::with(['user'])->where('user_id', $userId)->get();
            return view('frontend.user.home.cart-details', compact('provinces', 'carts', 'user_address'));
        }
    }

    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
            'status' => 'error',
            'message' => 'Bạn cần đăng nhập để thực hiện chức năng này.']);
        }
        // Retrieve the request data
        $quantity = $request->input('quantity', 1);
        $variantId = $request->variant_id;
        $colorId = $request->color_id;
        $variantColor = VariantColors::where('variant_id', $variantId)
            ->where('color_id', $colorId)
            ->first();
        if (!$variantColor) {
            return response()->json(['message' => 'Phiên bản sản phẩm không tồn tại.'], 404);
        }
        $proVar = ProductVariant::find($variantId);

        if (!$proVar) {
            return response()->json(['message' => 'Sản phẩm không tồn tại.'], 404);
        }

        $cartItem = Carts::where('user_id', auth()->id())
            ->where('variant_color_id', $variantColor->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new cart item if it doesn't exist
            Carts::create([
                'quantity' => $quantity,
                'variant_color_id' => $variantColor->id,
                'user_id' => auth()->id(),
                'pro_id' => $proVar->pro_id,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công!',
        ]);
    }


    public function destroy()
    {
        $carts = Carts::where([
            'user_id' => Auth::user()->id,
            'id' => request()->route('id')
        ])->get();

        foreach ($carts as $cart) {
            $cart->delete();
        }

        return response(['status' => 'success', 'message' => 'Xóa sản phẩm thành công!']);
    }
    public function update(Request $request)
    {
        $cart = Carts::findOrFail($request->cart_id);

        if (!$cart) {
            return response(['status' => 'error', 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng!']);
        }

        $availableQuantity = $cart->variant_color->quantity;
        $requestedQuantity = $request->quantity;
        if ($requestedQuantity > $availableQuantity) {
            return response(['status' => 'error', 'message' => 'Số lượng sản phẩm trong kho không đủ!']);
        }
        if ($requestedQuantity == $cart->quantity) {
            return response(['status' => 'error', 'message' => 'Số lượng trong giỏ hàng đã được cập nhật!']);
        }
        $cart->quantity = $requestedQuantity;
        $cart->save();
        return response(['status' => 'success', 'quantity' => $cart->quantity, 'message' => 'Cập nhật giỏ hàng thành công!']);
    }


    public function applyCoupon(Request $request)
    {

        if (!$request->has('coupon_code') || $request->coupon_code === null) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng nhập mã giảm giá!']);
        }

        $coupon = UserCoupons::where(['unique_code' => $request->coupon_code])->first();

        if ($coupon === null) {
            return response()->json(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        }

        if ($coupon->coupons->start_date > date('Y-m-d') || $coupon->coupons->end_date < date('Y-m-d')) {
            return response()->json(['status' => 'error', 'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn!']);
        }

        if ($coupon->coupons->total_used >= $coupon->coupons->quantity) {
            return response()->json(['status' => 'error', 'message' => 'Bạn không thể áp dụng phiếu giảm giá này']);
        }

        Session::put('coupon', [
            'id' => $coupon->id,
            'coupon_name' => $coupon->coupons->name,
            'coupon_code' => $coupon->unique_code,
            'discount_type' => $coupon->coupons->discount_type,
            'discount' => $coupon->coupons->discount,
        ]);

        return response()->json([
            'status' => 'success',
            'coupon_code' => $coupon->unique_code,
            'coupon' => $coupon->coupons,
            'message' => 'Áp dụng mã giảm giá thành công!'
        ]);
    }


    public function removeCoupon()
    {
        Session::forget('coupon');
        return response(['status' => 'success', 'message' => 'Xóa mã giảm giá thành công!']);
    }

}
