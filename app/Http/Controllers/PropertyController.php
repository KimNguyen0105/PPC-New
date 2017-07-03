<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Property;
use App\Property_lang;
use App\Property_Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class PropertyController extends Controller
{
    //
    public function Project()
    {
        if(Auth::check()){
            $project=Project::where('status',1)->get();
            return view('admin.property.project',['project'=>$project]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveProject(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $name=$request->name;
                $name_en=$request->name_en;
                if($id==0)
                {
                    $country=new Project();
                    $country->name=$name;
                    $country->name_en=$name_en;
                    $country->status=1;
                    if($country->save())
                    {
                        return redirect('admin/project')->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/project')->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $country=Project::find($id);
                    $country->name=$name;
                    $country->name_en=$name_en;
                    if($country->save())
                    {
                        return redirect('admin/project')->with('thongbao','Cập nhật thành công!');
                    }
                    else{
                        return redirect('admin/project')->with('thatbai','Cập nhật thất bại!');
                    }
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
    public function DeleteProject($id)
    {
        if(Auth::check()){
            $country=Project::find($id);
            $country->status=0;
            if($country->save())
            {
                return redirect('admin/project')->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/project')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function Property()
    {
        if(Auth::check()){
            $property=DB::table('project')
                ->join('property','project.id','=','property.project_id')
                ->join('property_lang','property.id','=','property_lang.property_id')
                ->where('property.status','<>',-1)
                ->where('project.status',1)
                ->where('property_lang.lang','vi')
                ->orderBy('property.updated_at','desc')
                ->select('property.id','property.image','project.name','property_lang.title','property.status')
                ->get();
            ;
            return view('admin.property.home',['property'=>$property]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function GetProperty($id)
    {
        if(Auth::check()){
            try{
                if($id==0)
                {
                    $project=Project::where('status','<>',-1)->get();
                    $country=DB::table('country')->where('status',1)->get();
                    return view('admin.property.insert_property',['project'=>$project,
                        'country'=>$country]);
                }
                else{
                    $project=Project::where('status','<>',-1)->get();
                    $country=DB::table('country')->where('status',1)->get();
                    $property=Property::find($id);
                    $property_lang=Property_lang::where('property_id',$id)->get();
                    $province=DB::table('province')->where('country_id',$property->country_id)->where('status',1)->get();
                    $district=DB::table('district')->where('province_id',$property->province_id)->where('status',1)->get();
                    $property_image=Property_Image::where('id_property',$id)->where('status',1)->get();
                    return view('admin.property.detail_property',['project'=>$project,
                        'country'=>$country,'province'=>$province,'district'=>$district,
                        'property'=>$property,'property_lang'=>$property_lang,'property_image'=>$property_image]);
                }

            }
            catch (\Exception $e)
            {
                return redirect('admin/property')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function getLagLng($address)
    {
        $url = 'http://maps.google.com/maps/api/geocode/json?address=' . urlencode($address);
        $output =$this-> httpGetLagLng($url);
        $data = json_decode($output, true);
        if(isset( $data['results'][0]['geometry']['location']))
        {
            $geometry = $data['results'][0]['geometry']['location'];
        }
        else{
            $geometry =['lat'=>0,'lng'=>0];
        }

        $lat = $geometry['lat'];
        $lng = $geometry['lng'];
        return [$lat, $lng];
    }

    public function httpGetLagLng($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    public function SaveProperty(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $title_vi=$request->title_vi;
                $ownership_vi=$request->ownership_vi;
                $investor_vi=$request->investor_vi;
                $address_vi=$request->address_vi;
                $info_vi=$request->info_vi;
                $service_vi=$request->service_vi;

                $title_en=$request->title_en;
                $ownership_en=$request->ownership_en;
                $investor_en=$request->investor_en;
                $address_en=$request->address_en;
                $info_en=$request->info_en;
                $service_en=$request->service_en;

                $type=$request->type;
                $is_form = $request->has('form') ? 1 : 0;
                $floor=$request->floor;
                $apartment=$request->apartment;
                $bed=$request->bed;
                $bath=$request->bath;
                $area_apartment=$request->area_apartment;
                $acreage=$request->acreage;
                $price=$request->price;
                $phone=$request->phone;
                $email=$request->email;

                $project=$request->project;
                $country=$request->country;
                $province=$request->province;
                $district=$request->district;
                $author=$request->author;
                $keyword=$request->keyword;
                $description=$request->description;

                list($latitude, $longtitude) =$this->getLagLng($address_vi);
                if($id==0)
                {
                    $property=new Property;
                    $property->project_id=$project;
                    $property->country_id=$country;
                    $property->province_id=$province;
                    $property->district_id=$district;
                    $property->type=$type;
                    $property->floor=$floor;
                    $property->apartment=$apartment;
                    $property->bedroom=$bed;
                    $property->bathroom=$bath;
                    $property->area_apartment=$area_apartment;
                    $property->acreage=$acreage;
                    $property->price=$price;
                    $property->phone=$phone;
                    $property->email=$email;

                    $property->status=1;
                    $property->slug=str_slug($title_vi);
                    $property->seo_keyword=$keyword;
                    $property->seo_description=$description;
                    $property->seo_author=$author;
                    $property->is_form=$is_form;
                    $property->latitude=$latitude;
                    $property->longtitude=$longtitude;
                    $property->id_user=0;

                    if($request->hasFile('file')){
                        $image = $request->file('file');
                        $filename  = 'image-'.time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/property/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $property->image=$filename;
                    }
                    if($request->hasFile('file-overall')){
                        $image = $request->file('file-overall');
                        $filename  = 'image-overall'.time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/property/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $property->image_overall=$filename;
                    }
                    if($property->save())
                    {
                        if($request->hasFile('file-multi'))
                        {
                            $file_ary = $request->file('file-multi');
                            $i=1;
                            foreach ($file_ary as $file) {
                                $filename=$i.time() . '.'.str_slug($title_vi).'.' . $file->getClientOriginalExtension();
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
                        $property_vi=new Property_lang;
                        $property_vi->property_id=$property->id;
                        $property_vi->lang='vi';
                        $property_vi->title=$title_vi;
                        $property_vi->address=$address_vi;
                        $property_vi->investor=$investor_vi;
                        $property_vi->info=$info_vi;
                        $property_vi->ownership=$ownership_vi;
                        $property_vi->service=$service_vi;

                        $property_en=new Property_lang;
                        $property_en->property_id=$property->id;
                        $property_en->lang='en';
                        $property_en->title=$title_en;
                        $property_en->address=$address_en;
                        $property_en->investor=$investor_en;
                        $property_en->info=$info_en;
                        $property_en->ownership=$ownership_en;
                        $property_en->service=$service_en;

                        $property_vi->save();
                        $property_en->save();
                        return redirect('admin/property')->with('thongbao','Thêm tin tức thành công!');
                    }
                    else{
                        return redirect('admin/property')->with('thatbai','Thêm tin tức thất bại!');
                    }
                }
                else{
                    $property=Property::find($id);
                    $property->project_id=$project;
                    $property->country_id=$country;
                    $property->province_id=$province;
                    $property->district_id=$district;
                    $property->type=$type;
                    $property->floor=$floor;
                    $property->apartment=$apartment;
                    $property->bedroom=$bed;
                    $property->bathroom=$bath;
                    $property->area_apartment=$area_apartment;
                    $property->acreage=$acreage;
                    $property->price=$price;
                    $property->phone=$phone;
                    $property->email=$email;

                    $property->status=1;
                    $property->slug=str_slug($title_vi);
                    $property->seo_keyword=$keyword;
                    $property->seo_description=$description;
                    $property->seo_author=$author;
                    $property->is_form=$is_form;
                    $property->latitude=$latitude;
                    $property->longtitude=$longtitude;
                    $property->id_user=0;

                    if($request->hasFile('file')){
                        unlink('images/property/'.$property->image);
                        $image = $request->file('file');
                        $filename  ='image-'. time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/property/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $property->image=$filename;
                    }
                    if($request->hasFile('file-overall')){
                        unlink('images/property/'.$property->image_overall);
                        $image = $request->file('file-overall');
                        $filename  = 'image-overall'.time() . '.'.str_slug($title_vi).'.' . $image->getClientOriginalExtension();
                        $path = public_path('images/property/' . $filename);
                        Image::make($image->getRealPath())->resize(300, 200)->save($path);
                        $property->image_overall=$filename;
                    }
                    if($property->save())
                    {
                        if($request->hasFile('file-multi'))
                        {
                            $file_ary = $request->file('file-multi');
                            $i=1;
                            foreach ($file_ary as $file) {
                                $filename=$i.time() . '.'.str_slug($title_vi).'.' . $file->getClientOriginalExtension();
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
                        $id_vi=$request->id_vi;
                        $id_en=$request->id_en;

                        $property_vi=Property_lang::find($id_vi);
                        $property_vi->title=$title_vi;
                        $property_vi->address=$address_vi;
                        $property_vi->investor=$investor_vi;
                        $property_vi->info=$info_vi;
                        $property_vi->ownership=$ownership_vi;
                        $property_vi->service=$service_vi;

                        $property_en=Property_lang::find($id_en);
                        $property_en->title=$title_en;
                        $property_en->address=$address_en;
                        $property_en->investor=$investor_en;
                        $property_en->info=$info_en;
                        $property_en->ownership=$ownership_en;
                        $property_en->service=$service_en;

                        $property_vi->save();
                        $property_en->save();
                        return redirect('admin/property')->with('thongbao','Thêm tin tức thành công!');
                    }
                    else{
                        return redirect('admin/property')->with('thatbai','Thêm tin tức thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                dd($e);
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }

    public function DeleteProperty($id)
    {
        if(Auth::check()){
            $property=Property::find($id);
            $property->status=-1;

            if($property->save())
            {
                unlink('images/property/'.$property->image_overall);
                return redirect('admin/property')->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/property')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function DeletePropertyImage($id,$id_image)
    {
        if(Auth::check()){
            $property=Property_Image::find($id_image);
            $property->status=0;
            if($property->save())
            {
                unlink('images/property_image/'.$property->image_overall);
                return redirect('admin/property/'.$id)->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/property'.$id)->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
}
