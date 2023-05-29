<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMenu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
