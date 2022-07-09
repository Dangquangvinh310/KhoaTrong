<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NgayNghi;
use App\Models\XacNhan;
use App\Models\HopDong;
use App\Models\User;
use App\Models\TinTuc;
use App\Models\KhenThuong;
use App\Models\KyLuat;
use App\Models\PhongBan;
class ThongKeController extends Controller
{
    public function danhSachDon()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
             $hopDongs = User::where('id','>',0)->whereHas('hopDong')->with('hopDong')->take(10)->get();
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $hopDongs = User::where('phong_ban_id', $phongBan->id)->whereHas('hopDong')->with('hopDong')->take(10)->get();
        }
        else{
            $hopDongs =User::where('id',auth()->user()->id)->whereHas('hopDong')->with('hopDong')->get();
        }
        if($hopDongs==null)
        {
            return back()->with('error','Không tìm thấy danh sách hợp đồng');
        }

        $phongBan = PhongBan::find(auth()->user()->phong_ban_id);
        $khenThuongs = KhenThuong::where('user_id',auth()->user()->id)->get();
        $kyLuats = KyLuat::where('user_id',auth()->user()->id)->get();

        $thongTinChoCapNhats = XacNhan::where('trang_thai', '1')->get();
        $tinTucs = TinTuc::all();
        return view('thong-ke',compact('hopDongs','thongTinChoCapNhats','tinTucs','phongBan','khenThuongs','kyLuats'));
    }

    public function thongTinChoDuyet($id)
    {
        $thongTinChoCapNhat = XacNhan::find($id);
        return view('thong-tin-cho-duyet',compact('thongTinChoCapNhat'));
    }

    public function xlDuyet($id)
    {
        $thongTinChoCapNhat = XacNhan::find($id);
        $thongTinChoCapNhat->trang_thai ='2';
        $thongTinChoCapNhat->save();

        $user = User::find($thongTinChoCapNhat->user_id);
        $user->ho_ten = $thongTinChoCapNhat->ho_ten;
        $user->cmnd = $thongTinChoCapNhat->cmnd;
        $user->ngay_sinh = $thongTinChoCapNhat->ngay_sinh;
        $user->gioi_tinh = $thongTinChoCapNhat->gioi_tinh;
        $user->dia_chi = $thongTinChoCapNhat->dia_chi;
        $user->so_dien_thoai = $thongTinChoCapNhat->so_dien_thoai;
        $user->email = $thongTinChoCapNhat->email;
        $user->ma_bhxh = $thongTinChoCapNhat->ma_bhxh;
        $user->ngay_cap = $thongTinChoCapNhat->ngay_cap;
        $user->ngay_het_han = $thongTinChoCapNhat->ngay_het_han;
        $user->save();
       
        return redirect()->route('thong_ke')->with('status','Đã duyệt');
    }

}
