<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategories::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function carts()
    {
        return $this->hasMany(Carts::class.'pro_id');
    }
}
