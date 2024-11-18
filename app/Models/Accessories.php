<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    use HasFactory;
    protected $table = 'compatible_accessories';
    protected $fillable = [
        'pro_id',
        'sub_cate_id',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'pro_id', 'id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategories::class, 'sub_cate_id', 'id');
    }
}
