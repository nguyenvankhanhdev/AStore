<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Products::class,'pro_id');
    }
    public function color()
    {
        return $this->belongsTo(ColorProduct::class,'color_id');
    }
    public function storage()
    {
        return $this->belongsTo(StorageProduct::class,'storage_id');
    }

}
