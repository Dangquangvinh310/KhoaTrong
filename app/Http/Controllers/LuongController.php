<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Luong;
use App\Models\User;
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
       $NgayNghi=Luong::find($id);
       if($NgayNghi==null)
       {
           return redirect()->route('danh_sach_ngay_nghi')->with('error','Không tìm thấy ngày nghỉ này');
       }
       return view('ngay-nghi/cap-nhat', compact('NgayNghi'));   
    }


    public function update(Request $request,$id)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'user_id'        => 'required',
            'ngay_bat_dau_nghi'        => 'required',
            'ngay_di_lam_lai'        => 'required',
            'ly_do'        => 'required',
    
            ],
            [   
                'user_id.required'      => 'Chưa chọn nhân viên',
                'ngay_bat_dau_nghi.required'       => 'Chưa chọn ngày bắt đầu nghỉ',
                'ngay_di_lam_lai.required'       => 'Chưa chọn ngày đi làm lại',
                'ly_do.required'       => 'Chưa nhập lí do',
    
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
      $update = Luong::find($id);
      if(empty($update))
      {
        return redirect()->route('danh_sach_ngay_nghi')->with('error','Không tìm thấy ngày nghỉ này');
      }
      $update->ngay_bat_dau_nghi = $request->ngay_bat_dau_nghi;
      $update->ngay_di_lam_lai = $request->ngay_di_lam_lai;
      $update->ly_do = $request->ly_do;

      $update->save();
      return redirect()->route('danh_sach_ngay_nghi')->with('status','Cập nhật thành công');

    }


    public function destroy(Request $request)
    {
        try {
            Luong::destroy($request->id);
            return redirect()->route('danh_sach_ngay_nghi')->with('error','Xoá thành công');

        } catch (Exception $e) {
            return redirect()->route('danh_sach_ngay_nghi')->with('error','Xoá không thành công');

        }
    }
}
