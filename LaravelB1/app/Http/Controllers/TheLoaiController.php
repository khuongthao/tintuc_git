<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
class TheLoaiController extends Controller
{
    //
    public function getDanhSach()
    {
    	$theloai=TheLoai::all();
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
    public function getThem()
    {
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|min:3|max:20'
    		],
    		[
    			'Ten.required'=>'Nhap ten',
    			'Ten.min'     =>'Dai hon 3 ky tu',
    			'Ten.max'     =>'It hon 30 kt'
    		]
    	);

    	$theloai=new TheLoai;
    	$theloai->Ten=$request->Ten;
    	$theloai->TenKhongDau=changeTitle($request->Ten);
    	$theloai->save();
    	return redirect('admin/theloai/them')->with('thongbao','them thanh cong');
    }
   
	   public function getSua($id)
	   {
		   	$theloai=TheLoai::find($id);
		   	return view('admin.theloai.sua',['theloai'=>$theloai]);
	   }
	   public function postSua(Request $request,$id)
	   {
		   	$theloai=TheLoai::find($id);
		   	$this->validate($request,
		   		[
		   			'Ten'=>'required|min:3|max:10'
		   		],
		   		[
		   			'Ten.required'=>'Nhap ten lai',
	    			'Ten.min'     =>'Dai hon 3 ky tu',
	    			'Ten.max'     =>'It hon 30 kt'
	    			
		   		]);
		   	$theloai->Ten=$request->Ten;
		   	$theloai->TenKhongDau=changeTitle($request->Ten);
		   	$theloai->save();
		   	return redirect('admin/theloai/sua/'.$id)->with('thongbao','sua thanh cong');
	   }

	   public function getXoa($id)
	   {
	   	$theloai=TheLoai::find($id);
	   	$theloai->delete();
	   	return redirect('admin/theloai/danhsach')->with('thongbao','Xóa thành công');
	   }
}
