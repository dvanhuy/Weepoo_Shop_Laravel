<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getFiguresForm(){
        return view("Admin.manageFigures");
    }
    public function getUsersForm(){
        return view("Admin.manageUsers");
    }
}