<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoupons extends Model
{
    use HasFactory;
    protected $table = 'user_coupons';
    protected $fillable = [
        'user_id',
        'coupon_id',
    ];
    public $timestamps = false;
    public function coupons()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
