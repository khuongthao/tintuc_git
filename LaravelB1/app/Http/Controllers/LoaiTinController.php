<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;
class LoaiTinController extends Controller
{
    //
	public function getDanhsach()
	{
		$loaitin=LoaiTin::all();
		return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
	}
	public function getThem()
	{
		$theloai=TheLoai::all();
		return view('admin.loaitin.them',['theloai'=>$theloai]);
	}
	public function postThem(Request $request)
	{
		$this->validate($request,
			[
				'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:20'
			],
			[
				'Ten.required'=>'ban chua nhap ten',
				'Ten.unique'  =>'da ton tai',
				'Ten.min'     =>'dai hon 3 kt',
				'Ten.max'     =>'it hon 20 kt'
			]);
		$loaitin=new LoaiTin;
		$loaitin->Ten=$request->Ten;
		$loaitin->TenKhongDau=changeTitle($request->Ten);
		$loaitin->idTheLoai=$request->TheLoai;
		$loaitin->save();

		return redirect('admin/loaitin/them')->with('thongbao','them ok');
	}
	public function getXoa($id)
	{
		$loaitin=LoaiTin::find($id);
		$loaitin->delete();
		return redirect('admin/loaitin/danhsach')->with('thongbao','xoa thanh cong');
	}

	public function getSua($id)
	{
		$theloai=TheLoai::all();
		$loaitin=LoaiTin::find($id);
		return view('admin.loaitin.sua',['loaitin'=>$loaitin],['theloai'=>$theloai]);
	}
	public function postSua(Request $request,$id)
	{ 
		$loaitin=LoaiTin::find($id);
		$this->validate($request,
			[
				'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:20'
			],
			[
				'Ten.required'=>'ban chua nhap ten',
				'Ten.unique'  =>'da ton tai',
				'Ten.min'     =>'dai hon 3 kt',
				'Ten.max'     =>'it hon 20 kt'
			]);
		$loaitin->Ten=$request->Ten;
		$loaitin->TenKhongDau=changeTitle($request->Ten);
		$loaitin->idTheLoai=$request->TheLoai;
		$loaitin->save();
		return redirect('admin/loaitin/sua/'.$id)->with('thongbao','sua ok');
	}
}
