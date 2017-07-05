<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App;

class SearchController extends Controller
{
    public  function Search(){
        $search = \Request::get('search');
        $project = $dataduan = DB::table('property')
            ->join('property_lang', 'property.id', '=', 'property_lang.property_id')
            ->where('status', 1)
            ->where('property_lang.lang',Session::get('locale'))
            ->where('property_lang.title','like','%'.$search.'%')
            ->orWhere('property_lang.address','like','%'.$search.'%')
            ->orWhere('property.acreage','like','%'.$search.'%')
            ->orWhere('property_lang.info','like','%'.$search.'%')
            ->select('property.id', 'property.image', 'property_lang.address', 'property.acreage', 'property.slug', 'property_lang.title', 'property_lang.info')
            ->orderBy('property.updated_at', 'desc')
            ->paginate(15);
        $news =$news = DB::table('news')->join('news_lang', 'news.id', '=', 'news_lang.new_id')
            ->where('status', 1)
            ->where('news_lang.lang', Session::get('locale'))
            ->where('news_lang.title','like','%'.$search.'%')
            ->where('news_lang.content','like','%'.$search.'%')
            ->orderBy('news.updated_at', 'desc')
            ->select('news.*', 'news_lang.title', 'news_lang.content', 'news.updated_at')->get();
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        return View('Home.Search',[
            'project'=>$project,
            'news'=>$news,
            'sliders'=>$sliders,
            'systems'=>$systems
        ]);
    }
}