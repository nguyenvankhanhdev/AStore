<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Carts extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Products::class, 'pro_id');
    }
    public function variant_color()
    {
        return $this->belongsTo(VariantColors::class,'variant_color_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}