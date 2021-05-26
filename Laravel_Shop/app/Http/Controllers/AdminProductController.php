<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsType;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    //
    public function __construct()
    {
        $type=ProductsType::all();
        view()->share('type',$type);
//        $product=Products::all();
//        view()->share('product',$product);
    }
    function DanhsachProduct()
    {
        $product=Products::where('id','>=',1)->paginate(5);
        return view('adminPages.product.admin',compact('product'));
    }
    function getAdd()
    {

        return view('adminPages.product.add');
    }
    function postAdd(Request $request)
    {
        $product=new Products();
        $product->id_type=$request->loai;
        $product->name=$request->name;
        $product->description=$request->descript;
        $product->unit_price=$request->unit_price;
        $product->unit=$request->unit;

        if ($request->hasFile('image')) {
            $file=$request->file('image');//luu hinh anh vao bien file
            $duoi=$file->getClientOriginalExtension();
            if ($duoi!='jpg'&&$duoi!='png'&&$duoi!='jpeg') {
                return redirect('admin/product/addProduct')->with('loi','chon file co duoi la JPG,PNG,JPEG');
            }

            $name=$file->getClientOriginalName();
            $var = Str::random(4);
            $hinh=$var."_".$name;
            while (file_exists('source/image/product/'.$hinh)) {
                $hinh=$var."_".$name;
            }
            $file->move("source/image/product/",$hinh);

            $product->image=$hinh;
        } else
        {
            $request->image="";
        }
        $product->save();
        return redirect('admin/product/listProduct')->with('thongbao','them thanh cong');
    }
}
