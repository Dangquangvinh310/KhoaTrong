<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TuyenDung;
use App\Models\User;
use App\Models\PhongBan;
use App\Models\ChucVu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TuyenDungController extends Controller
{
    public function index()
    {
        $tuyenDungs =TuyenDung::all();
        if($tuyenDungs==null)
        {
            return back()->with('error','Không tìm thấy danh sách tuyển dụng');
        }
        return view('tuyen-dung/danh-sach',compact('tuyenDungs'));
    }

    public function create()
    {
        $users =User::all();
        $phongBans =PhongBan::all();
        $chucVus =ChucVu::all();
        return view('tuyen-dung/them-moi',compact('users','phongBans', 'chucVus'));
    }

    public function store(Request $request)
    {
        $tuyenDung = new TuyenDung();
        $tuyenDung->user_id = $request->user_id;
        $tuyenDung->ho_ten = $request->ho_ten;
        $tuyenDung->ngay_tuyen = $request->ngay_tuyen;
        if ($request->hasFile('cv')) {
            $image = $request->file('cv');
            $ex=  $request->file('cv')->extension();
            $file_name= time() . '.'.$ex;
            $storedPath = $image->storeAs('fileCV', $file_name);
            $tuyenDung->cv=$file_name;
        }
        $tuyenDung->save();
        return redirect()->route('danh_sach_tuyen_dung')->with('status','Đã đánh rớt');
    }

    public function rot($id)
    {
        $tuyenDung = TuyenDung::find($id);
        $tuyenDung->trang_thai = "Rớt";
        $tuyenDung->save();
        return redirect()->route('danh_sach_tuyen_dung')->with('status','Đã đánh rớt');
    }

    public function dau($id)
    {
        $tuyenDung = TuyenDung::find($id);
        $phongBans = PhongBan::all();
        $chucVus = ChucVu::all();
        return view('tuyen-dung/them-moi-nhan-vien',compact('tuyenDung','phongBans','chucVus'));
    }

    public function xuLyThem(Request $request,$id)
    {
        $tuyenDung = TuyenDung::find($id);
        $tuyenDung->trang_thai="Đậu";
        $tuyenDung->save();
        $validator = Validator::make($request->all(), [
            'ma_nhan_vien'  => 'required|max:191|unique:App\Models\User,ma_nhan_vien,NULL,id,deleted_at,NULL',
            'username'      => 'required|max:191|unique:App\Models\User,username,NULL,id,deleted_at,NULL',
            'password'      => 'required|min:6|max:191',
            'ho_ten'        => 'required|max:191',
            'cmnd'          => 'max:191',
            'dia_chi'       => 'max:191',
            'so_dien_thoai' => 'max:191',
            'email'         => 'max:191',
            'ma_bhxh'       => 'max:191',
            'chuc_vu_id'    => 'required',
            'phong_ban_id'  => 'required',
            ],
            [   
                'ma_nhan_vien.required'   => 'Chưa nhập mã nhân viên',
                'ma_nhan_vien.max'        => 'Mã nhân viên vượt quá 191 ký tự',
                'ma_nhan_vien.unique'     => 'Mã nhân viên đã tồn tại',
                'username.required'       => 'Chưa nhập tên đăng nhập',
                'username.unique'         => 'Tên đăng nhập đã tồn tại',
                'username.max'            => 'Tên đăng nhập vượt quá 191 ký tự',
                'password.required'       => 'Chưa nhập mật khẩu',
                'password.min'            => 'Mật khẩu chưa đủ 6 kí tự',
                'password.max'            => 'Mật khẩu vượt quá 191 kí tự',
                'ho_ten.required'         => 'Chưa nhập họ tên',
                'ho_ten.max'              => 'Họ tên vượt quá 191 kí tự',
                'cmnd.max'                => 'CMND/CCCD vượt quá 191 kí tự',
                'dia_chi.max'             => 'Địa chỉ vượt quá 191 kí tự',
                'so_dien_thoai.max'       => 'Số điện thoại vượt quá 191 kí tự',
                'email.max'               => 'Email vượt quá 191 kí tự',
                'ma_bhxh.max'             => 'Mã bhxh vượt quá 191 kí tự',
                'chuc_vu_id.required'     => 'Chưa chọn chức vụ',
                'phong_ban_id.required'   => 'Chưa chọn phòng ban',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        $user = new User();
        $user->ma_nhan_vien = $request->ma_nhan_vien;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->ho_ten = $request->ho_ten;
        $user->cmnd = $request->cmnd;
        $user->ngay_sinh = $request->ngay_sinh;
        $user->gioi_tinh = $request->gioi_tinh;
        $user->dia_chi = $request->dia_chi;
        $user->so_dien_thoai = $request->so_dien_thoai;
        $user->email = $request->email;
        $user->ma_bhxh = $request->ma_bhxh;
        $user->ngay_cap = $request->ngay_cap;
        $user->ngay_het_han = $request->ngay_het_han;
        $user->chuc_vu_id = $request->chuc_vu_id;
        $user->ngay_nhan_chuc = $request->ngay_nhan_chuc;
        $user->phong_ban_id = $request->phong_ban_id;
        
        $user->save();
        return redirect()->route('danh_sach_nhan_vien')->with('status','Thêm mới nhân viên thành công');
    }
    public function destroy(Request $request)
    {
        try {
            TuyenDung::destroy($request->id);
            return redirect()->route('danh_sach_tuyen_dung')->with('error','Xoá thành công');

        } catch (Exception $e) {
            return redirect()->route('danh_sach_tuyen_dung')->with('error','Xoá không thành công');

        }
    }
}
