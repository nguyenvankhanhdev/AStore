<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Products::class,'pro_id');
    }

}
