<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use Illuminate\Support\Facades\Auth;
use Image;

class SlideController extends Controller
{
    //
    public function Home()
    {
        if(session('user_admin')){
            $slider=Slide::where('status',1)->orderBy('updated_at','desc')->get();
            return view('admin.slide',['slider'=>$slider]);
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function SaveSlide(Request $request)
    {
        if(session('user_admin')){
            try{
                $id=$request->txtid;
                $sort=$request->txtthutu;
                $show=0;

                if($request->txtshow)
                {
                    $show=1;
                }
                if($id==0)
                {
                    $slide=new Slide;
                    $slide->is_show=$show;
                    $slide->sort_order=$sort;
                    $slide->status=1;
                    if($request->hasFile('file'))
                    {
                        $file=$request->file('file');
                        $filename  = time() . '.' . $file->getClientOriginalExtension();
                        $path = public_path('images/sliders/' . $filename);
                        Image::make($file->getRealPath())->resize(1100, 400)->save($path);
                        $slide->image=$filename;
                    }
                    if($slide->save())
                    {
                        return redirect('admin/slide')->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/slide')->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $slide=Slide::find($id);
                    $slide->is_show=$show;
                    $slide->sort_order=$sort;
                    if($request->hasFile('file'))
                    {
                        if(file_exists('images/sliders/'.$slide->image))
                        {
                            unlink('images/sliders/'.$slide->image);
                        }
                        $file=$request->file('file');
                        $filename  = time() . '.' . $file->getClientOriginalExtension();
                        $path = public_path('images/sliders/' . $filename);
                        Image::make($file->getRealPath())->resize(1100, 400)->save($path);
                        $slide->image=$filename;
                    }
                    if($slide->save())
                    {
                        return redirect('admin/slide')->with('thongbao','Cập nhật thành công!');
                    }
                    else{
                        return redirect('admin/slide')->with('thatbai','Cập nhật thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/slide')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteSlide($id)
    {
        if(session('user_admin')){
            $slide=Slide::find($id);
            $slide->status=0;

            if($slide->save())
            {
                if(file_exists('images/sliders/'.$slide->image))
                {
                    unlink('images/sliders/'.$slide->image);
                }
                return redirect('admin/slide')->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/slide')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
}
