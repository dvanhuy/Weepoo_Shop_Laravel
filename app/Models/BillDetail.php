<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table = "billdetail";
    protected $fillable = [
        "id_bill",
        "id_figure",
        "so_luong",
    ] ;
}
