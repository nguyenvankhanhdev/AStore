<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseDetails extends Model
{
    use HasFactory;
    protected $fillable = ['warehouse_id', 'variant_color_id', 'quantity', 'warehouse_price'];

    // Quan hệ với Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    // Quan hệ với VariantColors
    public function variantColor()
    {
        return $this->belongsTo(VariantColors::class, 'variant_color_id');
    }
}
