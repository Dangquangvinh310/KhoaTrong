<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChucVu;
use App\Models\PhongBan;
class ChucVuPhanQuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chucVu                       = new ChucVu();
        $chucVu->ten_chuc_vu          = 'admin';
        $chucVu->luong                = 10000000;
        $chucVu->save();

        $chucVu                       = new ChucVu();
        $chucVu->ten_chuc_vu          = 'Trưởng phòng';
        $chucVu->luong                = 10000000;
        $chucVu->save();

        $chucVu                       = new ChucVu();
        $chucVu->ten_chuc_vu          = 'Nhân viên';
        $chucVu->luong                = 5000000;
        $chucVu->save();

        $phongBan                       = new PhongBan();
        $phongBan->user_id              = 1;
        $phongBan->ten_phong_ban        = 'Phòng ban 1';
        $phongBan->save();
    }
}
