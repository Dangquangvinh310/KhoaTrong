<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Luong extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'thang_nam',
        'tong_luong',
        'tong_ngay_lam',
        'tam_ung',
        'phu_cap',
        'khen_thuong',
        'ky_luat'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
