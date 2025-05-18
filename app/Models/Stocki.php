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

    protected $dates = [
        'stockidate',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'productid');
    }
}
