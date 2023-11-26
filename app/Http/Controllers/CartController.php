<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddCardRequest;
use App\Models\Cart;
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
}