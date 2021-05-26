<?php

use Illuminate\Support\Facades\Route;
use App\Models\TheLoai;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('thu',function(){
// 	return view('admin.layout.index');
// });
Route::get('admin/login','UserController@getDangnhapAdmin');
Route::post('admin/login','UserController@postDangnhapAdmin');
Route::get('admin/logout','UserController@getLogoutAdmin');

Route::group(['prefix'=>'admin','middleware'=>'LoginAdmin'],function(){
 	Route::group(['prefix'=>'theloai'],function(){

 		Route::get('danhsach','TheLoaiController@getDanhSach');

 		Route::get('sua/{id}','TheLoaiController@getSua');
 		Route::post('sua/{id}','TheLoaiController@postSua');

 		Route::get('them','TheLoaiController@getThem');
 		Route::post('them','TheLoaiController@postThem');

 		Route::get('xoa/{id}','TheLoaiController@getXoa');
 	});
 	Route::group(['prefix'=>'slide'],function(){

 		Route::get('danhsach','SlideController@getDanhSach');

 		Route::get('sua','SlideController@getSua');

 		Route::get('them','SlideController@getThem');
 	});

/////////////////////////////////////////////////
 	Route::group(['prefix'=>'loaitin'],function(){

 		Route::get('danhsach','LoaiTinController@getDanhSach');

 		Route::get('sua/{id}','LoaiTinController@getSua');
 		Route::post('sua/{id}','LoaiTinController@postSua');

 		Route::get('them','LoaiTinController@getThem');
 		Route::post('them','LoaiTinController@postThem');

 		Route::get('xoa/{id}','LoaiTinController@getXoa');
 	});
//////////////////////////////////////////////////////////

 	Route::group(['prefix'=>'tintuc'],function(){

 		Route::get('danhsach','TinTucController@getDanhSach');

 		Route::get('sua/{id}','TinTucController@getSua');
 		Route::post('sua/{id}','TinTucController@postSua');

 		Route::get('them','TinTucController@getThem');
 		Route::post('them','TinTucController@postThem');

 		Route::get('xoa/{id}','TinTucController@getXoa');
 	});
 	///////////////////////////////////////
 		Route::group(['prefix'=>'comment'],function(){

 		
 		Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');
 	});
 	///////////////////////////////////////////
 		Route::group(['prefix'=>'slide'],function(){

 		Route::get('danhsach','SlideController@getDanhSach');

 		Route::get('sua/{id}','SlideController@getSua');
 		Route::post('sua/{id}','SlideController@postSua');

 		Route::get('them','SlideController@getThem');
 		Route::post('them','SlideController@postThem');

 		Route::get('xoa/{id}','SlideController@getXoa');
 	});
 		/////////////////////////////////////////
 	Route::group(['prefix'=>'user'],function(){

 		Route::get('danhsach','UserController@getDanhSach');

 		Route::get('sua','UserController@getSua');

 		Route::get('them','UserController@getThem');
 	});
 	///////////////////////////////////////////////
 	Route::group(['prefix'=>'ajax'],function(){
 		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
 	});
});

//////////////////
 Route::get('model/add',function(){
    	$user=new App\Models\User();
    	$user->name='thao33';
    	$user->email='thao99@gmail.com';
    	$user->password=bcrypt('1234');

    	$user->save();
    });


 //////////////////
 Route::get('trangchu','PagesController@trangchu');
 Route::get('lienhe','PagesController@lienhe');
 Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaitin'); 

 Route::get('tintuc/{id}/{TenKhongDau}.html','PagesController@tintuc');

Route::get('dangnhap','PagesController@getDangnhap');
Route::post('dangnhap','PagesController@postDangnhap');

Route::get('dangky','PagesController@getDangky');
Route::post('dangky','PagesController@postDangky');

Route::get('dangxuat','PagesController@getDangxuat');

Route::get('nguoidung','PagesController@getSuaUser');
Route::post('nguoidung','PagesController@postSuaUser');


Route::post('comment/{id}','CommentController@postComment');


Route::match(['get', 'post'], 'timkiem','PagesController@postTimkiem');