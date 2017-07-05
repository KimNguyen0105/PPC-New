<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function HomePage()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $dataduan = DB::table('property')
            ->join('property_lang', 'property.id', '=', 'property_lang.property_id')
            ->where('status', 1)
            ->where('property_lang.lang',Session::get('locale'))
            ->orderBy('property.updated_at', 'desc')
            ->paginate(5);
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $videos = DB::table('videos')->orderBy('id', 'desc')->take(7)->get();

        $news = DB::table('news')->join('news_lang', 'news.id', '=', 'news_lang.new_id')
            ->where('status', 1)
            ->where('news_lang.lang', Session::get('locale'))
            ->orderBy('news.updated_at', 'desc')
            ->select('news.*', 'news_lang.title', 'news_lang.content', 'news.updated_at')->get();


        $systems = DB::table('ppc_system_config')->get();
        if (Session::get('locale') == 'vi') {
            $databanner = DB::table('introduce')->join('introduce_lang', 'introduce.id', '=', 'introduce_lang.introduce_id')
                ->where('introduce.parrent_id', 1)
                ->where('introduce_lang.lang', 'vi')
                ->where('status', 1)
                ->select('introduce.id', 'introduce.slug', 'introduce.image', 'introduce_lang.title')
                ->get();
        } else {
            $databanner = DB::table('introduce')->join('introduce_lang', 'introduce.id', '=', 'introduce_lang.introduce_id')
                ->where('introduce.parrent_id', 1)->where('introduce_lang.lang', 'en')
                ->where('status', 1)
                ->select('introduce.id', 'introduce.slug', 'introduce.image', 'introduce_lang.title')
                ->get();
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

    public function getPageProject()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $sale = DB::table('property')->join('property_lang', 'property.id', '=', 'property_lang.property_id')
            ->where('property.status', 1)
            ->where('property_lang.lang', Session::get('locale'))
            ->orderBy('updated_at', 'desc')
            ->select('property.id', 'property.image', 'property_lang.address', 'property.acreage', 'property.slug', 'property_lang.title', 'property_lang.info')
            ->paginate(15);
        return view('Page/project', [
            'sliders' => $sliders,
            'systems' => $systems,
            'sale' => $sale
        ]);
    }

    public function ProjectDetail($id)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $detail = DB::table('property')->join('property_lang', 'property.id', '=', 'property_lang.property_id')
            ->where('property.status', 1)
            ->where('property.id',$id)
            ->where('property_lang.lang', Session::get('locale'))
            ->orderBy('updated_at', 'desc')
            ->select('property.id', 'property.image', 'property_lang.address', 'property.acreage', 'property.slug', 'property_lang.title', 'property_lang.info')
            ->first();
        $dataimage = DB::table('property_image')
            ->where('id_property',$id)->get();
        return view('Page/projectdetail', [
            'sliders' => $sliders,
            'systems' => $systems,
            'detail' => $detail,
            'dataimage'=>$dataimage
        ]);
    }

    public function getPageAbout()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $data = DB::table('introduce')->join('introduce_lang', 'introduce.id', '=', 'introduce_lang.introduce_id')
            ->where('introduce.parrent_id', 0)
            ->where('introduce_lang.lang', Session::get('locale'))
            ->where('status', 1)
            ->select('introduce.*', 'introduce_lang.title', 'introduce_lang.content')
            ->first();

        return view('Page/about', [
            'data' => $data,
            'sliders' => $sliders,
            'systems' => $systems
        ]);
    }

    public function getAboutDetail($id)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $data = DB::table('introduce')->join('introduce_lang', 'introduce.id', '=', 'introduce_lang.introduce_id')
            ->where('introduce.parrent_id', 1)
            ->where('introduce.id', $id)
            ->where('introduce_lang.lang', Session::get('locale'))
            ->where('introduce.status', 1)
            ->select('introduce.*', 'introduce_lang.title', 'introduce_lang.content')
            ->first();

        return view('Page/about-ppc', [
            'data' => $data,
            'sliders' => $sliders,
            'systems' => $systems
        ]);
    }

    public function getPageNews()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $banner_tin = DB::table('category')->where('status', 1)->get();


        $news = DB::table('news')->join('news_lang', 'news.id', '=', 'news_lang.new_id')
            ->where('news.status', 1)
            ->where('news.id_category', 1)
            ->where('news_lang.lang', Session::get('locale'))
            ->select('news.*', 'news_lang.title', 'news_lang.content')
            ->orderBy('news.updated_at', 'desc')
            ->paginate(5);

        return view('Page/news', [
            'sliders' => $sliders,
            'systems' => $systems,
            'banner_tin' => $banner_tin,
            'news' => $news
        ]);
    }

    public function getNewsByCat($id)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $banner_tin = DB::table('category')->where('status', 1)->get();
        $banner_detail = DB::table('category')->where('id', $id)->first();
        $news = DB::table('news')->join('news_lang', 'news.id', '=', 'news_lang.new_id')
            ->join('category', 'news.id_category', '=', 'category.id')
            ->where('category.id', $id)
            ->where('news.status', 1)
            ->where('news.id_category', $id)
            ->where('news_lang.lang', Session::get('locale'))
            ->select('news.*', 'news_lang.title', 'news_lang.content')
            ->orderBy('news.updated_at', 'desc')
            ->paginate(5);

        return view('Page/newsbycat', [
            'banner_detail' => $banner_detail,
            'sliders' => $sliders,
            'systems' => $systems,
            'banner_tin' => $banner_tin,
            'news' => $news
        ]);
    }

    public function newsdetail($id)
    {
        if ($id == null) {
            return redirect('/500.html');
        } else {
            $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
            $news = DB::table('news')
                ->join('news_lang', 'news.id', '=', 'news_lang.new_id')
                ->where('news.id', $id)
                ->where('news_lang.lang', Session::get('locale'))
                ->select('news.*', 'news_lang.title', 'news_lang.content')
                ->first();
            $systems = DB::table('ppc_system_config')->get();
            //$new_related = DB::table('');
            $relation=DB::table('news')->find($id);

            $arr = explode(',',$relation->news_relation);

            $newrelation = DB::table('news')->join('news_lang', 'news.id', '=', 'news_lang.new_id')
                ->where('status', 1)
                ->where('news_lang.lang', Session::get('locale'))
                ->whereIn('news.id',$arr)
                ->orderBy('news.updated_at', 'desc')
                ->select('news.*', 'news_lang.title', 'news_lang.content', 'news.updated_at')->get();
            if ($news == null) {
                return redirect('/404.html');

            } else {
                return view('Page.newdetail', [
                        'news' => $news,
                        'sliders' => $sliders,
                        'systems' => $systems,
                        'newrelation'=>$newrelation
                    ]
                );
            }
        }

    }

    public function getPageGallery()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();


        return view('Page/gallery-ppc', [

            'sliders' => $sliders,
            'systems' => $systems
        ]);
    }

    public function notfound()
    {
        return view('Error.notfound');
    }

    public function badinternal()
    {
        return view('Error.badinternal');
    }

    public function getPageContact()
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

    public function postContact(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $title = $request->get('title');
        $content = $request->get('content');
        $is_copy = $request->get('is_copy') ? true : false;
        DB::table('contacts')->insert([
            'name' => $name,
            'email' => $email,
            'title' => $title,
            'content' => $content,
            'is_copy' => $is_copy
        ]);
        return redirect('/ppc-contact.html');

    }

    public function getSale()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $sale = DB::table('property')->join('property_lang', 'property.id', '=', 'property_lang.property_id')
            ->where('property.type', 0)
            ->where('property.status', 1)
            ->where('property_lang.lang', Session::get('locale'))
            ->orderBy('updated_at', 'desc')
            ->select('property.id', 'property.image', 'property_lang.address', 'property.acreage', 'property.slug', 'property_lang.title', 'property_lang.info')
            ->paginate(15);
        return view('Page/sale', [
            'sliders' => $sliders,
            'systems' => $systems,
            'sale' => $sale
        ]);
    }

    public function getRent()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $rent = DB::table('property')->join('property_lang', 'property.id', '=', 'property_lang.property_id')
            ->where('property.type', 1)
            ->where('property.status', 1)
            ->where('property_lang.lang', Session::get('locale'))
            ->orderBy('updated_at', 'desc')
            ->select('property.id', 'property.image', 'property_lang.address', 'property.acreage', 'property.slug', 'property_lang.title', 'property_lang.info')
            ->paginate(15);
        return view('Page/rent', [
            'sliders' => $sliders,
            'systems' => $systems,
            'rent' => $rent
        ]);
    }

    public function getPageRecruitment()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
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
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
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

    public function getPagePolicies()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        if(Session::get('locale')=='vi') {
            $data = DB::table('terms_web')
                ->where('status', 1)
                ->select('title','id','content','slug','image')
                ->get();
        } else {
            $data = DB::table('terms_web')
                ->where('status', 1)
                ->select('title_en as title','id','content_en as content','slug','image')
                ->get();
        }
        return view('Page/hrpolicies', [
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

    public function GetLoginPage()
    {
        //
    }

    public function PostLoginPage(Request $request)
    {
        $remember=$request->get('remember');

        if($request->get('username'))
        {
            if($request->get('password') && $remember)
            {
                $user=DB::table('users')->where('role',2)->where('username',$request->get('username'))->select('id','password')->first();

                if($user!=null && $user->password ==$request->get('password'))
                {
                    Session::put('username',$request->get('username'));
                    Session::put('user_id',$user->id);
                    return redirect()->back();
                }
                else{
                    $request->session()->flash('status', 'Wrong username or password. Try again');
                    return redirect()->back();
                }

            }

            else
            {
                return redirect('/');
            }
        }

    }

    public function logout()
    {
        Session::forget('username');
        return redirect('/');
    }

    function sitemap(){
        $tintuc = DB::table('news')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $project = DB::table('property')->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        return response()->view('home.sitemap', compact('tintuc','project'))->header('Content-Type', 'text/xml');
    }
}
