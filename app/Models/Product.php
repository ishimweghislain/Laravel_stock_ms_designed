<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'productid';

    protected $fillable = [
        'pname','pcode'
    ];

    public function stocki(){
        return $this->hasMany(Stocki::class, 'productid');
    }

    public function stocko(){
        return $this->hasMany(Stocko::class, 'productid');
    }
}

