<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HopDong;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class HopDongController extends Controller
{
    public function index()
    {
        $hopDongs =HopDong::all();
        if($hopDongs==null)
        {
            return back()->with('error','Không tìm thấy danh sách hợp đồng');
        }
        return view('hop-dong/danh-sach',compact('hopDongs'));
    }

    public function create()
    {
        $users =User::all();
        return view('hop-dong/them-moi',compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'               => 'required',
            'ngay_ki_hop_dong'      => 'required',
            'ngay_bat_dau'          => 'required',
            'ngay_ket_thuc'         => 'required',
            'noi_dung'              => 'max:191',
            ],
            [   
                'user_id.required'              => 'Chưa chọn nhân viên',
                'ngay_ki_hop_dong.required'     => 'Chưa chọn ngày kí hợp đồng',
                'ngay_bat_dau.required'         => 'Chưa chọn ngày bắt đầu',
                'ngay_ket_thuc.required'        => 'Chưa chọn ngày kết thúc',
                'noi_dung.max'                  => 'Nội dung vượt quá 191 kí tự',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        $hopDong = new HopDong();
        $hopDong->user_id = $request->user_id;
        $hopDong->ngay_ki_hop_dong = $request->ngay_ki_hop_dong;
        $hopDong->ngay_bat_dau = $request->ngay_bat_dau;
        $hopDong->ngay_ket_thuc = $request->ngay_ket_thuc;
        $hopDong->noi_dung = $request->noi_dung;
        $hopDong->save();
        return redirect()->route('danh_sach_hop_dong')->with('status','Thêm mới hợp đồng thành công');
    }

    public function edit($id)
    {
        $hopDong=HopDong::find($id);
        $users=User::all();
        if($hopDong==null)
        {
            return redirect()->route('danh_sach_hop_dong')->with('error','Không tìm thấy hợp đồng này');
        }
        return view('hop-dong/cap-nhat', compact('hopDong','users'));   
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'user_id'               => 'required',
            'ngay_ki_hop_dong'      => 'required',
            'ngay_bat_dau'          => 'required',
            'ngay_ket_thuc'         => 'required',
            'noi_dung'              => 'max:191',
            ],
            [   
                'user_id.required'              => 'Chưa chọn nhân viên',
                'ngay_ki_hop_dong.required'     => 'Chưa chọn ngày kí hợp đồng',
                'ngay_bat_dau.required'         => 'Chưa chọn ngày bắt đầu',
                'ngay_ket_thuc.required'        => 'Chưa chọn ngày kết thúc',
                'noi_dung.max'                  => 'Nội dung vượt quá 191 kí tự',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
        $hopDong=HopDong::find($id);
        if($hopDong==null)
        {
            return redirect()->route('danh_sach_hop_dong')->with('error','Không tìm thấy hợp đồng này');
        }
        $hopDong->user_id = $request->user_id;
        $hopDong->ngay_ki_hop_dong = $request->ngay_ki_hop_dong;
        $hopDong->ngay_bat_dau = $request->ngay_bat_dau;
        $hopDong->ngay_ket_thuc = $request->ngay_ket_thuc;
        $hopDong->noi_dung = $request->noi_dung;
        $hopDong->save();
        return redirect()->route('danh_sach_hop_dong')->with('status','Cập nhật hợp đồng thành công');
    }
    public function destroy(Request $request)
    {
        try {
            HopDong::destroy($request->id);
            return redirect()->route('danh_sach_hop_dong')->with('status','Xoá thành công');

        } catch (Exception $e) {
            return redirect()->route('danh_sach_hop_dong')->with('error','Xoá không thành công');

        }
    }
}
