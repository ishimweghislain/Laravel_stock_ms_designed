<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stocko extends Model
{
    protected $primaryKey = 'stockoid';

    protected $fillable = [
        'productid',
        'stockodate',
        'quantity',
        'unitprice',
        'totalprice',
        'customer',
    ];

    // Keep $dates for compatibility with older versions
    protected $dates = ['stockodate'];

    // Add casts for Laravel 8+
    protected $casts = [
        'stockodate' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productid');
    }
}