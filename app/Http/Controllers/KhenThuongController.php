<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Luong;
use App\Models\User;
use App\Models\KhenThuong;
use App\Models\HopDong;

use Carbon\Carbon;
class KhenThuongController extends Controller
{
    public function index()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
            $users=User::all()->pluck('id');
        }
        else
        {
            $users=User::where('phong_ban_id', auth()->user()->phong_ban_id)->get()->pluck('id');
        }
        $khenThuongs =KhenThuong::whereIn('user_id', $users)->get();
        if($khenThuongs==null)
        {
            return back()->with('error','Không tìm thấy danh sách phòng ban');
        }
        return view('khen-thuong/danh-sach',compact('khenThuongs'));
    }

    public function create()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
            $users=User::all();
        }
        else
        {
            $users=User::where('phong_ban_id', auth()->user()->phong_ban_id)->get();
        }
        return view('khen-thuong/them-moi',compact('users'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'ten_khen_thuong'  => 'required|max:191|unique:App\Models\PhongBan,ten_khen_thuong,NULL,id,deleted_at,NULL',
            'user_id'        => 'required',
            ],
            [ 
                'user_id.required'            => 'Chưa chọn trưởng phòng',
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }

        $phongBan = new KhenThuong();
        $phongBan->user_id = $request->user_id;
        $phongBan->ly_do = $request->ly_do;
        $phongBan->so_tien = $request->so_tien;
        $phongBan->ngay = Carbon::now()->format('d-m-Y H:m:s');
        $phongBan->save();
        if($phongBan)
        {
            $now = Carbon::now()->format('m-Y');
            $userDaCoLuongTrongThang = Luong::where('thang_nam','LIKE',"%$now%")->where('user_id',$request->user_id)->first();
            // dd($userDaCoLuongTrongThang);
            if(!empty($userDaCoLuongTrongThang))
            {
                $khenThuong = KhenThuong::where('user_id',$request->user_id)->where('ngay','LIKE',"%$now%")->sum('so_tien');
                // dd($khenThuong);
                $luong = HopDong::where('user_id',$request->user_id)->orderBy('id','desc')->first();
                $userDaCoLuongTrongThang->khen_thuong = $khenThuong;
                $userDaCoLuongTrongThang->khen_thuong = $khenThuong;
                $userDaCoLuongTrongThang->tong_luong = (float)$userDaCoLuongTrongThang->tong_ngay_lam * (float)$luong->luong
                 + (float)$userDaCoLuongTrongThang->phu_cap - (float)$userDaCoLuongTrongThang->tam_ung
                 +(float)$khenThuong - (float)$userDaCoLuongTrongThang->ky_luat;
                 $userDaCoLuongTrongThang->save();
            }
        }
        return redirect()->route('danh_sach_khen_thuong')->with('status','Thêm mới thành công');
    }

    public function edit($id)
    {
        $khenThuong = KhenThuong::find($id);
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
            $users=User::all();
        }
        else
        {
            $users=User::where('phong_ban_id', auth()->user()->phong_ban_id)->get();
        }
        if($khenThuong==null)
        {
            return redirect()->route('danh_sach_khen_thuong')->with('error','Không tìm thấy khen thưởng này');
        }
        return view('khen-thuong/cap-nhat', compact('khenThuong','users'));   
    }

    public function update(Request $request,$id)
    {
        
        $phongBan = KhenThuong::find($id);
        $phongBan->ly_do = $request->ly_do;
        $phongBan->so_tien = $request->so_tien;
        $phongBan->ngay = Carbon::now()->format('d-m-Y H:m:s');
        $phongBan->save();
        return redirect()->route('danh_sach_khen_thuong')->with('status','Cập nhật thành công');   
     }

    public function destroy($id)
    {
            $phongBan = KhenThuong::find($id);
           
            $phongBan->delete();
            return redirect()->route('danh_sach_khen_thuong')->with('status','Xoá thành công');  
        
    }
}
