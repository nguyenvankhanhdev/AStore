<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Categories::class, 'cate_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'sub_cate_id');
    }
}
