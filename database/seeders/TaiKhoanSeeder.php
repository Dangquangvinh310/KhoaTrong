<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user                       = new User();
        $user->ma_nhan_vien         = 'NV1';
        $user->username             = 'admin';
        $user->password             = Hash::make('123456');
        $user->ho_ten               = 'admin';
        $user->chuc_vu_id           = 1;
        $user->phong_ban_id         = null;
        $user->save();

    }
}
