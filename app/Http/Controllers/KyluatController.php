<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\KyLuat;
use Carbon\Carbon;
class KyluatController extends Controller
{
    public function index()
    {
        $kyLuats =KyLuat::all();
        if($kyLuats==null)
        {
            return back()->with('error','Không tìm thấy danh sách phòng ban');
        }

        return view('ky-luat/danh-sach',compact('kyLuats'));
    }

    public function create()
    {
        $users=User::where('id', '!=', 1)->get();
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
        return redirect()->route('danh_sach_ky_luat')->with('status','Thêm mới thành công');
    }

    public function edit($id)
    {
        $kyLuat = KyLuat::find($id);
        $users=User::where('id', '!=', 1)->get();
        if($kyLuat==null)
        {
            return redirect()->route('danh_sach_ky_luat')->with('error','Không tìm thấy khen thưởng này');
        }
        return view('ky-luat/cap-nhat', compact('kyLuat','users'));   
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
