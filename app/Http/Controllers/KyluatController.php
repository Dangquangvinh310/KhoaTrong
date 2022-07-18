<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\KyLuat;
use Carbon\Carbon;
use App\Models\Luong;
use App\Models\KhenThuong;
use App\Models\HopDong;
class KyluatController extends Controller
{
    public function index()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
            $users=User::all()->pluck('id');
        }
        else
        {
            $users=User::where('phong_ban_id', auth()->user()->phong_ban_id)->get()->pluck('id');
        }
        $kyLuats =KyLuat::whereIn('user_id', $users)->get();
        if($kyLuats==null)
        {
            return back()->with('error','Không tìm thấy danh sách phòng ban');
        }

        return view('ky-luat/danh-sach',compact('kyLuats'));
    }

    public function create()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
            $users=User::all();
        }
        else
        {
            $users=User::where('phong_ban_id', auth()->user()->phong_ban_id)->get();
        }
        return view('ky-luat/them-moi',compact('users'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'ten_ky_luat'  => 'required|max:191|unique:App\Models\PhongBan,ten_ky_luat,NULL,id,deleted_at,NULL',
            'user_id'        => 'required',
            ],
            [ 
                'user_id.required'            => 'Chưa chọn trưởng phòng',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }

        $phongBan = new KyLuat();
        $phongBan->user_id = $request->user_id;
        $phongBan->ly_do = $request->ly_do;
        $phongBan->so_tien = $request->so_tien;
        $phongBan->ngay = Carbon::now()->format('d-m-Y H:m:s');
        $phongBan->save();
        if($phongBan)
        {
            $now = Carbon::now()->format('m-Y');
            $userDaCoLuongTrongThang = Luong::where('thang_nam','LIKE',"%$now%")->where('user_id',$request->user_id)->first();
            if(!empty($userDaCoLuongTrongThang))
            {
                $kyLuat = KyLuat::where('user_id',$request->user_id)->where('ngay','LIKE',"%$now%")->sum('so_tien');
                $luong = HopDong::where('user_id',$request->user_id)->orderBy('id','desc')->first();
                $userDaCoLuongTrongThang->ky_luat = $kyLuat;
                $userDaCoLuongTrongThang->ky_luat = $kyLuat;

                $userDaCoLuongTrongThang->tong_luong = (float)$userDaCoLuongTrongThang->tong_ngay_lam * (float)$luong->luong
                 + (float)$userDaCoLuongTrongThang->phu_cap - (float)$userDaCoLuongTrongThang->tam_ung
                 +(float)$userDaCoLuongTrongThang->khen_thuong - (float)$kyLuat;
                 $userDaCoLuongTrongThang->save();

            }
        }
        return redirect()->route('danh_sach_ky_luat')->with('status','Thêm mới thành công');
    }

    public function edit($id)
    {
        $dsKyLuat = KyLuat::all();
        $kyLuat = KyLuat::find($id);
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
            $users=User::all();
        }
        else
        {
            $users=User::where('phong_ban_id', auth()->user()->phong_ban_id)->get();
        }
        if($kyLuat==null)
        {
            return redirect()->route('danh_sach_ky_luat')->with('error','Không tìm thấy khen thưởng này');
        }
        return view('ky-luat/cap-nhat', compact('kyLuat','users','dsKyLuat'));   
    }

    public function update(Request $request,$id)
    {
        
        $phongBan = KyLuat::find($id);
        $phongBan->ly_do = $request->ly_do;
        $phongBan->so_tien = $request->so_tien;
        $phongBan->ngay = Carbon::now()->format('d-m-Y H:m:s');
        $phongBan->save();
        return redirect()->route('danh_sach_ky_luat')->with('status','Cập nhật thành công');   
     }

    public function destroy($id)
    {
            $phongBan = KyLuat::find($id);
           
            $phongBan->delete();
            return redirect()->route('danh_sach_ky_luat')->with('status','Xoá thành công');  
        
    }
}
