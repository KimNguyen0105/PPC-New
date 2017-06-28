<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Introduce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class IntroduceController extends Controller
{
    //
    public function Home()
    {
        if(Auth::check()){
            $introduce=DB::table('introduce')
                ->join('introduce_lang','introduce.id','=','introduce_lang.introduce_id')
                ->where('introduce.status',1)
                ->where('introduce_lang.lang','vi')
                ->where('introduce.parrent_id',0)
                ->orderBy('introduce.updated_at','desc')->get();

            return view('admin.introduce.home',['introduce'=>$introduce]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetIntroduce($id)
    {
        if(Auth::check()){
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
    public function SaveIntroduce(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $title_vi=$request->title_vi;
                $title_en=$request->title_en;
                $introduce_vi=$request->introduce_vi;
                $introduce_en=$request->introduce_en;
                if($id==0)
                {
                    $introduce=new Introduce;
                    $introduce->status=1;
                    $introduce->show_home=0;
                    $image = $request->file('file');
                    $input['imagename'] = time().'.'.$image->getClientOriginalExtension();



                    $destinationPath = public_path('/images');
                    $img = Image::make($image->getRealPath());
                    $img->resize(200, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$input['imagename']);

                    $destinationPath = public_path('/images');
                    $image->move($destinationPath, $input['imagename']);
                    
//                    if($request->hasFile('file'))
//                    {
//                        $file=$request->file('file');
//                        $filename=time().'_'.$file->getClientOriginalName('file');
//                        $file->move('images/introduce',$filename);
//                        $image = Image::make(sprintf('images/introduce/%', $filename))->resize(200, 200)->save();
//
//                        $introduce->image=$filename;
//                    }
                }
                else{

                }
            }
            catch (\Exception $e)
            {

            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
}
