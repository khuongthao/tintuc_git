<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
class TinTucController extends Controller
{
    //
	public function getDanhsach()
	{
		$tintuc=TinTuc::orderBy('id','DESC')->get();
		return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
	}
	public function getThem()
	{
		$theloai=TheLoai::all();
		$loaitin=LoaiTin::all();
		return  view('admin.tintuc.them',['theloai'=>$theloai],['loaitin'=>$loaitin]);

	}
	public function postThem(Request $request)
	{
		$this->validate($request,
			[
				'TieuDe'=>'required|unique:LoaiTin,Ten|min:3|max:20',
				'TomTat'=>'required',
				'NoiDung'=>'required',
				'Hinh'=>'required',
				
			],
			[
				'TieuDe.required'=>'ban chua nhap tieu de',
				'TomTat.required'=>'ban chua nhap tom tat',
				'NoiDung.required'=>'ban chua nhap noi dung',
				'TieuDe.unique'  =>'da ton tai',
				'TieuDe.min'     =>'dai hon 3 kt',
				'TieuDe.max'     =>'it hon 20 kt'
			]);
		$tintuc=new TinTuc;
		$tintuc->TieuDe=$request->TieuDe;
		$tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
		$tintuc->idLoaiTin=$request->LoaiTin;
		$tintuc->TomTat=$request->TomTat;
        $tintuc->NoiDung=$request->NoiDung;
        $tintuc->SoLuotXem= 0 ;
		if ($request->hasFile('Hinh')) {
			$file=$request->file('Hinh');//luu hinh anh vao bien file
			$duoi=$file->getClientOriginalExtension();
			if ($duoi!='jpg'&&$duoi!='png'&&$duoi!='jpeg') {
				 return redirect('admin/tintuc/them')->with('loi','chon file co duoi la JPG,PNG,JPEG');
			}

			$name=$file->getClientOriginalName();
			$var = Str::random(4);
			$hinh=$var."_".$name;
			while (file_exists('upload/tintuc/'.$hinh)) {
					$hinh=$var."_".$name;
			}
			$file->move("upload/tintuc",$hinh);
			$tintuc->Hinh=$hinh;
		}
		else
		{
			$request->Hinh="";
		}

		 $tintuc->save();
		 return redirect('admin/tintuc/them')->with('thongbao','them thanh cong');


	}
	public function getXoa($id)
	{
	$tintuc=TinTuc::find($id);
	$tintuc->delete();
	return redirect('admin/tintuc/danhsach')->with('thongbao','xoa ok');
	}

	public function getSua($id)
	{
		$theloai=TheLoai::all();
		$loaitin=LoaiTin::all();
		$tintuc=TinTuc::find($id);
		return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
	}
	public function postSua(Request $request,$id)
	{ 
		$tintuc=TinTuc::find($id);

	$this->validate($request,
			[
				'TieuDe'=>'required|unique:LoaiTin,Ten|min:3|max:2000',
				'TomTat'=>'required',
				'NoiDung'=>'required',
				
				
			],
			[
				'TieuDe.required'=>'ban chua nhap tieu de',
				'TomTat.required'=>'ban chua nhap tom tat',
				'NoiDung.required'=>'ban chua nhap noi dung',
				'TieuDe.unique'  =>'da ton tai',
				'TieuDe.min'     =>'dai hon 3 kt',
				'TieuDe.max'     =>'it hon 2000 kt'
			]);
		$tintuc->TieuDe=$request->TieuDe;
		$tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
		$tintuc->idLoaiTin=$request->LoaiTin;
		$tintuc->TomTat=$request->TomTat;
        $tintuc->NoiDung=$request->NoiDung;
 
		if ($request->hasFile('Hinh')) {
			$file=$request->file('Hinh');//luu hinh anh vao bien file
			$duoi=$file->getClientOriginalExtension();
			if ($duoi!='jpg'&&$duoi!='png'&&$duoi!='jpeg') {
				 return redirect('admin/tintuc/them')->with('loi','chon file co duoi la JPG,PNG,JPEG');
			}

			$name=$file->getClientOriginalName();
			$var = Str::random(4);
			$hinh=$var."_".$name;
			while (file_exists('upload/tintuc/'.$hinh)) {
					$hinh=$var."_".$name;
			}
			$file->move("upload/tintuc",$hinh);
			unlink("upload/tintuc/".$tintuc->Hinh);
			$tintuc->Hinh=$hinh;
		}

		 $tintuc->save();
		return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sua thanh cong');

	}
}
