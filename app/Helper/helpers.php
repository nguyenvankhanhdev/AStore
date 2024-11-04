<?php
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}
function getTotal(){
    $total = 0;
    foreach (Carts::where('user_id', Auth::id())->get() as $cart) {
        $total += $cart->variant_color->price * $cart->quantity;
    }
    return $total;
}
function getCodeCoupon(){
    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        return $coupon['coupon_code'];
    }
    else{
        return null;
    }
}

function getCartDiscount(){
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

function getSubTotal(){
    $subTotal = getTotal();
    $discount = getCartDiscount();
    return $subTotal - $discount;
}


