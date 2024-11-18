<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }

    public static function getOrderIdsByUserId($userId)
    {
        return self::where('user_id', $userId)->pluck('id');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
