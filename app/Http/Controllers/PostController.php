<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App;
use Image;
class PostController extends Controller
{
    public function getFormPost()
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $project_types = DB::table('project')->where('status', 1)->get();
        $country = DB::table('country')->where('status', 1)->get();
        return view('Page/post', [
            'sliders' => $sliders,
            'systems' => $systems,
            'project_types' => $project_types,
            'country' => $country,
        ]);
    }

    public function getTinh($id)
    {
        $data = DB::table('province')->where('status', 1)->where('country_id', $id)->orderBy('sort_order', 'asc')->get();
        return $data->toJson();
    }

    public function getQuan($id)
    {
        $data = DB::table('district')->where('status', 1)->where('province_id', $id)->orderBy('sort_order', 'asc')->get();
        return $data->toJson();
    }

    public function postFormPost(Request $request)
    {
        $property = new App\Property;
        $property->type = $request->get('type');
        $property->investor = $request->get('investor');
        $property->acreage = $request->get('acreage');
        $property->area_apartment = $request->get('area_apartment');
        $property->apartment = $request->get('apartment');
        $property->floor = $request->get('floor');
        $property->bedroom = $request->get('bedroom');
        $property->bathroom = $request->get('bathroom');
        $property->project_id = $request->get('project_id');
        $property->country_id = $request->get('country_id');
        $property->province_id = $request->get('province_id');
        $property->district_id = $request->get('district_id');
        $property->price = $request->get('price');
        $property->address = $request->get('address');
        $property->phone = $request->get('phone');
        $property->email = $request->get('email');
        //$property->image = $request->file('imgDuAn');
        //$property->address = $request->get('address');
        $property->id_user = Session::get('user_id');
        $property->slug = str_slug($request->get('title'));
        $property->is_form = 0;
        $property->status = 0;
        $property->seo_keyword = $request->get('title');
        $property->seo_description = $request->get('title');
        $property->seo_author = $request->get('title');
        //$property->image_overall = $request->file('imgGeneral');
        if($request->hasFile('imgDuAn'))
        {
            //unlink('images/sliders/'.$slide->image);
            $file=$request->file('imgDuAn');
            $filename  = 'image-'.time(). '.' .str_slug($request->get('title')). '.' . $file->getClientOriginalExtension();
            $path = public_path('images/property/' . $filename);
            Image::make($file->getRealPath())->resize(300, 200)->save($path);
            $property->image=$filename;
        }
        if($request->hasFile('imgGeneral'))
        {
            $file=$request->file('imgGeneral');
            $filename  = 'image-overall'.time(). '.' .str_slug($request->get('title')). '.' . $file->getClientOriginalExtension();
            $path = public_path('images/property/' . $filename);
            Image::make($file->getRealPath())->resize(300, 200)->save($path);
            $property->image_overall=$filename;
        }
        if ($property->save()) {
            if($request->hasFile('imgDetail'))
            {
                $file_ary = $request->file('imgDetail');
                $i=1;
                foreach ($file_ary as $file) {
                    $filename=$i.time() . '.'.str_slug($request->get('title')).'.' . $file->getClientOriginalExtension();
                    $path = public_path('images/property_image/' . $filename);
                    Image::make($file->getRealPath())->resize(300, 200)->save($path);
                    $property_image=new Property_Image;
                    $property_image->id_property=$property->id;
                    $property_image->image=$filename;
                    $property_image->status=1;
                    $property_image->save();
                    $i++;
                }
            }
//            DB::table('property_image')->insert([
//                'id_property' => $property->id,
//                //'image' => $request->file('imgDetail'),
//                'status' => 1,
//
//
//            ]);
            DB::table('property_lang')->insert([
                'property_id' => $property->id,
                'lang' => 'vi',
                'title' => $request->get('title'),
                'service' => $request->get('service'),
                'ownership' => $request->get('ownership'),
                'info' => $request->get('info'),
                'address' => $request->get('address')
            ]);
             DB::table('property_lang')->insert([
                'property_id' => $property->id,
                'lang' => 'en',
                'title' => $request->get('title'),
                'service' => $request->get('service'),
                'ownership' => $request->get('ownership'),
                'info' => $request->get('info'),
                'address' => $request->get('address')
            ]);
        }

        $sliders = DB::table('sliders')->where('is_show', 1)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        $systems = DB::table('ppc_system_config')->get();
        $project_types = DB::table('project')->where('status', 1)->get();
        $country = DB::table('country')->where('status', 1)->get();
        return view('Page/post', [
            'sliders' => $sliders,
            'systems' => $systems,
            'project_types' => $project_types,
            'country' => $country,
        ]);
    }
}
