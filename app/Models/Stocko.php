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

    protected $dates = [
        'stockodate',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'productid');
    }
}
