<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index(){
        $bills = Bill::where("id_user", Auth::id())->get();
        return view('Bill.get_form_bill',["bills"=>$bills]);
    }
    public function getdetailform(Bill $billID){
        $details = BillDetail::where("id_bill", $billID->id)
                ->join('figures', 'billdetail.id_figure', '=', 'figures.id')
                ->select('billdetail.id as billdetail_id ','billdetail.*', 'figures.*')
                ->get();
        return view('Bill.detail',["details"=>$details]);
    }
}
