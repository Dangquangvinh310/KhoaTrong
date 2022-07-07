<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChucVu;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class ChucVuController extends Controller
{
    public function index()
    {
        $chucVus =ChucVu::all();
        if($chucVus==null)
        {
            return back()->with('error','Không tìm thấy danh sách chức vụ');
        }
        return view('chuc-vu/danh-sach',compact('chucVus'));
    }

    public function create()
    {
        return view('chuc-vu/them-moi');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten_chuc_vu'  => 'required|max:191|unique:App\Models\ChucVu,ten_chuc_vu,NULL,id,deleted_at,NULL',
            ],
            [   
                'ten_chuc_vu.required'      => 'Chưa nhập tên chức vụ',
                'ten_chuc_vu.max'           => 'Tên chức vụ vượt quá 191 ký tự',
                'ten_chuc_vu.unique'        => 'Tên chức vụ đã tồn tại',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        $chucVu = new ChucVu();
        $chucVu->ten_chuc_vu = $request->ten_chuc_vu;
        $chucVu->save();
        return redirect()->route('danh_sach_chuc_vu')->with('status','Thêm mới chức vụ thành công');
    }

    public function edit($id)
    {
        $chucVu=ChucVu::find($id);
        if($chucVu==null)
        {
            return redirect()->route('danh_sach_chuc_vu')->with('error','Không tìm thấy chức vụ này');
        }
        return view('chuc-vu/cap-nhat', compact('chucVu'));   
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'ten_chuc_vu'  => "required|unique:App\Models\ChucVu,ten_chuc_vu,{$id},id,deleted_at,NULL",
            ],
            [   
                'ten_chuc_vu.required'      => 'Chưa nhập tên chức vụ',
                'ten_chuc_vu.max'           => 'Tên chức vụ vượt quá 191 ký tự',
                'ten_chuc_vu.unique'        => 'Tên chức vụ đã tồn tại',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        $chucVu=ChucVu::find($id);
        if($chucVu==null)
        {
            return redirect()->route('danh_sach_chuc_vu')->with('error','Không tìm thấy chức vụ này');
        }
        $chucVu->ten_chuc_vu = $request->ten_chuc_vu;
        $chucVu->save();
        return redirect()->route('danh_sach_chuc_vu')->with('status','Cập nhật chức vụ thành công');
    }

    public function destroy($id)
    {
        try {
            $chucVu = ChucVu::find($id);
            $user = User::where('chuc_vu_id', $id)->first();
            if($user!==null)
            {
                return redirect()->route('danh_sach_chuc_vu')->with('error','Có nhân viên đang sử dụng chức vụ này');
            }
            else
            {
                ChucVu::destroy($id);
                return redirect()->route('danh_sach_chuc_vu')->with('status','Xoá thành công');    
            }
            
        } catch (Exception $e) {
            return redirect()->route('danh_sach_chuc_vu')->with('error','Xoá không thành công');

        }
    }
}
