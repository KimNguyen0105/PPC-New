<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Term_web;
use App\Partners;
use Image;

class TermController extends Controller
{
    //
    public function Home()
    {
        if(Auth::check()){
            $term=Term_web::where('status',1)
                ->orderBy('updated_at','desc')->get();
            return view('admin.term.home',['term'=>$term]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetTerm($id)
    {
        if(Auth::check()){
            $term=Term_web::find($id);
            return view('admin.term.insert',['term'=>$term]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveTerm(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $title_vi=$request->title_vi;
                $title_en=$request->title_en;
                $content_vi=$request->introduce_vi;
                $content_en=$request->introduce_en;

                $term=Term_web::find($id);
                $term->slug=str_slug($title_vi);
                $term->title=$title_vi;
                $term->title_en=$title_en;
                $term->content=$content_vi;
                $term->content_en=$content_en;
                    if($request->hasFile('file')){
                        unlink("images/terms_web/".$term->image);
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/terms_web/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $term->image=$filename;
                    }
                    if($term->save())
                    {
                        return redirect('admin/term')->with('thongbao','Cập nhật thành công!');
                    }
            }
            catch (\Exception $e)
            {
                return redirect('admin/term')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function PartnersHome()
    {
        if(Auth::check()){
            $partners=Partners::where('status',1)
                ->orderBy('id','desc')->get();
            return view('admin.term.partners',['partners'=>$partners]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SavePartners(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $name=$request->name;
                $name_en=$request->name_en;
                $link=$request->link;
                if($id==0)
                {
                    $partners=new Partners;
                    $partners->name=$name;
                    $partners->name_en=$name_en;
                    $partners->link=$link;
                    $partners->status=1;
                    if($request->hasFile('file'))
                    {
                        $file=$request->file('file');
                        $filename  = time() . '.' . $file->getClientOriginalExtension();
                        $path = public_path('images/partners/' . $filename);
                        Image::make($file->getRealPath())->resize(300, 200)->save($path);
                        $partners->image=$filename;
                    }
                    if($partners->save())
                    {
                        return redirect('admin/partners')->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/partners')->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $partners=Partners::find($id);
                    $partners->name=$name;
                    $partners->name_en=$name_en;
                    $partners->link=$link;
                    if($request->hasFile('file'))
                    {
                        //unlink('images/sliders/'.$partners->image);
                        $file=$request->file('file');
                        $filename  = time() . '.' . $file->getClientOriginalExtension();
                        $path = public_path('images/partners/' . $filename);
                        Image::make($file->getRealPath())->resize(300, 200)->save($path);
                        $partners->image=$filename;
                    }
                    if($partners->save())
                    {
                        return redirect('admin/partners')->with('thongbao','Cập nhật thành công!');
                    }
                    else{
                        return redirect('admin/partners')->with('thatbai','Cập nhật thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/partners')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeletePartners($id)
    {
        if(Auth::check()){
            $partners=Partners::find($id);
            $partners->status=0;
            unlink('images/partners/'.$partners->image);
            if($partners->save())
            {
                return redirect('admin/partners')->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/partners')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
}
