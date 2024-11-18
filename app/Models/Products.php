<?php

namespace App\Models;

use App\Http\Controllers\Frontend\CommentController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'quantity',
        'offer_price',
        'short_description',
        'long_description',
        'status',
        'sub_cate_id',
        'cate_id',
        'product_type'

    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'cate_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategories::class, 'sub_cate_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'pro_id');
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class, 'pro_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'pro_id');
    }
    public function carts()
    {
        return $this->hasMany(Carts::class . 'pro_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'pro_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'pro_id');
    }
    public function accessories()
    {
        return $this->hasMany(Accessories::class,'pro_id');
    }



    public static function hasUserPurchasedProduct($userId, $productId)
    {
        // Lấy danh sách order_id của user
        $orderIds = Orders::getOrderIdsByUserId($userId);

        // Lấy danh sách product_id từ order_id
        $productIds = OrderDetails::getProductIdsByOrderIds($orderIds);

        // Kiểm tra productId có trong danh sách productIds không
        return $productIds->contains($productId);
    }
}
