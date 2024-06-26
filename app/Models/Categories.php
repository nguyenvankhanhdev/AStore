<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    use HasFactory;
    public function subCategories()
    {
        return $this->hasMany(SubCategories::class, 'cate_id');
    }

}
