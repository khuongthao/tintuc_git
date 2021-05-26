<?php

use Illuminate\Support\Facades\Route;

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
Route::get('home','ProductController@getDanhsach');

Route::get('type/{id}',[
	'as'=>'loai_sanpham',
	'uses'=>'ProductController@type']);

Route::get('gioithieu','ProductController@gioithieu');

Route::get('lienhe','ProductController@lienhe');

Route::get('chitiet/{id}','ProductController@chitiet');

//Add to cart
Route::get('cart/{id}','addCartController@addCart')->name('addCart');

Route::get('delete/{id}','addCartController@DeleteItemCart');

Route::get('listCart','addCartController@listCart');

Route::get('delete-list-cart/{id}','addCartController@DeleteListItemCart');

Route::get('save-list-cart/{id}/{quantity}','addCartController@SaveListItemCart');
//dat hang
Route::get('dat-hang','ProductController@getDathang');
Route::post('dat-hang','ProductController@postDathang');

//login
Route::get('login','ProductController@login');
Route::post('login','ProductController@postLogin');

Route::get('dangki','ProductController@dangki');
Route::post('dangki','ProductController@postDangki');
Route::get('logout','ProductController@logout');
Route::match(['get', 'post'],'search','ProductController@search');
///////////////////////////////////////ADMIN////////////////////////

Route::prefix('admin')->group(function () {
    Route::group(['prefix'=>'product'],function() {
        Route::get('/listProduct', "AdminProductController@DanhsachProduct")->name('listProduct');

        Route::get('/addProduct', "AdminProductController@getAdd")->name('addProduct');
        Route::post('/addProduct', "AdminProductController@postAdd")->name('postAddProduct');

        // Route::get('/listProduct', "AdminProductController@DanhsachProduct");

    });
});















