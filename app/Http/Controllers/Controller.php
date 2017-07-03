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
        $dataduan = DB::table('property')->join('property_lang', 'property.id', '=', 'property_lang.property_id')
            ->where('status', 1)->orderBy('property.id', 'desc')->paginate(3);
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $videos = DB::table('videos')->orderBy('id', 'desc')->take(7)->get();
        $news = DB::table('news')->join('news_lang', 'news.id', '=', 'news_lang.new_id')->where('status',1)->where('news_lang.lang', Session::get('locale'))->orderBy('news.updated_at', 'desc')
            ->select('news.*', 'news_lang.title', 'news_lang.content', 'news.updated_at')->get();
        dd($news);
        $systems = DB::table('ppc_system_config')->get();
        if (Session::get('locale') == 'vi') {
            $databanner = DB::table('introduce')->join('introduce_lang', 'introduce.id', '=', 'introduce_lang.introduce_id')
                ->where('introduce.parrent_id', 1)->where('introduce_lang.lang', 'vi')
                ->where('status', 1)->get();
        } else {
            $databanner = DB::table('introduce')->join('introduce_lang', 'introduce.id', '=', 'introduce_lang.introduce_id')
                ->where('introduce.parrent_id', 1)->where('introduce_lang.lang', 'en')
                ->where('status', 1)->get();
        }
        return view('Home/home', [
            'dataduan' => $dataduan,
            'sliders' => $sliders,
            'videos' => $videos,
            'news' => $news,
            'systems' => $systems,
            'databanner' => $databanner
        ]);
    }

    public function SetLanguage($locale)
    {
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function getProject()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        return view('Page/project', [
            'sliders' => $sliders,
            'systems' => $systems
        ]);
    }

    public function getAbout()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        return view('Page/about', [
            'sliders' => $sliders,
            'systems' => $systems
        ]);
    }

    public function getNews()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        return view('Page/news', [
            'sliders' => $sliders,
            'systems' => $systems
        ]);
    }

    public function newsdetail($id)
    {
        if ($id == null) {
            return redirect('/500.html');
        } else {
            $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
            $news = DB::table('news')->join('news_lang', 'news.id', '=', 'news_lang.new_id')->where('news.id', $id)->where('news_lang.lang', Session::get('locale'))->first();
            $systems = DB::table('ppc_system_config')->get();
            $new_related = DB::table('');
            if ($news == null) {
                return redirect('/404.html');

            } else {
                return view('Page.newdetail', ['news' => $news, 'sliders' => $sliders, 'systems' => $systems]);
            }
        }

    }

    public function notfound()
    {
        return view('Error.notfound');
    }

    public function badinternal()
    {
        return view('Error.badinternal');
    }

    public function getContact()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        return view('Page/contact', [
            'sliders' => $sliders,
            'systems' => $systems
        ]);
    }

    public function getSale()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $projectsale = DB::table('property')->join('property_image','property.id','=','property_image.id_property')
            ->join('property_lang','property.id','=','property_lang.property_id')->where('property_lang.lang',Session::get('locale'))
            ->where('property.type',0)->orderBy('property.updated_at','desc')->get();
        return view('Page/sale', [
            'sliders' => $sliders,
            'systems' => $systems,
            'projectsale'=>$projectsale
        ]);
    }

    public function getRent()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $projectrent = DB::table('property')->join('property_image','property.id','=','property_image.id_property')
            ->join('property_lang','property.id','=','property_lang.property_id')->where('property_lang.lang',Session::get('locale'))
            ->where('property.type',1)->orderBy('property.updated_at','desc')->get();
        return view('Page/rent', [
            'sliders' => $sliders,
            'systems' => $systems,
            'projectrent'=>$projectrent
        ]);
    }

    public function getRecruitment()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        return view('Page/recruitment', [
            'sliders' => $sliders,
            'systems' => $systems
        ]);
    }

    public function getPolicies()
	{
        $sliders = DB::table('sliders')->where('is_show', 1)->orderBy('updated_at', 'desc')->get();
        $systems = DB::table('ppc_system_config')->get();
        if (Session::get('locale') == 'vi') {
            $data = DB::table('recruitment')->join('recruitment_lang', 'recruitment.id', '=', 'recruitment_lang.recruitment_id')
                ->where('recruitment.status', 1)->orderBy('recruitment.updated_at', 'desc')
                ->where('recruitment_lang.lang', 'vi')
                ->select('recruitment.*','recruitment_lang.title','recruitment_lang.content')
                ->get();
        } else {
            $data = DB::table('recruitment')->join('recruitment_lang', 'recruitment.id', '=', 'recruitment_lang.recruitment_id')
                ->where('recruitment.status', 1)->orderBy('recruitment.updated_at', 'desc')
                ->where('recruitment_lang.lang', 'en')
                ->select('recruitment.*','recruitment_lang.title','recruitment_lang.content')
                ->get();
        }

        return view('Page/recruitment', [
            'sliders' => $sliders,
            'systems' => $systems,
            'data' => $data
        ]);
    }

    public function getRecruitmentDetail($id)

    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        $sliders = DB::table('sliders')->where('is_show', 1)->orderBy('updated_at', 'desc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $data = DB::table('recruitment')->join('recruitment_lang', 'recruitment.id', '=', 'recruitment_lang.recruitment_id')
            ->where('recruitment_lang.recruitment_id', $id)->where('recruitment.status', 1)
            ->where('recruitment_lang.lang', Session::get('locale'))
            ->select('recruitment.id', 'recruitment.status', 'recruitment.image', 'recruitment.updated_at', 'recruitment_lang.title', 'recruitment_lang.content')
            ->first();

        return view('Page/recruitment-detail', [
            'sliders' => $sliders,
            'systems' => $systems,
            'data' => $data,
        ]);
    }
	
    public function getPoliciesDetail($id)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        if(Session::get('locale')=='vi') {
            $data = DB::table('terms_web')
                ->where('id',$id)
                ->where('status', 1)
                ->select('title','id','content','slug','image')
                ->first();
        } else {
            $data = DB::table('terms_web')
                ->where('id',$id)
                ->where('status', 1)
                ->select('title_en as title','id','content_en as content','slug','image')
                ->first();
        }
        return view('Page/hrpolicies-detail', [
            'sliders' => $sliders,
            'systems' => $systems,
            'data' => $data,

        ]);
    }


}
