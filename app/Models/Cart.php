<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $table = "cartstore";
    protected $primaryKey = 'id';
    protected $fillable = [
        "id_user",
        "id_figure",
        "so_luong",
    ] ;
}
