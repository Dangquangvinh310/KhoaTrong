<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NgayNghi;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class NgayNghiController extends Controller
{
    public function index()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
            $users =User::all()->pluck('id');
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $users = User::where('phong_ban_id', $phongBan->id)->get()->pluck('id');
        }
        else
        {
            $users = User::where('id', auth()->user()->id)->get()->pluck('id');
        }
    
        $ngayNghis  = NgayNghi::where('trang_thai','Duyệt')->whereIn('user_id', $users)->get();

        return view('ngay-nghi/danh-sach',compact('ngayNghis'));
    }
    public function danh_sach_ngay_nghi_cho_duyet()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "admin")
        {
            $users =User::all()->pluck('id');
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $users = User::where('phong_ban_id', $phongBan->id)->get()->pluck('id');
        }
        else
        {
            $users = User::where('id', auth()->user()->id)->get()->pluck('id');
        }
        $ngayNghis  = NgayNghi::where('trang_thai','Chưa duyệt')->whereIn('user_id', $users)->get(); 

        return view('ngay-nghi/danh-sach-cho-duyet',compact('ngayNghis'));
    }
    

    public function duyet_don_nghi($id)
    {
   
      $update = NgayNghi::find($id);
      $update->trang_thai = 'Duyệt';
      $update->save();
      return redirect()->route('danh_sach_ngay_nghi')->with('status','Cập nhật thành công');

    }

    public function create()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "Nhân viên")
        {
            $users =User::where('id', auth()->user()->id)->get();
        }
        else
        {
            $users =User::all();
        }
        return view('ngay-nghi/them-moi',compact('users'));
    }

    
    public function store(Request $request)
    {
    // return $request->all();
    $validator = Validator::make($request->all(), [
        'user_id'        => 'required',
        'ngay_bat_dau_nghi'        => 'required',
        'ngay_di_lam_lai'        => 'required',
        'don_xin_nghi'        => 'required',

        ],
        [   
            'user_id.required'      => 'Chưa chọn nhân viên',
            'ngay_bat_dau_nghi.required'       => 'Chưa chọn ngày bắt đầu nghỉ',
            'ngay_di_lam_lai.required'       => 'Chưa chọn ngày đi làm lại',
            'don_xin_nghi.required'       => 'Chưa nộp đơn',

        ]
    );
    if ($validator->fails()) {
        return back()->with('error', $validator->messages()->first());
    }
    if( $ex = $request->file('don_xin_nghi')->extension() !='doc' && $ex = $request->file('don_xin_nghi')->extension() !='docx')
    {
        return redirect()->route('danh_sach_ngay_nghi')->with('error','Đơn phải là file word');
    }
       $ngayNghi = new NgayNghi();
       $ngayNghi->user_id  = (integer) $request->user_id;
       $ngayNghi->ngay_bat_dau_nghi  = $request->ngay_bat_dau_nghi;
       $ngayNghi->ngay_di_lam_lai  = $request->ngay_di_lam_lai;
       $ngayNghi->ly_do  = $request->ly_do;
       $ngayNghi->trang_thai  = 'Chưa duyệt';
       if ($request->hasFile('don_xin_nghi')) {
        $image = $request->file('don_xin_nghi');
        $ex=  $request->file('don_xin_nghi')->extension();
        $file_name= time() . '.'.$ex;
        $storedPath = $image->storeAs('Đơn xin nghỉ', $file_name);
        $ngayNghi->don_nghi_viec = $file_name;
    }
        $ngayNghi->save();

        return redirect()->route('danh_sach_ngay_nghi')->with('status','Thêm mới thành công');
    }

    public function edit($id)
    {
       $NgayNghi=NgayNghi::find($id);
       if($NgayNghi==null)
       {
           return redirect()->route('danh_sach_ngay_nghi')->with('error','Không tìm thấy ngày nghỉ này');
       }
       return view('ngay-nghi/cap-nhat', compact('NgayNghi'));   
    }


    public function update(Request $request,$id)
    {
        // return $request->all();
        return $request->file('don_xin_nghi')->extension();
        $validator = Validator::make($request->all(), [
            'user_id'        => 'required',
            'ngay_bat_dau_nghi'        => 'required',
            'ngay_di_lam_lai'        => 'required',
            // 'ly_do'        => 'required',
    
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
        if ($request->hasFile('don_xin_nghi')) {

        if( $ex = $request->file('don_xin_nghi')->extension() !='doc' && $ex = $request->file('don_xin_nghi')->extension() !='docx')
        {
            return redirect()->route('danh_sach_ngay_nghi')->with('error','Đơn phải là file word');
        }
    }
      $update = NgayNghi::find($id);
      if(empty($update))
      {
        return redirect()->route('danh_sach_ngay_nghi')->with('error','Không tìm thấy ngày nghỉ này');
      }
      $update->ngay_bat_dau_nghi = $request->ngay_bat_dau_nghi;
      $update->ngay_di_lam_lai = $request->ngay_di_lam_lai;
      if ($request->hasFile('don_xin_nghi')) {
        $image = $request->file('don_xin_nghi');
        $ex=  $request->file('don_xin_nghi')->extension();
        $file_name= time() . '.'.$ex;
        $storedPath = $image->storeAs('Đơn xin nghỉ', $file_name);
        $update->don_nghi_viec = $file_name;
    }
      $update->save();
      return redirect()->route('danh_sach_ngay_nghi')->with('status','Cập nhật thành công');

    }


    public function destroy($id)
    {
        // dd($id);
        try {
            NgayNghi::destroy($id);
            return redirect()->route('danh_sach_ngay_nghi')->with('status','Xoá thành công');

        } catch (Exception $e) {
            return redirect()->route('danh_sach_ngay_nghi')->with('error','Xoá không thành công');

        }
    }
}
