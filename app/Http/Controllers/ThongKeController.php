<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NgayNghi;
use App\Models\HopDong;
use App\Models\User;
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
        return view('thong-ke',compact('hopDongs'));
    }
}
