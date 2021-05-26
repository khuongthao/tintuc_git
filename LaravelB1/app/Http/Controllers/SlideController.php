<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Slide;
class SlideController extends Controller
{
    public function getDanhsach()
	{
		$slide=Slide::all();
		return view('admin.slide.danhsach',['slide'=>$slide]);
	}
	public function getThem()
	{
		return view('admin/slide/them');
	}
	public function postThem(Request $request)
	{
		$this->validate($request,
			[
				'Ten'=>'required|unique:Slide,Ten'
			],
		    [
		    	'Ten.unique'=>'ten da ton tai',
		    	'Ten.required'=>'nhap ten'
		    ] );
		$slide=new Slide;
		$slide->Ten=$request->Ten;
		$slide->link=$request->link;
		$slide->NoiDung=$request->NoiDung;
		if ($request->hasFile('Hinh')) {
			$file=$request->file('Hinh');
			$duoi=$file->getClientOriginalExtension();
			if ($duoi!='jpg'&&$duoi!='png') {
				return redirect('admin/slide/them')->with('thongbao','chon anh jpg,png');
			}
			$name=$file->getClientOriginalName();
			$var=Str::random(4);
			$hinh=$var."_".$name;
			while (file_exists('upload/slide/'.$hinh)) {
				$hinh=$var."_".$name;
			}
			$file->move('upload/slide/',$hinh);
			$slide->Hinh=$hinh;
		}
		else
		{
			$request->Hinh="";
		}
		$slide->save();
		return redirect('admin/slide/them')->with('thongbao','Them thnah cong');
	}
	public function getXoa($id)
	{
		$slide=Slide::find($id);
		$slide->delete();
		return redirect('admin/slide/danhsach')->with('thongbao','xoa ok');
	}

	public function getSua($id)
	{
		$slide=Slide::find($id);
	return view('admin.slide.sua',['slide'=>$slide]);
	}
	public function postSua(Request $request,$id)
	{ 
$slide=Slide::find($id);
	    $slide->Ten=$request->Ten;
		$slide->link=$request->link;
		$slide->NoiDung=$request->NoiDung;
		if ($request->hasFile('Hinh')) {
			$file=$request->file('Hinh');
			$duoi=$file->getClientOriginalExtension();
			if ($duoi!='jpg'&&$duoi!='png') {
				return redirect('admin/slide/them')->with('thongbao','chon anh jpg,png');
			}
			$name=$file->getClientOriginalName();
			$var=Str::random(4);
			$hinh=$var."_".$name;
			while (file_exists('upload/slide/'.$hinh)) {
				$hinh=$var."_".$name;
			}
			$file->move('upload/slide/',$hinh);
			unlink('upload/slide/'.$slide->Hinh);
			$slide->Hinh=$hinh;
		}
		
		$slide->save();
		return redirect('admin/slide/sua/'.$id)->with('thongbao','Sua ok');
	}
}
