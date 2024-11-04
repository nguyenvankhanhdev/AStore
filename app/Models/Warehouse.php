<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = ['import_date', 'total_quantity'];

    // Quan hệ với WarehouseDetails
    public function warehouseDetails()
    {
        return $this->hasMany(WarehouseDetails::class, 'warehouse_id');
    }
}
