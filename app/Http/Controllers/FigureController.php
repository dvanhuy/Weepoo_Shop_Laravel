<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use Illuminate\Http\Request;

class FigureController extends Controller
{
    //
    public function index()
    {
        //30 hàng mới nhất
        $figure36row = Figure::limit(30)->orderBy("created_at","desc")->get();
        return view("Figure.get_list",["figures"=>$figure36row]);
    }

    public function showDetail(Figure $figureID)
    {
        //model binding
        return view('Figure.get_detail_figure',['figure'=> $figureID]);
    }
}
