<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function getDangnhapAdmin()
    {
    	return view('admin/login');
    }
    public function postDangnhapAdmin(Request $request)
    {
    	$this->validate($request,
    		[
    			'email'=>'required|email',
    			'password'=>'required|min:3|max:20'
    		],
    		[
    			'email.required'=>'can nhap email',
    			'email.email'=>'email co duoi @gmail.com',
    			'password.required'=>'nhap pass'
    		]);
    	if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
    		return redirect('admin/theloai/danhsach')->with('thongbao','Login thanh cong');
    	}else
    	{
    		return redirect('admin/login')->with('thongbao','Sai tai khoan hoac mat khau');
    	}
    }


    public function getLogoutAdmin()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
