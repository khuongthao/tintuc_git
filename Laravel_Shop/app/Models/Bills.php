<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $table='bills';
     public function billDetail()
    {
    	return $this->hasMany('App\Models\BillDetail','id_bill','id');
    }
     public function customer()
    {
    	return $this->belongsTo('App\Models\Customer','id_customer','id');
    }
}
