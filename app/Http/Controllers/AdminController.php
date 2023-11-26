<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getFiguresForm(Request $request){
        $order = 'updated_at';
        $direc =  'desc';
        if($request->has("order")){
            //có tham số order -> nhấn vào nút tìm
            if ($request->input("order") == 'priceasc'){
                $order = 'gia';
                $direc =  'asc';
            } else if ($request->input("order") == "pricedesc"){
                $order = 'gia';
                $direc =  'desc';
            } else {
                $order = 'updated_at';
                $direc =  'desc';
            }
            if($request->has("search-column") && $request->has("search-column-value")){
                // có mệnh đề where
                $figures= Figure::where($request->input("search-column"), 'like', '%'.$request->input("search-column-value").'%')
                                ->orderBy($order,$direc)
                                ->paginate(15);
                return view("Admin.manageFigures",["figures"=> $figures]);
            } else {
                // không có mệnh đề where
                $figures= Figure::orderBy($order,$direc)
                                ->paginate(15);
                return view("Admin.manageFigures",["figures"=> $figures]);
            }
        }
        $figures= Figure::orderBy($order,$direc)->paginate(15);
        return view("Admin.manageFigures",["figures"=> $figures]);
    }
    public function getUsersForm(){

        $user10row = User::limit(10)->get();
        return view("Admin.manageUsers",["users"=>$user10row]);
    }
}
