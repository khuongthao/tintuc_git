<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Slide;
use App\Models\ProductsType;
use App\Models\Customer;
use App\Models\Bills;
use App\Models\BillDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    //
    function __construct()
    {
    	$slide=Slide::all();
    	$productType=ProductsType::all();
    	view()->share('slide',$slide);
    	view()->share('productType',$productType);
    }
	function getDanhsach()
	{
		$product=Products::where('new',1)->paginate(8);
		$product1=Products::where('promotion_price','<>',0)->paginate(8,['*'],'pag');

		return view('home',['product'=>$product,'product1'=>$product1]);
	}
	function type($id)
	{
		$product=Products::where('id_type',$id)->paginate(6);
		$product1=Products::where('id_type','<>',$id)->paginate(3);
		$pt1=ProductsType::where('id',$id)->first();
		return view('pages.loaisp',['product'=>$product,'product1'=>$product1,'pt1'=>$pt1]);
	}
	function chitiet($id)
	{
		$product=Products::where('id',$id)->first();
		$tuongtu=Products::where('id_type',$product->id_type)->paginate(3);
		return view('pages.chitiet',compact('product','tuongtu'));
	}
    function gioithieu()
	{
		return view('pages.gioithieu');
	}
	function lienhe()
	{
		return view('pages.lienhe');
	}

	function getDathang()
    {
        return view('pages.dathang');
    }
    function postDathang(Request $request)
    {
        $this->validate($request,
        [
            'name'=>'required|min:3|max:20'
        ],
            [
                'name.required '=>'nhap ten',
                'name.min'=>'ten dai hon 3 ky tu',
                'name.max'=>'ten ngan hon 20 ky tu'
            ]
        );
          $cart=Session::get('Cart');

        $customer=new Customer();
        $customer->name=$request->name;
        $customer->gender=$request->gender;
        $customer->email =$request->email;
        $customer->address=$request->address;
        $customer->phone_number=$request->phone;
        $customer->note=$request->notes;
        $customer->save();

        $bill=new Bills();
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$request->payment_method;
        $bill->note=$request->notes;
        $bill->save();

        foreach($cart->products as $key=>$value){

            $billdetail=new BillDetail();
            $billdetail->id_bill=$bill->id;
            $billdetail->id_product=$key;
            $billdetail->quantity=$value['quantity'];
             $billdetail->unit_price=$value['price']/$value['quantity'];
             $billdetail->save();
        }
Session::forget('Cart');

       return redirect()->back()->with('thongbao','Dat hang thanh cong');
    }

    function login()
    {
        return view('pages.login');
    }
    function postLogin(Request $request)
    {
       if( Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
       {
           return redirect('home')->with('thongbao','dang nhap thanh cong');

       }else
       {
           return redirect('login')->with('thongbao','Sai tai khoan hoac mat khau');
       }

    }

    function dangki()
    {
        return view('pages.dangki');
    }
    function postDangki(Request $request)
    {
        $this->validate($request,
        [
            'password'=>'required',
            'passwordAgain'=>'required|same:password'
        ],
            [
                'password.required'=>'Nhập mật khẩu',
                'paswordAgain.required'=>'Nhập lại mật khẩu',
                'paswordAgain.same'=>'Mật khẩu chưa khớp'
            ]
        );
        $user=new User();
        $user->email=$request->email;
        $user->full_name=$request->fullname;
        $user->phone=$request->phone;
        $user->address=$request->address;

        $user->password=bcrypt($request->password);
        $user->save();
        return redirect('login')->with('thongbao','dang ki thanh cong');
    }
    function logout()
    {
        Auth::logout();
        return redirect('home');
    }
    function search(Request  $request)
    {
    $tukhoa=$request->key;
    $product=Products::where('name','like',"%$tukhoa%")->orWhere('unit_price','like',"%$tukhoa%")->take(30)->paginate(8);
    return view('pages.search',compact('tukhoa','product'));
    }
}
