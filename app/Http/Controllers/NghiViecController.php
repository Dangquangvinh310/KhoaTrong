<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NghiViec;
use App\Models\User;
use App\Models\HopDong;
use App\Models\PhongBan;
use Illuminate\Support\Facades\Validator;
class NghiViecController extends Controller
{
    public function index()
    {
        $nghiViecs  = NghiViec::where('trang_thai','Duyệt')->get();
        return view('nghi-viec/danh-sach',compact('nghiViecs'));
    }

    public function danh_sach_ngay_nghi_cho_duyet ()
    {
        $nghiViecs  = NghiViec::where('trang_thai','Chưa duyệt')->get();
      
        return view('nghi-viec/danh-sach-cho-duyet',compact('nghiViecs'));
    }
    

    public function duyet_don_nghi($id)
    {
        $update = NghiViec::find($id);
        $update->trang_thai = 'Duyệt';
        $update->save();

        $user = User::find($update->user_id);
        $hopDongs = HopDong::where('user_id', $user->id)->get();
        $phongBan = PhongBan::where('user_id', $user->id)->first();
        if($phongBan!=null)
        {
            return redirect()->route('danh_sach_nhan_vien')->with('error','Nhân viên đang làm trưởng phòng');
        }
        else
        {
            if($hopDongs!=null)
            {
                foreach($hopDongs as $hopDong)
                {
                    $hopDong->delete();
                }
            }
            $user->delete();
        }
        return redirect()->route('danh_sach_nghi_viec')->with('status','Đã duyệt thành công');

    }

    public function create()
    {
        $users =User::all();
        return view('nghi-viec/them-moi',compact('users'));
    }

    
    public function store(Request $request)
    {
    // return $request->all();
    $validator = Validator::make($request->all(), [
        'user_id'        => 'required',
        'ngay_nghi'        => 'required',
        'ly_do'        => 'required',

        ],
        [   
            'user_id.required'      => 'Chưa chọn nhân viên',
            'ngay_nghi.required'       => 'Chưa chọn ngày nghỉ',
            'ly_do.required'       => 'Chưa nhập lí do',

        ]
    );
    if ($validator->fails()) {
        return back()->with('error', $validator->messages()->first());
    }
        NghiViec::create(
            [
                'user_id'    =>(integer) $request->user_id,
                'ngay_nghi'   => $request->ngay_nghi,
                'ly_do'                 => $request->ly_do,
                // 'total_day'     => Carbon::parse($request->ngay_bat_dau_nghi)->diffInDays(Carbon::parse($request->ngay_di_lam_lai)),
                'trang_thai'        => 'Chưa duyệt'
            ]
        );
        return redirect()->route('danh_sach_nghi_viec')->with('status','Thêm mới thành công');
    }

    public function edit($id)
    {
       $nghiViec=NghiViec::find($id);
       if($nghiViec==null)
       {
           return redirect()->route('danh_sach_nghi_viec')->with('error','Không tìm thấy ngày nghỉ này');
       }
       return view('nghi-viec/cap-nhat', compact('nghiViec'));   
    }


    public function update(Request $request,$id)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'user_id'        => 'required',
            'ngay_nghi'        => 'required',
            'ly_do'        => 'required',
    
            ],
            [   
                'user_id.required'      => 'Chưa chọn nhân viên',
                'ngay_nghi.required'       => 'Chưa chọn ngày nghỉ',
                'ly_do.required'       => 'Chưa nhập lí do',
    
            ]
        );
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first());
        }
      $update = NghiViec::find($id);
      if(empty($update))
      {
        return redirect()->route('danh_sach_nghi_viec')->with('error','Không tìm thấy ngày nghỉ này');
      }
      $update->ngay_nghi = $request->ngay_nghi;
      $update->ly_do = $request->ly_do;

      $update->save();
      return redirect()->route('danh_sach_nghi_viec')->with('status','Cập nhật thành công');

    }


    public function destroy(Request $request)
    {
        try {
            NghiViec::destroy($request->id);
            return redirect()->route('danh_sach_nghi_viec')->with('status','Xoá thành công');

        } catch (Exception $e) {
            return redirect()->route('danh_sach_nghi_viec')->with('error','Xoá không thành công');

        }
    }
}
