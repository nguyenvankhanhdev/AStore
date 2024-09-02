<?php

use App\Models\Carts;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Session;


function getTotalCart(){
    $total = 0;
    foreach (Carts::content() as $key => $cart){
        $total += $cart['price'] * $cart['quantity'];
    }

}



