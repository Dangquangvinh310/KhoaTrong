<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\KhenThuong;
use Carbon\Carbon;
class KhenThuongController extends Controller
{
    public function index()
    {
        $khenThuongs =KhenThuong::all();
        if($khenThuongs==null)
        {
            return back()->with('error','Không tìm thấy danh sách phòng ban');
        }
        return view('khen-thuong/danh-sach',compact('khenThuongs'));
    }

    public function create()
    {
        $users=User::where('id', '!=', 1)->get();
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
        return redirect()->route('danh_sach_khen_thuong')->with('status','Thêm mới thành công');
    }

    public function edit($id)
    {
        $khenThuong = KhenThuong::find($id);
        $users=User::where('id', '!=', 1)->get();
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
