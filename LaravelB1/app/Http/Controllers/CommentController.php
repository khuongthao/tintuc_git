<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\TinTuc;

use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    //
    public function getXoa($id,$idTinTuc)
    {
    $loaitin=Comment::find($id);
    $loaitin->delete();

     return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','xoa comment thanh cong');
    }
    function postComment(Request $request,$id)
    {
    	$comment=new Comment;
    	$tintuc=TinTuc::find($id);
    	$idTinTuc=$id;
    	$comment->idTinTuc= $idTinTuc;
    	$comment->idUser=Auth::user()->id;
    	$comment->NoiDung=$request->NoiDung;
    	$comment->save();
    	return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Comment thanh cong');
    }
   
}
