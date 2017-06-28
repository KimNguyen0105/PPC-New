<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function Home()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $dataduan=DB::table('property')->join('property_lang','property.id','=','property_lang.property_id')
                                        ->where('status',1)->orderBy('property.id','desc')->get();
        $sliders=DB::table('sliders')->where('is_show',1)->orderBy('updated_at','desc')->get();   
        $videos = DB::table('videos')->orderBy('id','desc')->take(1)->get();   
        $news = DB::table('news')->join('news_lang','news.id','=','news_lang.new_id')->orderBy('news.updated_at','desc')->get();                       
       
        return view('Home.home',[
            'dataduan' => $dataduan,
            'sliders'=>$sliders,
            'videos'=>$videos,
            'news'=>$news
        ]);
    }
    public function SetLanguage($locale)
    {
        Session::put('locale', $locale);
        return redirect()->back();
    }
    // public function getSlider()
    // {
    //     $sliders=DB::table('sliders')->where('is_show',1)->orderBy('updated_at','desc')->get();
    //     return response()->json(['slider'=>$sliders]);
    // }
}
