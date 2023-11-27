<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddCardRequest;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Figure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index()
    {
        $carts = Cart::where("id_user", Auth::id())
            ->join('figures', 'cartstore.id_figure', '=', 'figures.id')
            ->select('cartstore.id as cart_id', 'cartstore.*', 'figures.*')
            ->get();
        return view("Cart.get_list_cart", ["carts"=> $carts]);
    }
    public function add(AddCardRequest $request){
        // Xử lý dữ liệu
        $existsCart = Cart::where('id_user', $request->id_user)
            ->where('id_figure',  $request->id_figure)
            ->get();
        if($existsCart->count() == 0)
        {
            Cart::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng'
            ]);
        };
        $soluong = $request->input('so_luong');
        $existsCart[0]->so_luong += (int)$soluong ;
        $existsCart[0]->save();
        // Trả về kết quả
        return response()->json([
            'success' => false,
            'message' => 'Đã thêm '.$soluong.' sản phẩm nữa vào giỏ hàng',
            'data' => $existsCart[0]
        ]);
    }

    public function delete(Cart $cart_id)
    {
        $check = $cart_id->delete();
        if ($check) {
            return response()->json([
                'success' => true,
                'message' => 'Đã xóa thành công',
            ]);
        }
        // Trả về kết quả
        return response()->json([
            'success' => false,
            'message' => 'Xóa thất bại'
        ]);
    }

    public function update(Request $request){
        $cart = Cart::find($request->input('cartID'));
        $figure = Figure::find($cart->id_figure);
        $update_so_luong = $cart->so_luong + (int)$request->input('updateNumber');
        if ($figure->so_luong_hien_con >= $update_so_luong ){
            $cart->so_luong = $update_so_luong;
            $cart->save();
            return response()->json([
                'success' => true,
                'message' => "cập nhật thành công",
            ]);
        }
        //hết hàng và cập nhật lại thành số hàng còn
        $cart->so_luong = $figure->so_luong_hien_con;
        $cart->save();
        return response()->json([
            'success' => false,
            'message' => "Chỉ còn ".$figure->so_luong_hien_con." mô hình trong kho",
            'so_luong_con' => $figure->so_luong_hien_con,
        ]);
    }

    public function getFormPay(Request $request){
        $cartIDs = explode(',', $request->input('cartIDs'));
        $carts = Cart::whereIn('id',  $cartIDs)->get();
        return view('Cart.pay',['carts'=>$carts]);
    }

    public function pay(Request $request){
        $cartIDs = explode(',', $request->input('cartIDs'));
        $carts = Cart::whereIn('id',  $cartIDs)->get();

        // Thêm vào bảng hóa đơn
        $bill = Bill::create([
            'thoi_gian_thanh_toan' => now(),
            'trang_thai' => 'Đang giao',
            'id_user' => $carts[0]->id_user,
            'hinh_anh'=>'images/emptyFigure.webp'
        ]);
        // $carts->each(function ($cart) {
        //     // Cập nhật bảng figure
        // });
        $tongtien = 0;
        foreach ($carts as $cart) {
            // Cập nhật bảng figure
            $figure = Figure::find($cart->id_figure);
            $figure->so_luong_hien_con -= $cart->so_luong;
            $figure->so_luong_da_ban += $cart->so_luong;
            $figure->save();
            $tongtien += $cart->so_luong*$figure->gia;
            BillDetail::create([
                'id_bill' => $bill->id,
                'id_figure' => $cart->id_figure,
                'so_luong' => $cart->so_luong,
            ]);
            
            $cart->delete();
        }
        $bill->tong_tien = $tongtien;
        $bill->save();
        return response()->json([
            'success' => true,
            "message" => "Thanh toán thành công"
        ]);
    }
}