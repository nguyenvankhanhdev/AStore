<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Products::class,'pro_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetails::class,'orderdetail_id');
    }

    public function ratingImages()
    {
        return $this->hasMany(RatingImages::class,'rating_id');
    }


    public static function getCountByStar($pro_id)
    {
        $counts = [];

        // Đếm số lượng đánh giá cho từng mức điểm từ 1 đến 5
        for ($star = 1; $star <= 5; $star++) {
            $counts[$star] = self::where('pro_id', $pro_id)
                                ->where('point', $star)
                                ->count();
        }

        return $counts;
    }

    public static function countRatingsByProduct($pro_id)
    {
        // Đếm tổng số đánh giá cho sản phẩm theo pro_id
        return self::where('pro_id', $pro_id)->count();
    }
    public static function getAverageRating($pro_id)
    {
        return self::where('pro_id', $pro_id)->avg('point') ?? 0;
    }

    public static function filterExistingOrderDetails(array $orderDetailIds)
    {
        return self::whereIn('orderdetail_id', $orderDetailIds)
                    ->pluck('orderdetail_id')
                    ->toArray();
    }
}
