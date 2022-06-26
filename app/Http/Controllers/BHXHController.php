<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BHXHController extends Controller
{
    public function index()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
            $users =User::all();
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $users = User::where('phong_ban_id', $phongBan->id)->get();
        }
        else{
            $users =User::where('id',auth()->user()->id)->get();
        }
        if($users==null)
        {
            return back()->with('error','Không tìm thấy danh sách nhân viên');
        }
        return view('bhxh/danh-sach',compact('users'));
    }
}
