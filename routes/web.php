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

Route::get('admin/dangnhap','App\Http\Controllers\UserController@getdangnhapAdmin');
Route::post('admin/dangnhap','App\Http\Controllers\UserController@postdangnhapAdmin');
Route::get('admin/logout','App\Http\Controllers\UserController@getlogout');

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
    Route::group(['prefix'=>'theloai'],function(){
        Route::get('danhsach','App\Http\Controllers\TheLoaiController@getDanhsach');
        Route::get('sua/{id}','App\Http\Controllers\TheLoaiController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\TheLoaiController@postSua');
        Route::get('them','App\Http\Controllers\TheLoaiController@getThem');
        Route::post('them','App\Http\Controllers\TheLoaiController@postThem');
        Route::get('xoa/{id}','App\Http\Controllers\TheLoaiController@getXoa');
    }); 

    Route::group(['prefix'=>'loaitin'],function(){
        Route::get('danhsach','App\Http\Controllers\LoaiTinController@getDanhsach');
        Route::get('sua/{id}','App\Http\Controllers\LoaiTinController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\LoaiTinController@postSua');
        Route::get('them','App\Http\Controllers\LoaiTinController@getThem');
        Route::post('them','App\Http\Controllers\LoaiTinController@postThem');

        Route::get('xoa/{id}','App\Http\Controllers\LoaiTinController@getXoa');
    }); 

    Route::group(['prefix'=>'tintuc'],function(){
        Route::get('danhsach','App\Http\Controllers\TinTucController@getDanhsach');
        Route::get('sua/{id}','App\Http\Controllers\TinTucController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\TinTucController@postSua');
        Route::get('them','App\Http\Controllers\TinTucController@getThem');
        Route::post('them','App\Http\Controllers\TinTucController@postThem');

        Route::get('xoa/{id}','App\Http\Controllers\TinTucController@getXoa');
    }); 

    Route::group(['prefix'=>'slide'],function(){
        Route::get('danhsach','App\Http\Controllers\SlideController@getDanhsach');
        Route::get('sua/{id}','App\Http\Controllers\SlideController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\SlideController@postSua');
        Route::get('them','App\Http\Controllers\SlideController@getThem');
        Route::post('them','App\Http\Controllers\SlideController@postThem');

        Route::get('xoa/{id}','App\Http\Controllers\SlideController@getXoa');
    }); 

    Route::group(['prefix'=>'user'],function(){
        Route::get('danhsach','App\Http\Controllers\UserController@getDanhsach');
        Route::get('sua/{id}','App\Http\Controllers\UserController@getSua');
        Route::post('sua/{id}','App\Http\Controllers\UserController@postSua');
        Route::get('them','App\Http\Controllers\UserController@getThem');
        Route::post('them','App\Http\Controllers\UserController@postThem');

        Route::get('xoa/{id}','App\Http\Controllers\UserController@getXoa');
    }); 

    Route::group(['prefix'=>'ajax'],function(){
        Route::get('loaitin/{idTheLoai}','App\Http\Controllers\AjaxController@getLoaiTin');
    }); 

    Route::group(['prefix'=>'comment'],function(){
        Route::get('xoa/{id}/{idTinTuc}','App\Http\Controllers\CommentController@getXoa');
    }); 
});

Route::get('trangchu','App\Http\Controllers\pagesController@trangchu');

Route::get('lienhe','App\Http\Controllers\pagesController@lienhe');

Route::get('loaitin/{id}','App\Http\Controllers\pagesController@loaitin');

Route::get('tintuc/{id}','App\Http\Controllers\pagesController@tintuc');

Route::get('dangnhap','App\Http\Controllers\userController@getdangnhap');

Route::post('dangnhap','App\Http\Controllers\userController@postdangnhap');

Route::get('dangxuat','App\Http\Controllers\userController@dangxuat');

Route::get('dangky','App\Http\Controllers\userController@getdangky');

Route::post('dangky','App\Http\Controllers\userController@postdangky');

Route::post('comment/{id}','App\Http\Controllers\CommentController@postComment');

Route::get('nguoidung','App\Http\Controllers\userController@getnguoidung');

Route::post('nguoidung','App\Http\Controllers\userController@postnguoidung');

Route::get('gioithieu','App\Http\Controllers\pagesController@gioithieu');

Route::post('timkiem','App\Http\Controllers\pagesController@timkiem');

Route::get('timkiem/{search}','App\Http\Controllers\pagesController@posttimkiem');