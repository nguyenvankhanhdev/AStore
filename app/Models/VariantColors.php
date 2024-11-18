<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantColors extends Model
{
    use HasFactory;
    protected $fillable = [
        'variant_id',
        'color_id',
        'quantity',
        'price',
        'offer_price',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
    public function color()
    {
        return $this->belongsTo(ColorProduct::class,'color_id');
    }
    public function carts(){
        return $this->hasMany(Carts::class,'variant_color_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class,'variant_color_id');
    }

}
