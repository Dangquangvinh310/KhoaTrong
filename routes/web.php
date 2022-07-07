<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\HopDongController;
use App\http\controllers\ChucVuController;
use App\http\controllers\PhongBanController;
use App\http\controllers\UserController;
use App\http\controllers\BHXHController;
use App\http\controllers\TuyenDungController;
use App\http\controllers\NgayNghiController;
use App\http\controllers\LuongController;
use App\http\controllers\ThongTinController;
use App\http\controllers\NghiViecController;
use App\http\controllers\ChamCongController;
use App\http\controllers\ThongKeController;
use App\http\controllers\KyluatController;
use App\http\controllers\KhenThuongController;

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



Route::middleware('guest')->group(function () {
    Route::get('/dang-nhap', [UserController::class, 'login'])->name('login');
    Route::post('/dang-nhap', [UserController::class, 'doLogin'])->name('do_login');
});

Route::middleware('auth')->group(function () {

Route::get('/dang-xuat', [UserController::class, 'logout'])->name('logout');

Route::get('/', [ThongKeController::class, 'danhSachDon'])->name('thong_ke');

Route::get('/danh-sach-hop-dong', [HopDongController::class, 'index'])->name('danh_sach_hop_dong');
Route::get('/them-moi-hop-dong', [HopDongController::class, 'create'])->name('them_moi_hop_dong');
Route::post('/them-moi-hop-dong', [HopDongController::class, 'store'])->name('xl_them_hop_dong');
Route::get('/cap-nhat-hop-dong/{id}',[HopDongController::class, 'edit'])->name('cap_nhat_hop_dong');
Route::post('/cap-nhat-hop-dong/{id}',[HopDongController::class, 'update'])->name('xl_cap_nhat_hop_dong');
Route::get('/xoa-hop-dong/{id}',[HopDongController::class, 'destroy'])->name('xoa_hop_dong');

Route::get('/danh-sach-chuc-vu', [ChucVuController::class, 'index'])->name('danh_sach_chuc_vu');
Route::get('/them-moi-chuc-vu', [ChucVuController::class, 'create'])->name('them_moi_chuc_vu');
Route::post('/them-moi-chuc-vu', [ChucVuController::class, 'store'])->name('xl_them_chuc_vu');
Route::get('/cap-nhat-chuc-vu/{id}',[ChucVuController::class, 'edit'])->name('cap_nhat_chuc_vu');
Route::post('/cap-nhat-chuc-vu/{id}',[ChucVuController::class, 'update'])->name('xl_cap_nhat_chuc_vu');
Route::get('/xoa-chuc-vu/{id}',[ChucVuController::class, 'destroy'])->name('xoa_chuc_vu');

Route::get('/danh-sach-phong-ban', [PhongBanController::class, 'index'])->name('danh_sach_phong_ban');
Route::get('/them-moi-phong-ban', [PhongBanController::class, 'create'])->name('them_moi_phong_ban');
Route::post('/them-moi-phong-ban', [PhongBanController::class, 'store'])->name('xl_them_phong_ban');
Route::get('/cap-nhat-phong-ban/{id}',[PhongBanController::class, 'edit'])->name('cap_nhat_phong_ban');
Route::post('/cap-nhat-phong-ban/{id}',[PhongBanController::class, 'update'])->name('xl_cap_nhat_phong_ban');
Route::get('/xoa-phong-ban/{id}',[PhongBanController::class, 'destroy'])->name('xoa_phong_ban');

Route::get('/danh-sach-khen-thuong', [KhenThuongController::class, 'index'])->name('danh_sach_khen_thuong');
Route::get('/them-moi-khen-thuong', [KhenThuongController::class, 'create'])->name('them_moi_khen_thuong');
Route::post('/them-moi-khen-thuong', [KhenThuongController::class, 'store'])->name('xl_them_khen_thuong');
Route::get('/cap-nhat-khen-thuong/{id}',[KhenThuongController::class, 'edit'])->name('cap_nhat_khen_thuong');
Route::post('/cap-nhat-khen-thuong/{id}',[KhenThuongController::class, 'update'])->name('xl_cap_nhat_khen_thuong');
Route::get('/xoa-khen-thuong/{id}',[KhenThuongController::class, 'destroy'])->name('xoa_khen_thuong');

Route::get('/danh-sach-ky-luat', [KyluatController::class, 'index'])->name('danh_sach_ky_luat');
Route::get('/them-moi-ky-luat', [KyluatController::class, 'create'])->name('them_moi_ky_luat');
Route::post('/them-moi-ky-luat', [KyluatController::class, 'store'])->name('xl_them_ky_luat');
Route::get('/cap-nhat-ky-luat/{id}',[KyluatController::class, 'edit'])->name('cap_nhat_ky_luat');
Route::post('/cap-nhat-ky-luat/{id}',[KyluatController::class, 'update'])->name('xl_cap_nhat_ky_luat');
Route::get('/xoa-ky-luat/{id}',[KyluatController::class, 'destroy'])->name('xoa_ky_luat');

Route::get('/danh-sach-nhan-vien', [UserController::class, 'index'])->name('danh_sach_nhan_vien');
Route::get('/them-moi-nhan-vien', [UserController::class, 'create'])->name('them_moi_nhan_vien');
Route::post('/them-moi-nhan-vien', [UserController::class, 'store'])->name('xl_them_nhan_vien');
Route::get('/cap-nhat-nhan-vien/{id}',[UserController::class, 'edit'])->name('cap_nhat_nhan_vien');
Route::post('/cap-nhat-nhan-vien/{id}',[UserController::class, 'update'])->name('xl_cap_nhat_nhan_vien');
Route::get('/xoa-nhan-vien/{id}',[UserController::class, 'destroy'])->name('xoa_nhan_vien');
Route::post('/tim-kiem-nhan-vien',[UserController::class, 'search'])->name('xl_tim_kiem_nhan_vien');


Route::get('/danh-sach-bhxh', [BHXHController::class, 'index'])->name('danh_sach_bhxh');

Route::get('/danh-sach-tuyen-dung', [TuyenDungController::class, 'index'])->name('danh_sach_tuyen_dung');
Route::get('/them-moi-tuyen-dung', [TuyenDungController::class, 'create'])->name('them_moi_tuyen_dung');
Route::post('/them-moi-tuyen-dung', [TuyenDungController::class, 'store'])->name('xl_them_tuyen_dung');
Route::get('/tuyen-dung/rot/{id}', [TuyenDungController::class, 'rot'])->name('tuyen_dung_rot');
Route::get('/tuyen-dung/dau/{id}', [TuyenDungController::class, 'dau'])->name('tuyen_dung_dau');
Route::get('/tuyen-dung/them-nhan-vien/{id}', [TuyenDungController::class, 'formThemNhanVien'])->name('them_nhan_vien_dau');
Route::post('/tuyen-dung/them-nhan-vien/{id}', [TuyenDungController::class, 'xuLyThem'])->name('xl_them_nhan_vien_dau');


Route::get('/danh-sach-ngay-nghi', [NgayNghiController::class, 'index'])->name('danh_sach_ngay_nghi');
Route::get('/them-moi-ngay-nghi', [NgayNghiController::class, 'create'])->name('them_moi_ngay_nghi');
Route::post('/them-moi-ngay-nghi', [NgayNghiController::class, 'store'])->name('xl_them_ngay_nghi');
Route::get('/cap-nhat-ngay-nghi/{id}',[NgayNghiController::class, 'edit'])->name('cap_nhat_ngay_nghi');
Route::post('/cap-nhat-ngay-nghi/{id}',[NgayNghiController::class, 'update'])->name('xl_cap_nhat_ngay_nghi');

Route::get('/danh-sach-ngay-nghi-cho-duyet', [NgayNghiController::class, 'danh_sach_ngay_nghi_cho_duyet'])->name('danh_sach_ngay_nghi_cho_duyet');
Route::get('/chap-nhan-don-xin-nghi/{id}', [NgayNghiController::class, 'duyet_don_nghi'])->name('duyet_don_nghi');
Route::get('/xoa-ngay-nghi/{id}',[NgayNghiController::class, 'destroy'])->name('xoa_ngay_nghi');

Route::get('/danh-sach-bang-luong', [LuongController::class, 'index'])->name('danh_sach_bang_luong');
Route::get('/them-moi-bang-luong', [LuongController::class, 'create'])->name('them_moi_bang_luong');
Route::post('/them-moi-bang-luong', [LuongController::class, 'store'])->name('xl_them_bang_luong');
Route::get('/cap-nhat-bang-luong/{id}',[LuongController::class, 'edit'])->name('cap_nhat_bang_luong');
Route::post('/cap-nhat-bang-luong/{id}',[LuongController::class, 'update'])->name('xl_cap_nhat_bang_luong');
Route::get('/xoa-bang-luong/{id}',[LuongController::class, 'destroy'])->name('xoa_bang_luong');


Route::get('/cap-nhat-thong-tin',[ThongTinController::class, 'edit'])->name('cap_nhat_thong_tin');
Route::post('/cap-nhat-thong-tin',[ThongTinController::class, 'update'])->name('xl_cap_nhat_thong_tin');
Route::post('/doi-mat-khau',[ThongTinController::class, 'changPass'])->name('xl_doi_mat_khau');


Route::get('/danh-sach-nghi-viec', [NghiViecController::class, 'index'])->name('danh_sach_nghi_viec');
Route::get('/them-moi-nghi-viec', [NghiViecController::class, 'create'])->name('them_moi_nghi_viec');
Route::post('/them-moi-nghi-viec', [NghiViecController::class, 'store'])->name('xl_them_nghi_viec');
Route::get('/cap-nhat-nghi-viec/{id}',[NghiViecController::class, 'edit'])->name('cap_nhat_nghi_viec');
Route::post('/cap-nhat-nghi-viec/{id}',[NghiViecController::class, 'update'])->name('xl_cap_nhat_nghi_viec');
Route::get('/danh-sach-nghi-viec-cho-duyet', [NghiViecController::class, 'danh_sach_ngay_nghi_cho_duyet'])->name('danh_sach_nghi_viec_cho_duyet');
Route::get('/chap-nhan-don-xin-nghi-viec/{id}', [NghiViecController::class, 'duyet_don_nghi'])->name('duyet_don_nghi_viec');
Route::get('/xoa-nghi-viec/{id}',[NghiViecController::class, 'destroy'])->name('xoa_nghi_viec');

Route::get('/danh-sach-cham-cong', [ChamCongController::class, 'index'])->name('danh_sach_cham_cong');
Route::get('/them-moi-cham-cong', [ChamCongController::class, 'create'])->name('them_moi_cham_cong');
Route::post('/them-moi-cham-cong', [ChamCongController::class, 'store'])->name('xl_them_cham_cong');
Route::get('/cap-nhat-cham-cong/{id}',[ChamCongController::class, 'edit'])->name('cap_nhat_cham_cong');
Route::post('/cap-nhat-cham-cong/{id}',[ChamCongController::class, 'update'])->name('xl_cap_nhat_cham_cong');
Route::get('/xoa-cham-cong/{id}',[ChamCongController::class, 'destroy'])->name('xoa_cham_cong');


Route::get('/danh-sach-khenthuong-kiluat', [KhenThuongKyLuatController::class, 'index'])->name('danh_sach_khenthuong_kyluat');
Route::get('/them-moi-khenthuong-kiluat', [KhenThuongKyLuatController::class, 'create'])->name('them_moi_khenthuong_kyluat');
Route::post('/them-moi-khenthuong-kiluat', [KhenThuongKyLuatController::class, 'store'])->name('xl_them_khenthuong_kyluat');
Route::get('/cap-nhat-khenthuong-kiluat/{id}',[KhenThuongKyLuatController::class, 'edit'])->name('cap_nhat_khenthuong_kyluat');
Route::post('/cap-nhat-khenthuong-kiluat/{id}',[KhenThuongKyLuatController::class, 'update'])->name('xl_cap_nhat_khenthuong_kyluat');
Route::get('/xoa-khenthuong-kiluat/{id}',[KhenThuongKyLuatController::class, 'destroy'])->name('xoa_khenthuong_kyluat');

});

        