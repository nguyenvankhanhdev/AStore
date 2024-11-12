<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetails extends Model
{
    use HasFactory;


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

    public static function getProductIdsByOrderIds($orderIds)
    {
        return self::whereIn('order_id', $orderIds)
            ->with('variantColors.variant.product')
            ->get()
            ->map(function ($orderDetail) {
                return $orderDetail->variantColors->variant->product->id ?? null;
            })
            ->filter() // Loại bỏ các giá trị null
            ->unique() // Loại bỏ các product_id trùng lặp
            ->values();
    }
}
