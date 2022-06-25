<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BHXHController extends Controller
{
    public function index()
    {
        $users =User::all();
        if($users==null)
        {
            return back()->with('error','Không tìm thấy danh sách nhân viên');
        }
        return view('bhxh/danh-sach',compact('users'));
    }
}
