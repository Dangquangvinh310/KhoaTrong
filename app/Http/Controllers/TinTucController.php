<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
class TinTucController extends Controller
{
    public function index()
    {
        $tinTucs =TinTuc::all();
        if($tinTucs==null)
        {
            return back()->with('error','Không tìm thấy danh sách tin tức');
        }
        return view('tin-tuc/danh-sach',compact('tinTucs'));
    }

    public function create()
    {
        return view('tin-tuc/them-moi');
    }

    public function store(Request $request)
    {
        $tinTuc = new TinTuc();
        $tinTuc->tieu_de = $request->tieu_de;
        $tinTuc->noi_dung = $request->noi_dung;
        $tinTuc->save();
        return redirect()->route('danh_sach_tin_tuc')->with('status','Thêm mới tin tức thành công');
    }

    public function edit($id)
    {
        $tinTuc=TinTuc::find($id);
        if($tinTuc==null)
        {
            return redirect()->route('danh_sach_tin_tuc')->with('error','Không tìm thấy tin tức này');
        }
        return view('tin-tuc/cap-nhat', compact('tinTuc'));   
    }

    public function update(Request $request,$id)
    { 
        $tinTuc=TinTuc::find($id);
        if($tinTuc==null)
        {
            return redirect()->route('danh_sach_tin_tuc')->with('error','Không tìm thấy tin tức này');
        }
        $tinTuc->tieu_de = $request->tieu_de;
        $tinTuc->noi_dung = $request->noi_dung;
        $tinTuc->save();
        return redirect()->route('danh_sach_tin_tuc')->with('status','Cập nhật tin tức thành công');
    }

    public function destroy(Request $request)
    {
        try {
            TinTuc::destroy($request->id);
            return redirect()->route('danh_sach_tin_tuc')->with('status','Xoá thành công'); 
        } catch (Exception $e) {
            return redirect()->route('danh_sach_tin_tuc')->with('error','Xoá không thành công');
        }
    }
}
