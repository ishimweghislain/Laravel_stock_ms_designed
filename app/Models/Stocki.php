<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stocki extends Model
{
    protected $primaryKey = 'stockiid';

    protected $fillable = [
        'productid',
        'stockidate',
        'quantity',
        'unitprice',
        'totalprice',
    ];

    // Remove or keep $dates for compatibility
    protected $dates = ['stockidate'];

    // Add casts for Laravel 8+
    protected $casts = [
        'stockidate' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productid');
    }
}