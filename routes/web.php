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
Route::namespace('Auth')->group(function(){
	Route::get('/',[
		'uses'=>'AuthController@showForm',
		'as'=>'quanlyvanban.auth.index'
	]);
	Route::post('/dang-nhap',[
		'uses'=>'AuthController@kiemTraDangNhap',
		'as'=>'quanlyvanban.auth.kiemtra'
	]);
});
// Quản lý văn bản
Route::namespace('quanlyvanban')->group(function(){
	Route::get('/trang-chu',[
		'uses'=>'TinNhanController@tinNhanMoiNhat',
		'as'=>'quanlyvanban.congvan.index'
	]);
	Route::get('/danh-sach-cong-van-den',[
		'uses'=>'CongVanController@danhSachCongVanDen',
		'as'=>'quanlyvanban.congvan.danhsachcongvanden'
	]);
	Route::get('/danh-sach-cong-van-den-nhan-su',[
		'uses'=>'CongVanController@danhSachCongVanDenCaNhan',
		'as'=>'quanlyvanban.congvan.danhsachcongvandennhansu'
	]);
	Route::get('/danh-sach-cong-van-den-don-vi',[
		'uses'=>'CongVanController@danhSachCongVanDenDonVi',
		'as'=>'quanlyvanban.congvan.danhsachcongvandendonvi'
	]);
	Route::get('/chi-tiet-van-ban',[
		'uses'=>'CongVanController@ChiTietVanBan',
		'as'=>'quanlyvanban.congvan.chitietvanban'
	]);
	Route::post('/danh-sach-cong-van-den',[
		'uses'=>'CongVanController@danhSachCongVanDen',
		'as'=>'quanlyvanban.congvan.danhsachcongvanden'
	]);
	Route::get('/danh-sach-cong-van-di',[
		'uses'=>'CongVanController@danhSachCongvanDi',
		'as'=>'quanlyvanban.congvan.danhsachcongvandi'
	]);
	Route::get('/danh-sach-cong-van-di-ca-nhan',[
		'uses'=>'CongVanController@danhSachCongVanDiNhanSu',
		'as'=>'quanlyvanban.congvan.danhsachcongvandinhansu'
	]);
	Route::get('/chi-tiet-cong-van-di-ca-nhan-{soCongVan}-{maNhanSu}',[
		'uses'=>'CongVanController@chiTietCongVanDiNhanSu',
		'as'=>'quanlyvanban.congvan.chitietcongvandinhansu'
	]);
	Route::get('/sua-cong-van-di-ca-nhan',[
		'uses'=>'CongVanController@getSuaCongVanDiNhanSu',
		'as'=>'quanlyvanban.congvan.suacongvandinhansu'
	]);
	Route::post('/xoa-cong-van-di-ca-nhan',[
		'uses'=>'CongVanController@xoaCongVanDiNhanSu',
		'as'=>'quanlyvanban.congvan.xoacongvandinhansu'
	]);
	Route::post('/danh-sach-cong-van-di',[
		'uses'=>'CongVanController@danhSachCongvanDi',
		'as'=>'quanlyvanban.congvan.danhsachcongvandi'
	]);
	Route::get('/gui-cong-van',[
		'uses'=>'CongVanController@getTaoMoiCongVan',
		'as'=>'quanlyvanban.congvan.taomoicongvan'
	]);
	//route này để tìm kiếm
	// Route::post('/gui-cong-van',[
	// 	'uses'=>'CongVanController@getTaoMoiCongVan',
	// 	'as'=>'quanlyvanban.congvan.taomoicongvan.timkiemnhansu'
	// ]);
	//
	Route::post('/gui-cong-van',[
		'uses'=>'CongVanController@postTaoMoiCongVan',
		'as'=>'quanlyvanban.congvan.taomoicongvan'
	]);
	Route::get('/phan-hoi-cong-van-{soCongVan}',[
		'uses'=>'CongVanController@getPhanHoiCongVan',
		'as'=>'quanlyvanban.congvan.phanhoicongvan'
	]);
	Route::post('/phan-hoi-cong-van-{soCongVan}',[
		'uses'=>'CongVanController@postPhanHoiCongVan',
		'as'=>'quanlyvanban.congvan.phanhoicongvan'
	]);
	//Tim kiem nang cao
	Route::get('/tim-kiem-nang-cao',[
		'uses' => 'CongVanController@danhSachCongVanDen_TimKiemnangCao',
		'as' => 'quanlyvanban.congvan.danhsachcongvanden.timkiemnangcao'
	]);
	//Các route cho biểu mẫu
	Route::get('/danh-sach-bieu-mau',[
		'uses'=>'BieuMauController@danhSachBieuMau',
		'as'=>'quanlyvanban.bieumau.danhsachbieumau'
	]);
	Route::get('/tao-moi-bieu-mau',[
		'uses'=>'BieuMauController@getTaoMoiBieuMau',
		'as'=>'quanlyvanban.bieumau.taomoibieumau'
	]);
	Route::post('/tao-moi-bieu-mau',[
		'uses'=>'BieuMauController@postTaoMoiBieuMau',
		'as'=>'quanlyvanban.bieumau.taomoibieumau'
	]);
	Route::get('/sua-bieu-mau-{id}',[
		'uses'=>'BieuMauController@getSuaBieuMau',
		'as'=>'quanlyvanban.bieumau.getsuabieumau'
	]);
	Route::post('/sua-bieu-mau',[
		'uses'=>'BieuMauController@postSuaBieuMau',
		'as'=>'quanlyvanban.bieumau.postsuabieumau'
	]);
	Route::post('/xoa-bieu-mau',[
		'uses'=>'BieuMauController@postXoaBieuMau',
		'as'=>'quanlyvanban.bieumau.xoabieumau'
	]);
	//các route cho nhân sự
	Route::get('/nhan-su-don-vi',[
		'uses'=>'NhanSuController@nhanSuDonVi',
		'as'=>'quanlyvanban.nhansu.nhansudonvi'
	]);
	Route::get('/chi-tiet-nhan-su-don-vi-{maNhanSu}',[
		'uses'=>'NhanSuController@chiTietNhanSuDonVi',
		'as'=>'quanlyvanban.nhansu.chitietnhansudonvi'
	]);
	//các route cho tin nhắn
	Route::get('/gui-tin-nhan',[
		'uses'=>'TinNhanController@getGuiTinNhan',
		'as'=>'quanlyvanban.guitinnhan.index',
	]);
	Route::post('/gui-tin-nhan',[
		'uses'=>'TinNhanController@postGuiTinNhan',
		'as'=>'quanlyvanban.guitinnhan.index',
	]);
	Route::get('/nhan-tin-nhan',[
		'uses'=>'TinNhanController@getNhanTinNhan',
		'as'=>'quanlyvanban.guitinnhan.nhantinnhan',
	]);
	Route::post('/nhan-tin-nhan',[
		'uses'=>'TinNhanController@postNhanTinNhan',
		'as'=>'quanlyvanban.guitinnhan.nhantinnhan',
	]);

	Route::get('/chi-tiet-tin-nhan/{id}',[
		'uses'=>'TinNhanController@chiTietTinNhan',
		'as'=>'quanlyvanban.guitinnhan.detail',
	]);


	//Chuyen tiep van ban
	//chuyen tiep ca nhan
	Route::post('/chuyen-tiep-van-ban-cho-ca-nhan',[
		'uses'=>'CongVanController@chuyenTiepVanBanCaNhan',
		'as'=>'quanlyvanban.congvan.chuyentiep.canhan',
	]);
	//chuyen tiep don vi
	Route::post('/chuyen-tiep-van-ban-cho-don-vi',[
		'uses'=>'CongVanController@chuyenTiepVanBanDonVi',
		'as'=>'quanlyvanban.congvan.chuyentiep.donvi'
	]);
});

//Admin
Route::namespace('Admin')->group(function(){
	Route::get('/admin-page', [
	    'uses' =>'IndexController@index',
	    'as' => 'admin.index'
	]);
	//nhan su
	Route::get('/admin/quanlynhansu', [
	    'uses' =>'NhanSuController@index',
	    'as' => 'admin.nhansu.index'
	]);
	Route::post('/admin/quanlynhansu', [
	    'uses' =>'NhanSuController@postsearch',
	    'as' => 'admin.nhansu.index'
	]);
	Route::get('/admin/quanlynhansu/them-nhan-su', [
	    'uses' =>'NhanSuController@add',
	    'as' => 'admin.nhansu.add'
	]);
	Route::post('/admin/quanlynhansu/them-nhan-su', [
	    'uses' =>'NhanSuController@postadd',
	    'as' => 'admin.nhansu.add'
	]);
	Route::get('/admin/quanlynhansu/xoa-nhan-su/{id}', [
	    'uses' =>'NhanSuController@delete',
	    'as' => 'admin.nhansu.delete'
	]);
	Route::get('/admin/quanlynhansu/sua-nhan-su/{id}', [
	    'uses' =>'NhanSuController@edit',
	    'as' => 'admin.nhansu.edit'
	]);
	Route::post('/admin/quanlynhansu/sua-nhan-su/{id}', [
	    'uses' =>'NhanSuController@postedit',
	    'as' => 'admin.nhansu.edit'
	]);
	//tai san
	Route::get('/admin/quanlytaisan', [
	    'uses' =>'TaiSanDonViController@index',
	    'as' => 'admin.taisan.index'
	]);

	Route::get('/admin/quanlytaisan/them-tai-san', [
	    'uses' =>'TaiSanDonViController@getAdd',
	    'as' => 'admin.taisan.add'
	]);
	Route::post('/admin/quanlytaisan/them-tai-san', [
	    'uses' =>'TaiSanDonViController@postAdd',
	    'as' => 'admin.taisan.add'
	]);

	Route::get('/admin/quanlytaisan/cap-nhat-tai-san/{maTaiSan}', [
	    'uses' =>'TaiSanDonViController@getEdit',
	    'as' => 'admin.taisan.update'
	]);
	Route::post('/admin/quanlytaisan/cap-nhat-tai-san/{maTaiSan}', [
	    'uses' =>'TaiSanDonViController@postEdit',
	    'as' => 'admin.taisan.update'
	]);

	Route::get('/admin/quanlytaisan/xoa-tai-san/{maTaiSan}', [
	    'uses' =>'TaiSanDonViController@delete',
	    'as' => 'admin.taisan.delete'
	]);

	Route::post('/admin/quanlytaisan/', [
	    'uses' =>'TaiSanDonViController@search',
	    'as' => 'admin.taisan.search'
	]);
});
//Đăng xuất
Route::get('/dang-xuat',function(){
	Session::flush();
	return redirect(url('/'));
});

//test
Route::get('/test',function(){
	return view('quanlyvanban.test.Success');
});