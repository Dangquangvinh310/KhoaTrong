<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NghiViec extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'ngay_nghi',
        'ly_do',
        'trang_thai',
        'don_nghi_viec'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }
}
