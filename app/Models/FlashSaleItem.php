<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleItem extends Model
{
    use HasFactory;

    public function subcategories()
    {
        return $this->belongsTo(SubCategories::class, 'sub_categories_id', 'id');
    }
    public function flashsales()
    {
        return $this->belongsTo(FlashSales::class, 'flash_sale_id', 'id');
    }
}
