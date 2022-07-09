<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Luong;
use App\Models\User;
use App\Models\ChamCong;
use App\Models\KhenThuong;
use App\Models\KyLuat;
use App\Models\HopDong;

use Illuminate\Support\Facades\Validator;

class LuongController extends Controller
{
    public function index()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
            $user=User::all()->pluck('id');
        }
        else
        {
            $user=User::where('phong_ban_id', auth()->user()->phong_ban_id)->get()->pluck('id');
        }
        $luongs  = Luong::whereIn('user_id', $user)->get();
      
        return view('bang-luong/danh-sach',compact('luongs'));
    }

    public function create()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
            $user=User::all()->pluck('id');
        }
        else
        {
            $user=User::where('phong_ban_id', auth()->user()->phong_ban_id)->get()->pluck('id');
        }
        $users =User::whereIn('id', $user)->whereHas('hopDong')->with('hopDong')->get();
        return view('bang-luong/them-moi',compact('users'));
    }

    
    public function store(Request $request)
    {
       
    $validator = Validator::make($request->all(), [
        'user_id'        => 'required',
        'tong_ngay_lam'        => 'required',
        ],
        [   
            'user_id.required'      => 'Chưa chọn nhân viên',
            'tong_ngay_lam.required'       => 'Chưa nhập tổng ngày làm',
        ]
    );
    if ($validator->fails()) {
        return back()->with('error', $validator->messages()->first());
    }
        if(empty($request->phu_cap))
        {
            $request->phu_cap = 0;
        }
        if(empty($request->tam_ung))
        {
            $request->tam_ung = 0;
        }

        $now = Carbon::now()->format('m-Y');
        $khenThuong = KhenThuong::where('user_id',$request->user_id)->where('ngay','LIKE',"%$now%")->sum('so_tien');
        $kyLuat = KyLuat::where('user_id',$request->user_id)->where('ngay','LIKE',"%$now%")->sum('so_tien');

        $user = User::find((integer) $request->user_id)->chucVu;
        $luong = HopDong::where('user_id',$request->user_id)->orderBy('id','desc')->first();
    if(empty($user))
    {
        return back()->with('error','Nhân viên này chưa có chức vụ');
    }
        Luong::create(
            [
                'user_id'    =>(integer) $request->user_id,
                'tong_ngay_lam'   => $request->tong_ngay_lam,
                'tam_ung'       => $request->tam_ung,
                'phu_cap'                 => $request->phu_cap,
                'thang_nam'     => Carbon::now()->format('m-Y'),
                'khen_thuong'       => $khenThuong,
                'ky_luat'                 => $kyLuat,
                'tong_luong' => (float)$request->tong_ngay_lam* (float)$luong->luong + (float)$request->phu_cap - (float)$request->tam_ung
                +(float)$khenThuong - (float)$kyLuat,
            ]
        );
        return redirect()->route('danh_sach_bang_luong')->with('status','Thêm mới thành công');
    }

    public function edit($id)
    {
       $luong=Luong::find($id);
       $ngayLam = Carbon::now()->format('m-Y');
       $tongNgayLam = ChamCong::where('user_id',$luong->user_id)->where('ngay_lam','LIKE',"%$ngayLam%")->count();
       $user = User::find((integer) $luong->user_id)->chucVu;

      
       $thamSp = [];
       $thamSp['tongNgayLam'] = $tongNgayLam;
       $thamSp['luongMotNgay'] =  $user->luong;
       if($luong==null)
       {
           return redirect()->route('danh_sach_ngay_nghi')->with('error','Không tìm thấy ngày nghỉ này');
       }
       return view('bang-luong/cap-nhat', compact('luong','thamSp'));   
    }


    public function update(Request $request,$id)
    {
        // return $request->all();
    
      $update = Luong::find($id);
      if(empty($update))
      {
        return redirect()->route('danh_sach_ngay_nghi')->with('error','Không tìm thấy ngày nghỉ này');
      }
      $now = Carbon::now()->format('m-Y');
      $khenThuong = KhenThuong::where('user_id',$request->user_id)->where('ngay','LIKE',"%$now%")->sum('so_tien');
      $kyLuat = KyLuat::where('user_id',$request->user_id)->where('ngay','LIKE',"%$now%")->sum('so_tien');

      $user = User::find((integer) $request->user_id)->chucVu;
      $luong = HopDong::where('user_id',$request->user_id)->orderBy('id','desc')->first();

      $ngayLam = Carbon::now()->format('m-Y');
      $tongNgayLam = ChamCong::where('user_id',$update->user_id)->where('ngay_lam','LIKE',"%$ngayLam%")->count();
      $update->khen_thuong = $khenThuong;
      $update->ky_luat = $kyLuat;

      $update->tam_ung = $request->tam_ung;
      $update->phu_cap = $request->phu_cap;
      $update->tong_luong =  (float)$tongNgayLam * (float)$luong->luong  + (float)$request->phu_cap - (float)$request->tam_ung
      +(float)$khenThuong - (float)$kyLuat ;

      $update->save();
      return redirect()->route('danh_sach_bang_luong')->with('status','Cập nhật thành công');

    }


    public function destroy($id)
    {
        try {
            Luong::destroy($id);
            return redirect()->route('danh_sach_bang_luong')->with('status','Xoá thành công');

        } catch (Exception $e) {
            return redirect()->route('danh_sach_bang_luong')->with('error','Xoá không thành công');

        }
    }
}
