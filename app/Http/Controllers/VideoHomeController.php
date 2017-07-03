<?php

namespace App\Http\Controllers;

use App\VideoHome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VideoHomeController extends Controller
{
    //
    public function Home()
    {
        if(Auth::check()){
            $video=VideoHome::where('status',1)->orderBy('updated_at','desc')->get();
            return view('admin.videohome',['video'=>$video]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveVideo(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $url=$request->txtlink;
                $sort=$request->txtthutu;
                $show=0;
                $thumb1=substr($url,32);
                $tr=explode("&", $thumb1);
                $thumb=$tr[0];
                if($request->txtshow)
                {
                    $show=1;
                }
                if($id==0)
                {
                    $slide=new VideoHome;
                    $slide->is_show=$show;
                    $slide->url=$url;
                    $slide->thumb=$thumb;
                    $slide->sort_order=$sort;
                    $slide->status=1;
                    if($slide->save())
                    {
                        return redirect('admin/video-home')->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/video-home')->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $slide=VideoHome::find($id);
                    $slide->is_show=$show;
                    $slide->sort_order=$sort;
                    $slide->url=$url;
                    $slide->thumb=$thumb;
                    if($slide->save())
                    {
                        return redirect('admin/video-home')->with('thongbao','Cập nhật thành công!');
                    }
                    else{
                        return redirect('admin/video-home')->with('thatbai','Cập nhật thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/video-home')->with('thatbai','Thêm thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function XoaVideo($id)
    {
        $slide=VideoHome::find($id);
        $slide->status=0;
        if($slide->save())
        {
            return redirect('admin/video-home')->with('thongbao','Xóa thành công!');
        }
        else{
            return redirect('admin/video-home')->with('thatbai','Xóa thất bại!');
        }
    }
}
