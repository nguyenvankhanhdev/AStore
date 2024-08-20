<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageProduct extends Model
{
    use HasFactory;

    public function productVariant()
    {
        return $this->hasMany(ProductVariant::class, 'storage_id');
    }
}
