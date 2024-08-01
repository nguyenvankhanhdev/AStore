<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = [
        'variant_id',
        'user_id',
        'pro_id',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class,'pro_id');
    }
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class,'variant_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }






}
