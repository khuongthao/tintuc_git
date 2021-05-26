<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
   public $products=null;
   public $totalPrice=0;
   public $totalQuantity=0;

    public function __construct($cart)
    {
        if ($cart){
            $this->products=$cart->products;
            $this->totalPrice=$cart->totalPrice;
            $this->totalQuantity=$cart->totalQuantity;
        }

    }
    public  function addCart($product,$id)
    {
        $newProduct=['quantity'=>0,'price'=>$product->unit_price,'productInfo'=>$product];
        if ($this->products)
        {
            if(array_key_exists($id,$this->products))
            {
                $newProduct=$this->products[$id];
            }
        }
        $newProduct['quantity']++;
        $newProduct['price']=$newProduct['quantity'] * $product->unit_price;
        $this->products[$id]=$newProduct;
        $this->totalPrice +=$product->unit_price;
        $this->totalQuantity++;
    }
    public function DeleteItemCart($id)
    {
    $this->totalQuantity -= $this->products[$id]['quantity'];
    $this->totalPrice -= $this->products[$id]['price'];
    unset($this->products[$id]);
    }
    public function UpdateItemCart($id,$quantity)
    {   //xoa sp hien tai
        $this->totalQuantity -= $this->products[$id]['quantity'];
        $this->totalPrice -= $this->products[$id]['price'];
        //cap nhat lai sp
        $this->products[$id]['quantity']=$quantity;
        $this->products[$id]['price']=$quantity*$this->products[$id]['productInfo']->unit_price;
        //tinh tong

        $this->totalQuantity+=$this->products[$id]['quantity'];
        $this->totalPrice +=$this->products[$id]['price'];
    }
}

