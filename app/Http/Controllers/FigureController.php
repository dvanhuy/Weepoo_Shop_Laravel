<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FigureController extends Controller
{
    //
    public function getAllFigure()
    {
        return view("Figure.get_list");
    }
}
