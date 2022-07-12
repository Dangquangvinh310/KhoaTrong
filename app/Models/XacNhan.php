<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XacNhan extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function phongBan()
    {   
        return $this->hasOneThrough('App\Models\PhongBan', 'App\Models\User', 'id', 'id', 'user_id' ,'phong_ban_id');
    }

    public function chucVu()
    {   
        return $this->hasOneThrough('App\Models\ChucVu', 'App\Models\User', 'id', 'id', 'user_id' ,'chuc_vu_id');
    }
}
