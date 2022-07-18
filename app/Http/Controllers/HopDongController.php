<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HopDong;
use App\Models\ChucVu;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\PhongBan;

class HopDongController extends Controller
{
    public function index()
    {
        // $hopDongs =HopDong::all(); 
        // if($hopDongs==null)
        // {
        //     return back()->with('error','Không tìm thấy danh sách hợp đồng');
        // }
        // return view('hop-dong/danh-sach',compact('hopDongs'));



        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
            $chucVu = ChucVu::where('ten_chuc_vu', 'Giám đốc')->first();
             $hopDongs = User::where('chuc_vu_id','!=',$chucVu->id)->whereHas('hopDong')->with('hopDong') ->get();
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $hopDongs = User::where('phong_ban_id', $phongBan->id)->whereHas('hopDong')->with('hopDong')->get();
        }
        else{
            $hopDongs =User::where('id',auth()->user()->id)->whereHas('hopDong')->with('hopDong') ->get();
        }
        if($hopDongs==null)
        {
            return back()->with('error','Không tìm thấy danh sách hợp đồng');
        }
        return view('hop-dong/danh-sach',compact('hopDongs'));
    }

    public function create()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
            $chucVu = ChucVu::where('ten_chuc_vu', 'Giám đốc')->first();
            $users = User::where('chuc_vu_id','!=', $chucVu->id)->get();
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $users = User::where('id','!=', auth()->user()->id)->where('phong_ban_id', $phongBan->id)->get();
        }
        else{
            $users =User::where('id',auth()->user()->id)->get();
        }
        return view('hop-dong/them-moi',compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'               => 'required',
            'ngay_ki_hop_dong'      => 'required',
            'ngay_bat_dau'          => 'required',
            'noi_dung'              => 'max:191',
            'luong'                 => 'required|max:19',
            ],
            [   
                'user_id.required'              => 'Chưa chọn nhân viên',
                'ngay_ki_hop_dong.required'     => 'Chưa chọn ngày kí hợp đồng',
                'ngay_bat_dau.required'         => 'Chưa chọn ngày bắt đầu',
                'noi_dung.max'                  => 'Nội dung vượt quá 191 kí tự',
                'luong.required'                => 'Chưa nhập lương',
                'luong.max'                     => 'Lương vượt quá 19 kí tự',
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
        $hopDong->luong = $request->luong;
        $hopDong->save();
        return redirect()->route('danh_sach_hop_dong')->with('status','Thêm mới hợp đồng thành công');
    }

    public function edit($id)
    {
        $hopDong=HopDong::find($id);
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
            $chucVu = ChucVu::where('ten_chuc_vu', 'Giám đốc')->first();
            $users = User::where('chuc_vu_id','!=', $chucVu->id)->get();
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $users = User::where('id','!=', auth()->user()->id)->where('phong_ban_id', $phongBan->id)->get();
        }
        else{
            $users =User::where('id',auth()->user()->id)->get();
        }
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
            'noi_dung'              => 'max:191',
            'luong'                 => 'required|max:19',
            ],
            [   
                'user_id.required'              => 'Chưa chọn nhân viên',
                'ngay_ki_hop_dong.required'     => 'Chưa chọn ngày kí hợp đồng',
                'ngay_bat_dau.required'         => 'Chưa chọn ngày bắt đầu',
                'noi_dung.max'                  => 'Nội dung vượt quá 191 kí tự',
                'luong.required'                => 'Chưa nhập lương',
                'luong.max'                     => 'Lương vượt quá 19 kí tự',
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
        $hopDong->luong = $request->luong;
        $hopDong->save();
        return redirect()->route('danh_sach_hop_dong')->with('status','Cập nhật hợp đồng thành công');
    }
    public function destroy(Request $request)
    {
          $hopDong =  HopDong::find($request->id);
          if(empty($hopDong))
          {
            return redirect()->route('danh_sach_hop_dong')->with('error',"Không tìm thấy hợp đồng ! $request->id");
          }
          else
          {
            $hopDong->delete();
            if($hopDong)
            {
                return redirect()->route('danh_sach_hop_dong')->with('status',"Xoá thành công");
            }else{
                return redirect()->route('danh_sach_hop_dong')->with('error',"Xoá không thành công");

            }
          }

       
    }
}
