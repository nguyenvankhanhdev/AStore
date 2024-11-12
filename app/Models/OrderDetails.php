<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetails extends Model
{
    use HasFactory;
    public function products(): BelongsTo
    {
        return $this->belongsTo(
            Products::class,
            'pro_id',
            'id'
        );
    }

    public function variantColors(): BelongsTo
    {
        return $this->belongsTo(
            VariantColors::class,
            'variant_color_id',
            'id'
        );
    }
    public function orders(): BelongsTo
    {
        return $this->belongsTo(
            Orders::class,
            'order_id',
            'id'
        );
    }
}
