<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getFiguresForm(){
        $figure15row = Figure::limit(10)->orderBy("updated_at","desc")->get();
        return view("Admin.manageFigures",["figures"=> $figure15row]);
    }
    public function getUsersForm(){

        $user10row = User::limit(10)->get();
        return view("Admin.manageUsers",["users"=>$user10row]);
    }
}
