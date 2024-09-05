<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Categories::class,'cate_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategories::class,'sub_cate_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class,'pro_id');
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class,'pro_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class,'pro_id');
    }
    public function carts()
    {
        return $this->hasMany(Carts::class.'pro_id');
    }
}
