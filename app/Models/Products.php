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
        return $this->hasMany(ProductImageGallery::class,'pro_id');
    }










}