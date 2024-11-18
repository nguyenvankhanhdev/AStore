<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSales extends Model
{
    use HasFactory;
   public function flashsateitems()
    {
        return $this->hasMany(FlashSaleItem::class, 'flash_sale_id', 'id');
    }

}
