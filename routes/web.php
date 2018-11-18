<?php

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

Route::get('index', [
	'as'=>'home-page',
	'uses'=>'PageController@getIndex'
]);
Route::get('productInfo/{id}', [
	'as'=>'productDetail',
	'uses'=>'PageController@getProduct'
]);
Route::get('search', [
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);
Route::get('productType/{type}', [
	'as'=>'productType',
	'uses'=>'PageController@getProductType'
]);

//authenticate
Route::get('login', ['as'=>'login', 'uses'=>'AuthenticateController@getLogin']);

Route::post('login', ['as'=>'login', 'uses'=>'AuthenticateController@postLogin']);

Route::get('signup', ['as'=>'signup', 'uses'=>'AuthenticateController@getSignup']);

Route::post('signup', ['as'=>'signup', 'uses'=>'AuthenticateController@postSignup']);

Route::get('logout', ['as'=>'logout', 'uses'=>'AuthenticateController@getLogout']);

Route::get('personal_information', ['as'=>'personal_information', 'uses'=>'AuthenticateController@getPersonalInformation']);

Route::get('change_information', ['as'=>'change_information', 'uses'=>'AuthenticateController@getChangeInformation']);

Route::post('change_information', ['as'=>'change_information', 'uses'=>'AuthenticateController@postChangeInformation']);

Route::get('change_password', ['as'=>'change_password', 'uses'=>'AuthenticateController@getChangePassword']);

Route::post('change_password', ['as'=>'change_password', 'uses'=>'AuthenticateController@postChangePassword']);

//cart
Route::get('add-to-cart/{id}', ['as'=>'add-to-cart', 'uses'=>'CartController@getAddToCart']);

Route::get('del-cart/{id}', ['as'=>'del-cart', 'uses'=>'CartController@getDelItemCart']);

//trang admin

Route::get('admin/dangnhap','AuthenticateController@getDangNhapAdmin');
Route::post('admin/dangnhap','AuthenticateController@postDangNhapAdmin');
Route::get('admin/logout', 'AuthenticateController@getDangXuatAdmin');

Route:: group(['prefix'=>'admin', 'middleware'=>'adminLogin'], function() {
	
	Route::group(['prefix'=>'theloai'], function() {
		Route::get('danhsach', 'TheLoaiController@getDanhSach');

		Route::get('them', 'TheLoaiController@getThem');

		Route::post('them', 'TheLoaiController@postThem');

		Route::get('sua/{id}', 'TheLoaiController@getSua');

		Route::post('sua/{id}', 'TheLoaiController@postSua');

		Route::get('xoa/{id}', 'TheLoaiController@getXoa');

	});

	Route::group(['prefix'=>'sanpham'], function() {
		Route::get('danhsach', 'SanPhamController@getDanhSach');

		Route::get('them', 'SanPhamController@getThem');

		Route::post('them', 'SanPhamController@postThem');

		Route::get('sua/{id}', 'SanPhamController@getSua');

		Route::post('sua/{id}', 'SanPhamController@postSua');

		Route::get('xoa/{id}', 'SanPhamController@getXoa');

	});

	Route::group(['prefix'=>'user'], function() {
		Route::get('danhsach', 'UserController@getDanhSach');

		Route::get('them', 'UserController@getThem');

		Route::post('them', 'UserController@postThem');

		Route::get('sua/{id}', 'UserController@getSua');

		Route::post('sua/{id}', 'UserController@postSua');

		Route::get('xoa/{id}', 'UserController@getXoa');

	});
	
});
