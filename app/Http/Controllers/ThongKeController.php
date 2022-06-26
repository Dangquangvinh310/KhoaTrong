<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NgayNghi;
use App\Models\HopDong;
class ThongKeController extends Controller
{
    public function danhSachDon()
    {
        $hopDongs =HopDong::orderBy('id', 'desc')->take(10)->get();
        if($hopDongs==null)
        {
            return back()->with('error','Không tìm thấy danh sách hợp đồng');
        }
        return view('thong-ke',compact('hopDongs'));
    }
}
