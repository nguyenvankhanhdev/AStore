<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingImages extends Model
{
    use HasFactory;

    public $timestamps = false;
    public function rating()
    {
        return $this->belongsTo(Ratings::class, 'rating_id');
    }
}
