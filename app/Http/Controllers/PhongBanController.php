<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhongBan;
use App\Models\User;
use App\Models\ChucVu;
use Illuminate\Support\Facades\Validator;

class PhongBanController extends Controller
{
    public function index()
    {
        $phongBans =PhongBan::all();
        if($phongBans==null)
        {
            return back()->with('error','Không tìm thấy danh sách phòng ban');
        }
        return view('phong-ban/danh-sach',compact('phongBans'));
    }

    public function create()
    {
        $users=User::where('id', '!=', 1)->get();
        return view('phong-ban/them-moi',compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten_phong_ban'  => 'required|max:191|unique:App\Models\PhongBan,ten_phong_ban,NULL,id,deleted_at,NULL',
            // 'user_id'        => 'required|unique:App\Models\PhongBan,user_id,NULL,id,deleted_at,NULL',
            ],
            [   
                'ten_phong_ban.required'      => 'Chưa nhập tên phòng ban',
                'ten_phong_ban.max'           => 'Tên phòng ban vượt quá 191 ký tự',
                'ten_phong_ban.unique'        => 'Tên phòng ban đã tồn tại',
                'user_id.required'            => 'Chưa chọn trưởng phòng',
                'user_id.unique'              => 'Nhân viên này hiện là trưởng phòng của phòng ban khác',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }

        // $chucVu = ChucVu::where('ten_chuc_vu', 'Trưởng phòng')->first();
        // $user = User::find($request->user_id);
        // $user->chuc_vu_id = $chucVu->id;
        // $user->save();

        $phongBan = new PhongBan();
        // $phongBan->user_id = $request->user_id;
        $phongBan->ten_phong_ban = $request->ten_phong_ban;
        $phongBan->save();
        return redirect()->route('danh_sach_phong_ban')->with('status','Thêm mới phòng ban thành công');
    }

    public function edit($id)
    {
        $phongBan=PhongBan::find($id);
        $users=User::where('id', '!=', 1)->get();
        if($phongBan==null)
        {
            return redirect()->route('danh_sach_phong_ban')->with('error','Không tìm thấy phòng ban này');
        }
        return view('phong-ban/cap-nhat', compact('phongBan','users'));   
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'ten_phong_ban'  => "required|max:191|unique:App\Models\PhongBan,ten_phong_ban,{$id},id,deleted_at,NULL",
             'user_id'        => "required|unique:App\Models\PhongBan,user_id,{$id},id,deleted_at,NULL",
            ],
            [   
                'ten_phong_ban.required'      => 'Chưa nhập tên phòng ban',
                'ten_phong_ban.max'           => 'Tên phòng ban vượt quá 191 ký tự',
                'ten_phong_ban.unique'        => 'Tên phòng ban đã tồn tại',
                'user_id.required'            => 'Chưa chọn trưởng phòng',
                'user_id.unique'              => 'Nhân viên này hiện là trưởng phòng của phòng ban khác',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }

        $chucVuNhanVien = ChucVu::where('ten_chuc_vu', 'Nhân viên')->first();
        $chucVuTruongPhong = ChucVu::where('ten_chuc_vu', 'Trưởng phòng')->first();
        $userNew = User::find($request->user_id);
        // dd($chucVuNhanVien);
        $phongBan=PhongBan::find($id);
        $userOld = User::find($phongBan->user_id);
        if($request->user_id != null)
        {
            if($phongBan->user_id != $userNew->id)
            {
                $userNew->chuc_vu_id = $chucVuTruongPhong->id;
                $userNew->phong_ban_id = $id;
                if(($userOld != null))
                {
                    // dd($chucVuNhanVien->id);
                    $userOld->chuc_vu_id = $chucVuNhanVien->id;
                    $userOld->phong_ban_id = $id;
                    $userOld->save();
                }
                $userNew->save();
            }
    }
    else{
        $userOld->chuc_vu_id = $chucVuNhanVien->id;
        $userOld->phong_ban_id = $id;
        $userOld->save();
    }
        if($phongBan==null)
        {
            return redirect()->route('danh_sach_phong_ban')->with('error','Không tìm thấy phòng ban này');
        }
        $phongBan->user_id = $request->user_id;
        $phongBan->ten_phong_ban = $request->ten_phong_ban;
        $phongBan->save();
        return redirect()->route('danh_sach_phong_ban')->with('status','Cập nhật phòng ban thành công');
    }
    public function destroy($id)
    {
            $phongBan = PhongBan::find($id);
            $user = User::where('phong_ban_id', $phongBan->id)->first();
            if($user!==null)
            {
                return redirect()->route('danh_sach_phong_ban')->with('error','Có nhân viên đang sử dụng phòng ban này');
            }
            else
            {
                $phongBan->delete();
                return redirect()->route('danh_sach_phong_ban')->with('status','Xoá thành công');  
            }
        
    }
}
