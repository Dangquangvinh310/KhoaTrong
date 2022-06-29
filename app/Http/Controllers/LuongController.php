<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Luong;
use App\Models\User;
use App\Models\ChamCong;
use Illuminate\Support\Facades\Validator;

class LuongController extends Controller
{
    public function index()
    {
        $luongs  = Luong::all();
      
        return view('bang-luong/danh-sach',compact('luongs'));
    }

    public function create()
    {
        $users =User::all();
        return view('bang-luong/them-moi',compact('users'));
    }

    
    public function store(Request $request)
    {
        // dd($request->all());
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
    $user = User::find((integer) $request->user_id)->chucVu;
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
                'tong_luong' => (float)$request->tong_ngay_lam* $user->luong + (float)$request->phu_cap - (float)$request->tam_ung,
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

      $user = User::find((integer) $update->user_id)->chucVu;
      $ngayLam = Carbon::now()->format('m-Y');
      $tongNgayLam = ChamCong::where('user_id',$update->user_id)->where('ngay_lam','LIKE',"%$ngayLam%")->count();


      $update->tam_ung = $request->tam_ung;
      $update->phu_cap = $request->phu_cap;
      $update->tong_luong =  $tongNgayLam * $user->luong  + (float)$request->phu_cap - (float)$request->tam_ung;

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
