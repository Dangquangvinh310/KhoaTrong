<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luong extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'thang_nam',
        'tong_luong',
        'tong_ngay_lam',
        'tam_ung',
        'phu_cap'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
