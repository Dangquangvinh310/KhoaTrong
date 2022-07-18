<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\XacNhan;
use App\Models\PhongBan;
use App\Models\ChucVu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ThongTinController extends Controller
{
    public function edit()
    {
        $user = User::find(auth()->user()->id);
        $phongBans =PhongBan::all();
        $chucVus =ChucVu::all();
        $thongTinChoCapNhat = XacNhan::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();
        if($user==null)
        {
            return back()->with('error','Không tìm thấy thông tin');
        }
        return view('thong-tin-ca-nhan/cap-nhat', compact('user','phongBans','chucVus','thongTinChoCapNhat'));   
    }

    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'ho_ten'        => 'required|max:191',
            'cmnd'          => 'max:191',
            'dia_chi'       => 'max:191',
            'so_dien_thoai' => 'max:191',
            'email'         => 'max:191',
            'ma_bhxh'       => 'max:191',
            ],
            [   
                'ho_ten.required'         => 'Chưa nhập họ tên',
                'ho_ten.max'              => 'Họ tên vượt quá 191 kí tự',
                'cmnd.max'                => 'CMND/CCCD vượt quá 191 kí tự',
                'dia_chi.max'             => 'Địa chỉ vượt quá 191 kí tự',
                'so_dien_thoai.max'       => 'Số điện thoại vượt quá 191 kí tự',
                'email.max'               => 'Email vượt quá 191 kí tự',
                'ma_bhxh.max'             => 'Mã bhxh vượt quá 191 kí tự',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
            $user = User::find(auth()->user()->id);

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
            $user->save();
            return back()->with('status','Cập nhật thành công');
        }
        else
        {
            $user = new XacNhan();
            if($user==null)
            {
                return back()->with('error','Không tìm thấy nhân viên này');
            }
            $user->user_id = auth()->user()->id;
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
            $user->trang_thai = '1';
            $user->save();
            return back()->with('status','Đang chờ duyệt');
        }
    }

    public function changPass(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required|max:191',
                'new_password' => 'required|min:6|max:191',
                'enter_new_pass' => 'required|max:191',
            ],
            [
                'password.required' => 'Chưa nhập mật khẩu cũ',
                'password.max' => 'Nhập mật khẩu tối đa 191 kí tự',
                'new_password.required' => 'Chưa nhập mật khẩu mới',
                'new_password.max' => 'Nhập mật khẩu mới từ 6 đến 191 kí tự',
                'new_password.min' => 'Nhập mật khẩu mới từ 6 đến 191 kí tự',
                'enter_new_pass.required' => 'Chưa nhập lại mật khẩu mới',
                'new_password.max' => 'Nhập lại mật khẩu tối đa 191 kí tự',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        $user = User::find(auth()->user()->id);
        if($user==null)
        {
            return back()->with('error','Không tìm thấy nhân viên này');
        }
        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->with('error','Mật khẩu sai! Hãy nhập lại');
        }
        elseif ($request->new_password != $request->enter_new_pass) {
            return back()->with('error','Mật khẩu không trùng khớp! Hãy nhập lại');
        }
        elseif(Hash::check($request->new_password, auth()->user()->password)){
            return back()->with('error','Mật khẩu không được trùng với mật khẩu trước đó');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('status','Cập nhật mật khẩu thành công');
    }
}
