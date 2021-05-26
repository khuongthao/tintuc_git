<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductsType;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session;
class addCartController extends Controller
{
    //
    function __construct()
    {
        $slide=Slide::all();
        $productType=ProductsType::all();
        view()->share('slide',$slide);
        view()->share('productType',$productType);
    }
    public  function addCart(Request $request, $id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        if ($product!=null)
        {
            $oldcart=Session('Cart')?Session('Cart'):null;
            $newcart=new Cart($oldcart);
            $newcart->addCart($product,$id);
            $request->Session()->put('Cart',$newcart);

        }
    return view('pages.cart');
    }
    public function DeleteItemCart(Request $request,$id)
    {
        $oldCart=Session('Cart')?Session('Cart'):null;
        $newCart=new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if (count($newCart->products)>0)
        {
            $request->Session()->put('Cart',$newCart);
        }else{
            $request->Session()->forget('Cart');
        }
        return view('pages.cart');

    }
    public function listCart(){
        return view('pages.listCart');
    }
    public function DeleteListItemCart(Request $request,$id)
    {
        $oldCart=Session('Cart')?Session('Cart'):null;
        $newCart=new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if (count($newCart->products)>0)
        {
            $request->Session()->put('Cart',$newCart);
        }else{
            $request->Session()->forget('Cart');
        }
        return view('pages.listCartDelete');
    }
    public function SaveListItemCart(Request $request,$id,$quantity)
    {
        $oldCart=Session('Cart')?Session('Cart'):null;
        $newCart=new Cart($oldCart);
        $newCart->UpdateItemCart($id,$quantity);
        $request->Session()->put('Cart',$newCart);

        return view('pages.listCartDelete');
    }
}
