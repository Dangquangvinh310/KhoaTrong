<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NgayNghi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'ngay_bat_dau_nghi',
        'ngay_di_lam_lai',
        'ly_do',
        'trang_thai'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
