<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\System_Config;
use Illuminate\Support\Facades\DB;
use Image;

class ConfigController extends Controller
{
    //
    public function Home()
    {
        if(session('user_admin')){
            $config=DB::table('ppc_system_config')->first();
            return view('admin.config',['config'=>$config]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveConfig(Request $request)
    {
        if(session('user_admin')){
            try{
                $id=1;
                $phone=$request->phone;
                $address_vi=$request->address_vi;
                $address_en=$request->address_en;

                $usa_vi=$request->usa_vi;
                $usa_en=$request->usa_en;

                $fb_link=$request->link_face;
                $youtube_link=$request->link_youtube;
                $twiter_link=$request->link_twitter;
                $linked_link=$request->link_link;

                $author=$request->author;
                $description=$request->description;
                $keyword=$request->keyword;
                $google=$request->google_analytic;

                $config=System_Config::find($id);
                $config->company_info=$address_vi;
                $config->company_info_en=$address_en;
                $config->ppc_usa_info=$usa_vi;
                $config->ppc_usa_info_en=$usa_en;
                $config->ppc_phonenumber=$phone;
                $config->fb_link=$fb_link;
                $config->youtube_link=$youtube_link;
                $config->twiter_link=$twiter_link;
                $config->linked_link=$linked_link;
                $config->ppc_author=$author;
                $config->ppc_description=$description;
                $config->ppc_seokeyword=$keyword;
                $config->google_analytic=$google;
                if($request->hasFile('file')){
                    unlink("images/system_config/".$config->ppc_logo);
                    $image = $request->file('file');
                    $filename  = time() . '.logo.' . $image->getClientOriginalExtension();
                    $path = public_path('images/system_config/' . $filename);
                    Image::make($image->getRealPath())->resize(150, 150)->save($path);
                    $config->ppc_logo=$filename;
                }
                if($config->save())
                {
                    return redirect('admin/system-config')->with('thongbao','Cập nhật thành công!');
                }
                else{
                    return redirect('admin/system-config')->with('thatbai','Cập nhật thất bại!');
                }
            }
            catch (\Exception $e)
            {
                dd($e);
                return redirect('admin/system-config')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
}
