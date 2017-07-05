<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Introduce;
use App\Introduce_lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class IntroduceController extends Controller
{
    //
    public function Home()
    {
        if(session('user_admin')){
            $introduce=DB::table('introduce')
                ->join('introduce_lang','introduce.id','=','introduce_lang.introduce_id')
                ->where('introduce.status',1)
                ->where('introduce_lang.lang','vi')
                ->where('introduce.parrent_id',0)
                ->select('introduce.id','introduce.image','introduce_lang.title')
                ->orderBy('introduce.updated_at','desc')->get();

            return view('admin.introduce.home',['introduce'=>$introduce]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function Banner()
    {
        if(session('user_admin')){
            $introduce=DB::table('introduce')
                ->join('introduce_lang','introduce.id','=','introduce_lang.introduce_id')
                ->where('introduce.status',1)
                ->where('introduce_lang.lang','vi')
                ->where('introduce.parrent_id',1)
                ->select('introduce.id','introduce.image','introduce_lang.title')
                ->orderBy('introduce.updated_at','desc')->get();

            return view('admin.introduce.banner',['introduce'=>$introduce]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetIntroduce($id)
    {
        if(session('user_admin')){
            $introduce=Introduce::find($id);
            $introduce_lang=DB::table('introduce')
                ->join('introduce_lang','introduce.id','=','introduce_lang.introduce_id')
                ->where('introduce.id',$id)
                ->orderBy('introduce.updated_at','desc')
                ->select('introduce_lang.*')
                ->get();
            return view('admin.introduce.insert',['introduce'=>$introduce,'introduce_lang'=>$introduce_lang]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetBanner($id)
    {
        if(session('user_admin')){
            $introduce=Introduce::find($id);
            $introduce_lang=DB::table('introduce')
                ->join('introduce_lang','introduce.id','=','introduce_lang.introduce_id')
                ->where('introduce.id',$id)
                ->orderBy('introduce.updated_at','desc')
                ->select('introduce_lang.*')
                ->get();
            return view('admin.introduce.insert_banner',['introduce'=>$introduce,'introduce_lang'=>$introduce_lang]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveIntroduce(Request $request)
    {
        if(session('user_admin')){
            try{
                $id=$request->txtid;
                $title_vi=$request->title_vi;
                $title_en=$request->title_en;
                $content_vi=$request->introduce_vi;
                $content_en=$request->introduce_en;
                    $introduce=Introduce::find($id);
                    $introduce->slug=str_slug($title_vi);
                    if($request->hasFile('file')){
                        if(file_exists("images/introduce/".$introduce->image))
                        {
                            unlink("images/introduce/".$introduce->image);
                        }
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/introduce/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $introduce->image=$filename;
                    }
                    if($introduce->save())
                    {
                        $introduce_vi=Introduce_lang::where('lang','vi')->where('introduce_id',$id)->first();
                        $introduce_vi->title=$title_vi;
                        $introduce_vi->content=$content_vi;

                        $introduce_en=Introduce_lang::where('lang','en')->where('introduce_id',$id)->first();
                        $introduce_en->title=$title_en;
                        $introduce_en->content=$content_en;

                        $introduce_vi->save();
                        $introduce_en->save();
                        return redirect('admin/introduce-home')->with('thongbao','Cập nhật thành công!');
                    }
            }
            catch (\Exception $e)
            {
                return redirect('admin/introduce-home')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveBanner(Request $request)
    {
        if(session('user_admin')){
            try{
                $id=$request->txtid;
                $title_vi=$request->title_vi;
                $title_en=$request->title_en;
                $content_vi=$request->introduce_vi;
                $content_en=$request->introduce_en;
                $introduce=Introduce::find($id);
                $introduce->slug=str_slug($title_vi);
                if($request->hasFile('file')){
                    if(file_exists("images/introduce/".$introduce->image))
                    {
                        unlink("images/introduce/".$introduce->image);
                    }
                    $image = $request->file('file');
                    $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                    $path = public_path('images/introduce/' . $filename);
                    Image::make($image->getRealPath())->resize(300, 200)->save($path);
                    $introduce->image=$filename;
                }
                if($introduce->save())
                {
                    $introduce_vi=Introduce_lang::where('lang','vi')->where('introduce_id',$id)->first();
                    $introduce_vi->title=$title_vi;
                    $introduce_vi->content=$content_vi;

                    $introduce_en=Introduce_lang::where('lang','en')->where('introduce_id',$id)->first();
                    $introduce_en->title=$title_en;
                    $introduce_en->content=$content_en;

                    $introduce_vi->save();
                    $introduce_en->save();
                    return redirect('admin/banner')->with('thongbao','Cập nhật thành công!');
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/banner')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function Profile()
    {
        if(session('user_admin')){
            $name='profile.pdf';
            $size=filesize("profile/profile.pdf");
            $mb=round($size/(1024*1024),2);
            return view('admin.introduce.profile',['name'=>$name,'mb'=>$mb]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveProfile(Request $request)
    {
        if(session('user_admin')){
            if($request->hasFile('file')){
                $tmp_name = $_FILES["file"]["tmp_name"];
                $name = "profile/profile.pdf";
                move_uploaded_file($tmp_name, $name);
            }
            return redirect('admin/profile')->with('thongbao','Cập nhật thành công!');
        }
        else{
            return redirect('admin/log-in');
        }
    }
}
