<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "bills";
    protected $fillable = [
        "dia_chi",
        "so_dien_thoai",
        "thoi_gian_thanh_toan",
        "thoi_gian_giao_hang",
        "trang_thai",
        "id_user",
        "hinh_anh",
        "tong_tien"
    ] ;
}
