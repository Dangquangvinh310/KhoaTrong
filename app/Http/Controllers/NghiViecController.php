<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NghiViec;
use App\Models\ChucVu;
use App\Models\User;
use App\Models\HopDong;
use App\Models\PhongBan;
use Illuminate\Support\Facades\Validator;
class NghiViecController extends Controller
{
    public function index()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
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

        $nghiViecs  = NghiViec::whereIn('user_id', $users)->get();
        return view('nghi-viec/danh-sach',compact('nghiViecs'));
    }

    public function danh_sach_ngay_nghi_cho_duyet ()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
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
        $nghiViecs  = NghiViec::where('trang_thai','Chưa duyệt')->whereIn('user_id', $users)->get();
      
        return view('nghi-viec/danh-sach-cho-duyet',compact('nghiViecs'));
    }
     

    public function duyet_don_nghi($id)
    {
        $update = NghiViec::find($id);
        $update->trang_thai = 'Duyệt';
        // $update->save();

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
            $update->save();//Nhân viên đó không phải là trưởng phòng thì mới được duyệt nghỉ việc.

        }
        return redirect()->route('danh_sach_nghi_viec')->with('status','Đã duyệt thành công');

    }

    public function khong_duyet_don_nghi($id)
    {
   
      $update = NghiViec::find($id);
      $update->trang_thai = 'Không duyệt';
      $update->save();
      return redirect()->route('danh_sach_nghi_viec')->with('status','Cập nhật thành công');

    }

    public function create()
    {
        if(auth()->user()->chucVu->ten_chuc_vu == "Giám đốc")
        {
            $chucVu = ChucVu::where('ten_chuc_vu', 'Giám đốc')->first();
            $users =User::where('chuc_vu_id','!=', $chucVu->id)->get();
        }
        else if(auth()->user()->chucVu->ten_chuc_vu == "Trưởng phòng")
        {
            $chucVu = ChucVu::where('ten_chuc_vu', 'Giám đốc')->first();
            $phongBan = PhongBan::where('user_id', auth()->user()->id)->first();
            $users = User::where('chuc_vu_id','!=', $chucVu->id)->where('phong_ban_id', $phongBan->id)->get();
        }
        else
        {
            $users = User::where('id', auth()->user()->id)->get();
        }
        return view('nghi-viec/them-moi',compact('users'));
    }

    
    public function store(Request $request)
    {
    // return $request->all();
    // return $request->file('don_xin_nghi')->extension();
    $validator = Validator::make($request->all(), [
        'user_id'        => 'required',
        'ngay_nghi'        => 'required',
        // 'ly_do'        => 'required',
        'don_xin_nghi'        => 'required',


        ],
        [   
            'user_id.required'      => 'Chưa chọn nhân viên',
            'ngay_nghi.required'       => 'Chưa chọn ngày nghỉ',
            'ly_do.required'       => 'Chưa nhập lí do',
            'don_xin_nghi.required'       => 'Chưa nộp đơn',

        ]
    );
    if ($validator->fails()) {
        return back()->with('error', $validator->messages()->first());
    }
    if( $ex = $request->file('don_xin_nghi')->extension() !='doc' && $ex = $request->file('don_xin_nghi')->extension() !='docx')
    {
        return redirect()->route('danh_sach_nghi_viec')->with('error','Đơn phải là file word');
    }
$file_name = '';
    if ($request->hasFile('don_xin_nghi')) {
        $image = $request->file('don_xin_nghi');
        $ex = $request->file('don_xin_nghi')->extension();
        $file_name= time() . '.'.$ex;
        $storedPath = $image->storeAs('Đơn xin nghỉ', $file_name);
    }

        NghiViec::create(
            [
                'user_id'    =>(integer) $request->user_id,
                'ngay_nghi'   => $request->ngay_nghi,
                'ly_do'                 => $request->ly_do,
                'trang_thai'        => 'Chưa duyệt',
                'don_nghi_viec' => $file_name
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
        if ($request->hasFile('don_xin_nghi')) {

        if( $ex = $request->file('don_xin_nghi')->extension() !='doc' && $ex = $request->file('don_xin_nghi')->extension() !='docx')
        {
            return redirect()->route('danh_sach_nghi_viec')->with('error','Đơn phải là file word');
        }
    }
    $file_name = '';
        if ($request->hasFile('don_xin_nghi')) {
            $image = $request->file('don_xin_nghi');
            $ex = $request->file('don_xin_nghi')->extension();
            $file_name= time() . '.'.$ex;
            $storedPath = $image->storeAs('Đơn xin nghỉ', $file_name);
        }

      $update = NghiViec::find($id);
      if(empty($update))
      {
        return redirect()->route('danh_sach_nghi_viec')->with('error','Không tìm thấy ngày nghỉ này');
      }
      $update->ngay_nghi = $request->ngay_nghi;
      $update->don_nghi_viec = $file_name;

      $update->save();
      return redirect()->route('danh_sach_nghi_viec')->with('status','Cập nhật thành công');

    }


    public function destroy(Request $request,$id)
    {
        // dd($id);
        try {
            NghiViec::destroy($id);
            return redirect()->route('danh_sach_nghi_viec')->with('status','Xoá thành công');
        } catch (Exception $e) {
            return redirect()->route('danh_sach_nghi_viec')->with('error','Xoá không thành công');

        }
    }
}
