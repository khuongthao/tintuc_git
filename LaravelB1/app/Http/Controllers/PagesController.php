<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\Slide;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class PagesController extends Controller
{
    //
	function __construct()
	{
		$theloai=TheLoai::all();
		$slide=Slide::all();

		view()->share('theloai',$theloai);
		view()->share('slide',$slide);
	}

	function trangchu()
	{
		
		return view('trangchu.pages.contents');
	}

	function lienhe()
	{
		
		return view('trangchu.pages.lienhe');
	}
	function loaitin($id)
	{
		$loaitin=LoaiTin::find($id);
		$tintuc=TinTuc::where('idLoaiTin',$id)->paginate(5);
		return view('trangchu.pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
	}

	function tintuc($id)
	{
		$tintuc=TinTuc::find($id);
		$tinnoibat=TinTuc::where('NoiBat',1)->take(4)->get();
		$tinlienquan=TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
		return view('trangchu.pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
	}
	function getDangnhap()
	{
		return view('trangchu.pages.dangnhap');
	}
	function postDangnhap(Request $request)
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
			return redirect('trangchu')->with('thongbao','Dang nhap thanh cong');
		}else
		{
			return redirect('dangnhap')->with('thongbao','sai tk mk');
		}
	}
	function getDangxuat()
	{
		Auth::logout();
		return redirect('trangchu');
	}

	function getSuaUser()
	{
		$user=Auth::user();
		return view('trangchu.pages.nguoidung',['user'=>$user]);
	}
	function postSuaUser(Request $request)
	{
		$user=Auth::user();
		$user->name=$request->name;
		if ($request->checkpassword=="on") {
			$this->validate($request,[
				'password'=>'required',
				'passwordAgain'=>'required|same:password'
			],
			[
				'password.required'=>'nhap mat khau',
				'passwordAgain.required'=>'nhap lai mat khau',
				'passwordAgain.same'=>'mat khau chua khop'
			]);

			$user->password=bcrypt($request->password);

		}
			$user->save();
			return redirect('nguoidung')->with('thongbao','doi thanh cong');
	}

	function getDangky()
	{
		return view('trangchu.pages.dangky');
	}
	function postDangky(Request $request)
	{
		$this->validate($request,[
			'email'=>'required|email',
				'password'=>'required',
				'passwordAgain'=>'required|same:password'
			],
			[
				'password.required'=>'nhap mat khau',
				'email.required'=>'nhap email',
				'passwordAgain.required'=>'nhap lai mat khau',
				'passwordAgain.same'=>'mat khau chua khop'
			]);
		 $user=new User;
		 $user->name=$request->name;
		 $user->email=$request->email;
		 $user->quyen=0;
		 $user->password=bcrypt($request->password);
		 $user->save();

		 return redirect('dangnhap')->with('thongbao','Dang ky thanh cong');
	}
	function postTimkiem(Request $request)
	{
		$tukhoa=$request->tukhoa;
		$tintuc=TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"$tukhoa")->orWhere('NoiDung','like',"$tukhoa")->take(30)->paginate(5);
		return view('trangchu.pages.timkiem',['tukhoa'=>$tukhoa,'tintuc'=>$tintuc]);
	}
}
