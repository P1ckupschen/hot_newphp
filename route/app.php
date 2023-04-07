<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
Route::get('think', function () {
    return 'hello,ThinkPHP6!';
})->middleware(\thans\jwt\middleware\JWTAuth::class);
Route::get('hello/:name', 'index/hello');
//Route::group('user/',function (){
//
//});
//用户登录 用户名密码校验
Route::post('user/login', 'admin.Index/login');
//用户注销
Route::get('logout','admin.index/logout');
Route::group("admin/api", function(){
    Route::get("user/info",'admin.index/userinfo');
    Route::get("hardware/getcategorylist",'admin.hardware/getcategorylist');
    Route::get("hardware/geteqmentlist",'admin.hardware/geteqmentlist');
    Route::get('hardware/getproducts', 'admin.hardware/getproducts');
    Route::delete('hardware/deleteproducts','admin.hardware/deleteproductsbyids');
//    Route::post('hardware/insertproduct','admin.hardware/insertproduct');
    Route::post('hardware/insertproductwithpic','admin.hardware/insertproductwithpic');
    Route::delete('hardware/deletecategorybyid','admin.hardware/deletecategorybyid');
    //类型修改
    Route::put('hardware/commitupdate','admin.hardware/commitupdate');
    Route::post('hardware/commitinsert','admin.hardware/commitinsert');
    //产品信息修改
    Route::put('hardware/updateproduct','admin.hardware/updateproduct');
    //产品图片上传
    Route::post('hardware/uploadproductpic','admin.hardware/uploadproductpic');
    //设备添加
    Route::post('hardware/insertequipment','admin.hardware/insertequipment');
    //设备中心信息修改
    Route::put('hardware/updateequipment','admin.hardware/updateequipment');
    //设备中心删除
    Route::delete('hardware/deleteequipment','admin.hardware/deleteequipment');
})->middleware(\thans\jwt\middleware\JWTAuth::class)->allowCrossDomain(['Authorization']);
//设备中心图片上传
Route::post('common/uploadpic','admin.common/uploadpic');

Route::view('home/index','home.index/index');
Route::group("company/api", function(){
    Route::get("company/getcertificatelist",'admin.company/getcertificatelist');
    Route::delete('company/deletecertificate','admin.company/deletecertificate');
    Route::post('company/insertcertificate','admin.company/insertcertificate');
    Route::put('company/updatecertificate','admin.company/updatecertificate');
})->middleware(\thans\jwt\middleware\JWTAuth::class)->allowCrossDomain(['Authorization']);


Route::get('website/about', 'website/about');
Route::get('website/product', 'website/product');
Route::get('website/equipment', 'website/equipment');
Route::get('website/certs', 'website/certs');
Route::get('website/contact', 'website/contact');
Route::get('website', 'website/home');
