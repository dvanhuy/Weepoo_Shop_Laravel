<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Figure extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ten',
        'gia',
        'so_luong_hien_con',
        'so_luong_da_ban',
        'nha_sx',
        'chieu_cao',
        'chieu_rong',
        'chieu_dai',
        'chat_lieu',
        'mo_ta',
        'hinh_anh',
    ];
}
