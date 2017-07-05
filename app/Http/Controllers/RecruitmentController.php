<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Recruitment_lang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class RecruitmentController extends Controller
{
    //
    public function RecruitmentHome()
    {
        if(session('user_admin')){

            $recruitment=DB::table('recruitment')
                ->join('recruitment_lang','recruitment.id','=','recruitment_lang.recruitment_id')
            ->where('recruitment.status',1)
                ->where('recruitment_lang.lang','vi')
                ->orderBy('recruitment.updated_at','desc')
                ->select('recruitment.id','recruitment.deadline','recruitment.image','recruitment_lang.title')
                ->get();
            return view('admin.recruitment.home',['recruitment'=>$recruitment]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetRecruitment($id)
    {
        if(session('user_admin')){
            try{
                $recruitment=Recruitment::find($id);
                $recruitment_lang=Recruitment_lang::where('recruitment_id',$id)->get();
                return view('admin.recruitment.insert',['recruitment'=>$recruitment,'recruitment_lang'=>$recruitment_lang]);
            }
            catch (\Exception $e)
            {
                return redirect('admin/recruitment');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveRecruitment(Request $request)
    {
        if(session('user_admin')){
            try{
                $id=$request->txtid;
                $title_vi=$request->title_vi;
                $title_en=$request->title_en;
                $content_vi=$request->introduce_vi;
                $content_en=$request->introduce_en;
                $deadline=$request->datepicker1;
                if($id==0)
                {
                    $recruitment=new Recruitment;
                    $recruitment->slug=str_slug($title_vi);
                    $recruitment->deadline=$deadline;
                    $recruitment->status=1;
                    if($request->hasFile('file')){
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/recruitment/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $recruitment->image=$filename;
                    }
                    if($recruitment->save())
                    {
                        $recruitment_vi=new Recruitment_lang;
                        $recruitment_vi->recruitment_id=$recruitment->id;
                        $recruitment_vi->title=$title_vi;
                        $recruitment_vi->lang='vi';
                        $recruitment_vi->content=$content_vi;

                        $recruitment_en=new Recruitment_lang;
                        $recruitment_en->recruitment_id=$recruitment->id;
                        $recruitment_en->title=$title_en;
                        $recruitment_en->lang='en';
                        $recruitment_en->content=$content_en;

                        $recruitment_vi->save();
                        $recruitment_en->save();
                        return redirect('admin/recruitment')->with('thongbao','Cập nhật thành công!');
                    }
                }
                else{
                    $recruitment=Recruitment::find($id);
                    $recruitment->slug=str_slug($title_vi);
                    $recruitment->deadline=$deadline;
                    if($request->hasFile('file')){
                        unlink("images/recruitment/".$recruitment->image);
                        $image = $request->file('file');
                        $filename  = time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/recruitment/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $recruitment->image=$filename;
                    }
                    if($recruitment->save())
                    {
                        $recruitment_vi=Recruitment_lang::where('lang','vi')->where('recruitment_id',$id)->first();
                        $recruitment_vi->title=$title_vi;
                        $recruitment_vi->content=$content_vi;

                        $recruitment_en=Recruitment_lang::where('lang','en')->where('recruitment_id',$id)->first();
                        $recruitment_en->title=$title_en;
                        $recruitment_en->content=$content_en;

                        $recruitment_vi->save();
                        $recruitment_en->save();
                        return redirect('admin/recruitment')->with('thongbao','Cập nhật thành công!');
                    }
                }

            }
            catch (\Exception $e)
            {
                dd($e);
                return redirect('admin/introduce-home')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteRecruitment($id)
    {
        if(session('user_admin')){
            $recruitment=Recruitment::find($id);
            $recruitment->status=0;
            unlink('images/recruitment/'.$recruitment->image);
            if($recruitment->save())
            {
                return redirect('admin/recruitment')->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/recruitment')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
}
