<?php

namespace App\Http\Controllers;
use App\Models\KhenThuongKiLuat;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\PhongBan;
use Illuminate\Http\Request;

class KhenThuongKyLuatController extends Controller
{
    public function index()
    {
        // $khenThuongKyLuats =khenThuongKyLuat::all(); 
        // if($khenThuongKyLuats==null)
        // {
        //     return back()->with('error','Không tìm thấy danh sách hợp đồng');
        // }
        // return view('khenthuong-kyluat/danh-sach',compact('khenThuongKyLuats'));



        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
             $khenThuongKyLuats = User::where('id','>',0)->whereHas('khenThuongKyLuat')->with('khenThuongKyLuat') ->get();
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $khenThuongKyLuats = User::where('phong_ban_id', $phongBan->id)->whereHas('khenThuongKyLuat')->with('khenThuongKyLuat') ->get();
        }
        else{
            $khenThuongKyLuats =User::where('id',auth()->user()->id)->whereHas('khenThuongKyLuat')->with('khenThuongKyLuat') ->get();
        }
        if($khenThuongKyLuats==null)
        {
            return back()->with('error','Không tìm thấy danh sách hợp đồng');
        }
        // dd($khenThuongKyLuats);
        return view('khenthuong-kyluat/danh-sach',compact('khenThuongKyLuats'));
    }

    public function create()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
             $users = User::where('id','>',0)->whereHas('khenThuongKyLuat')->with('khenThuongKyLuat') ->get();
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $users = User::where('phong_ban_id', $phongBan->id)->whereHas('khenThuongKyLuat')->with('khenThuongKyLuat') ->get();
        }
        else{
            $users =User::where('id',auth()->user()->id)->whereHas('khenThuongKyLuat')->with('khenThuongKyLuat') ->get();
        }
        return view('khenthuong-kyluat/them-moi',compact('users'));
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
        $khenThuongKyLuat = new KhenThuongKiLuat();
        $khenThuongKyLuat->user_id = $request->user_id;
        $khenThuongKyLuat->ngay_ki_hop_dong = $request->ngay_ki_hop_dong;
        $khenThuongKyLuat->ngay_bat_dau = $request->ngay_bat_dau;
        $khenThuongKyLuat->ngay_ket_thuc = $request->ngay_ket_thuc;
        $khenThuongKyLuat->noi_dung = $request->noi_dung;
        $khenThuongKyLuat->save();
        return redirect()->route('danh_sach_hop_dong')->with('status','Thêm mới hợp đồng thành công');
    }

    public function edit($id)
    {
        $khenThuongKyLuat=KhenThuongKiLuat::find($id);
        $users=User::all();
        if($khenThuongKyLuat==null)
        {
            return redirect()->route('danh_sach_hop_dong')->with('error','Không tìm thấy hợp đồng này');
        }
        return view('khenthuong-kyluat/cap-nhat', compact('khenThuongKyLuat','users'));   
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
        $khenThuongKyLuat=KhenThuongKiLuat::find($id);
        if($khenThuongKyLuat==null)
        {
            return redirect()->route('danh_sach_hop_dong')->with('error','Không tìm thấy hợp đồng này');
        }
        $khenThuongKyLuat->user_id = $request->user_id;
        $khenThuongKyLuat->ngay_ki_hop_dong = $request->ngay_ki_hop_dong;
        $khenThuongKyLuat->ngay_bat_dau = $request->ngay_bat_dau;
        $khenThuongKyLuat->ngay_ket_thuc = $request->ngay_ket_thuc;
        $khenThuongKyLuat->noi_dung = $request->noi_dung;
        $khenThuongKyLuat->save();
        return redirect()->route('danh_sach_hop_dong')->with('status','Cập nhật hợp đồng thành công');
    }
    public function destroy(Request $request)
    {
          $khenThuongKyLuat =  KhenThuongKiLuat::find($request->id);
          if(empty($khenThuongKyLuat))
          {
            return redirect()->route('danh_sach_hop_dong')->with('error',"Không tìm thấy hợp đồng ! $request->id");
          }
          else
          {
            $khenThuongKyLuat->delete();
            if($khenThuongKyLuat)
            {
                return redirect()->route('danh_sach_hop_dong')->with('status',"Xoá thành công");
            }else{
                return redirect()->route('danh_sach_hop_dong')->with('error',"Xoá không thành công");

            }
          }

       
    }
}
