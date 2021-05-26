<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table='bill_detail';
    public function products()
    {
    	return $this->belongsTo('App\Models\Products','id_product','id');
    }
     public function bills()
    {
    	return $this->belongsTo('App\Models\Bills','id_bill','id');
    }
}
