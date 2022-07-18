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
        $chucVu = ChucVu::where('ten_chuc_vu','admin')->first();
        if($chucVu!==null)
        {
            $chucVu->ten_chuc_vu = 'Giám đốc';
            $chucVu->save();
        }
    }
}
