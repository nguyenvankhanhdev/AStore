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
            return redirect()->route('login');
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

        // Ensure the user is authenticated
        if (!auth()->check()) {
            return response()->json(['message' => 'Bạn cần đăng nhập để thực hiện chức năng này.'], 401);
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
            // Update quantity if item exists
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
        else if($request->quantity >= $cart->variant_color->quantity){
            return response(['status' => 'error', 'message' => 'Số lượng sản phẩm trong kho không đủ!']);
        }
        else if($request->quantity == $cart->quantity)
        {

        } else {
            $cart->quantity = $request->quantity;
            $cart->save();
            return response(['status' => 'success','quantity'=>$cart->quantity, 'message' => 'Cập nhật giỏ hàng thành công!']);
        }
    }


    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code === null) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng nhập mã giảm giá!']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        if ($coupon === null) {
            return response(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        } elseif ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại!']);
        } elseif ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Mã giảm giá đã hết hạn']);
        } elseif ($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'Bạn không thể áp dụng phiếu giảm giá này']);
        }
        if ($coupon->discount_type === 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
        } elseif ($coupon->discount_type === 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
            ]);
        }
        $coupon->total_used += 1;
        $coupon->quantity--;
        $coupon->save();

        return response([
            'status' => 'success',
            'coupon_code' => $coupon->code,
            'message' => 'Áp dụng mã giảm giá thành công!'
        ]);
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        return response(['status' => 'success', 'message' => 'Xóa mã giảm giá thành công!']);
    }


    public function reloadCartDiscount(){
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            $subTotal = getTotal();
            if($coupon['discount_type'] === 'amount'){
                return $coupon['discount'];
            }elseif($coupon['discount_type'] === 'percent'){
                $discount = ($subTotal * $coupon['discount'] / 100);
                return $discount;
            }
        }
        else{
            return 0;
        }
    }
    public function reloadCodeCoupon(){
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            return $coupon['coupon_code'];
        }
        else{
            return null;
        }
    }


}
