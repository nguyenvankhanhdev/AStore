<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public function usercoupons()
    {
        return $this->hasMany(UserCoupons::class, 'coupon_id');
    }
    public function orders()
    {
        return $this->hasMany(Orders::class, 'coupon_id');
    }
}
