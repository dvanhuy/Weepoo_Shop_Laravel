<?php

namespace App\Http\Controllers;

use App\Http\Requests\Figure\AddFigureRequest;
use App\Models\Figure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
    public function getFormAddFigure(Request $request)
    {
        return view('Figure.add_figure');
    }

    public function addFigure(AddFigureRequest $request)
    {
        $figure = $request->validated();
        if ($request->hasFile('hinh_anh')) {
            $path = Storage::disk('public')->put("images", $request->file('hinh_anh'));
            $figure['hinh_anh']='storage/'.$path;
        } else {
            $figure['hinh_anh']='images/emptyFigure.webp';
        }
        $status = Figure::create($figure);
        if ($status) {
            return redirect()->back()->with([
                'status' => 'Đã thêm mô hình thành công'
            ]);
        }

        return redirect()->back()->with([
            'status' => 'Thêm thất bại'
        ]);
    }
    public function getFormUpdateFigure(Figure $figureID)
    {
        return view('Figure.update_figure',['figure'=> $figureID]);
    }

    public function updateFigure(AddFigureRequest $request,Figure $figureID)
    {

        $figure = $request->validated();
        if ($request->hasFile('hinh_anh')) {
            //xóa ảnh cũ
            $old_image_path = $figureID['hinh_anh'];
            if(File::exists($old_image_path) && $old_image_path != 'images/emptyFigure.webp') {
                File::delete($old_image_path);
            }
            $new_image_path = Storage::disk('public')->put("images", $request->file('hinh_anh'));
            $figure['hinh_anh']='storage/'.$new_image_path;
        } else {
            $figure['hinh_anh']='images/emptyFigure.webp';
        }
        $status = $figureID->update($figure);
        if ($status) {
            return redirect()->back()->with([
                'status' => 'Đã cập nhật mô hình thành công'
            ]);
        }
        return redirect()->back()->with([
            'status' => 'Cập nhật thất bại'
        ]);
    }
}
