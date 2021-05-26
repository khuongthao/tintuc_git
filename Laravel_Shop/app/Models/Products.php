<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table='products';
     public function billDetail()
    {
    	return $this->hasMany('App\Models\BillDetail','id_product','id');
    }
     public function productType()
    {
    	return $this->belongsTo('App\Models\ProductsType','id_type','id');
    }
}
