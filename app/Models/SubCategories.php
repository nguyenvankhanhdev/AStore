<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $fillable = [
        'name',
        'cate_id',
        'slug',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'cate_id');
    }
    public function flashsaleitem()
    {
        return $this->hasMany(FlashSaleItem::class, 'sub_categories_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'sub_cate_id');
    }
    public function accessories()
    {
        return $this->hasMany(Accessories::class, 'sub_cate_id');
    }
}
