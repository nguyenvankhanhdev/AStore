<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancel extends Model
{

    use HasFactory;
    protected $table = 'order_cancel';
    protected $fillable = [
        'order_id',
        'reason',
        'order_cancel_date',
    ];
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

}
