<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\District;
use App\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class FilterController extends Controller
{
    public function Country()
    {
        if(Auth::check()){
            $country=Country::where('status',1)->orderBy('id','desc')->get();
            return view('admin.filter.country',['country'=>$country]);
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function SaveCountry(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $name=$request->name;
                $name_en=$request->name_en;
                if($id==0)
                {
                    $country=new Country;
                    $country->name=$name;
                    $country->name_en=$name_en;
                    $country->status=1;
                    if($country->save())
                    {
                        return redirect('admin/country')->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/country')->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $country=Country::find($id);
                    $country->name=$name;
                    $country->name_en=$name_en;
                    if($country->save())
                    {
                        return redirect('admin/country')->with('thongbao','Cập nhật thành công!');
                    }
                    else{
                        return redirect('admin/country')->with('thatbai','Cập nhật thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/country')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteCountry($id)
    {
        if(Auth::check()){
            $country=Country::find($id);
            $country->status=0;
            if($country->save())
            {
                return redirect('admin/country')->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/country')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function Province()
    {
        if(Auth::check()){
            $country=Country::where('status',1)->get();
            $province=DB::table('country')
                ->join('province','country.id','=','province.country_id')
                ->where('country.status',1)
                ->where('province.status',1)
                ->orderBy('province.id','desc')
                ->select('province.*','country.name as country')
                ->paginate(10);
            return view('admin.filter.province',['search'=>'','id_country'=>0,'country'=>$country,'province'=>$province]);
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function SaveProvince(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $name=$request->name;
                $name_en=$request->name_en;
                $country=$request->country;
                $sort=$request->thutu;
                if($id==0)
                {
                    $province=new Province;
                    $province->name=$name;
                    $province->name_en=$name_en;
                    $province->country_id=$country;
                    $province->status=1;
                    $province->sort_order=$sort;
                    if($province->save())
                    {
                        return redirect('admin/province')->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/province')->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $province=Province::find($id);
                    $province->name=$name;
                    $province->name_en=$name_en;
                    $province->country_id=$country;
                    $province->sort_order=$sort;
                    if($province->save())
                    {
                        return redirect('admin/province')->with('thongbao','Cập nhật thành công!');
                    }
                    else{
                        return redirect('admin/province')->with('thatbai','Cập nhật thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                return redirect('admin/province')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteProvince($id)
    {
        if(Auth::check()){
            $province=Province::find($id);
            $province->status=0;
            if($province->save())
            {
                return redirect('admin/province')->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/province')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }

    public function District()
    {
        if(Auth::check()){
            $country=Country::where('status',1)->get();
            $province=null;
            $district=DB::table('country')
                ->join('province','country.id','=','province.country_id')
                ->join('district','province.id','=','district.province_id')
                ->where('province.status',1)
                ->where('district.status',1)
                ->orderBy('district.id','desc')
                ->select('district.*','province.name as province','province.id as id_province','country.name as country','country.id as id_country')
                ->paginate(10);
            return view('admin.filter.district',['search'=>'','id_country'=>0,'id_province'=>0,'country'=>$country,'province'=>$province,'district'=>$district]);
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function SaveDistrict(Request $request)
    {
        if(Auth::check()){
            try{
                $id=$request->txtid;
                $name=$request->name;
                $name_en=$request->name_en;
                $province=$request->province;
                $sort=$request->thutu;
                if($id==0)
                {
                    $district=new District;
                    $district->name=$name;
                    $district->name_en=$name_en;
                    $district->province_id=$province;
                    $district->sort_order=$sort;
                    $district->status=1;
                    if($district->save())
                    {
                        return redirect('admin/district')->with('thongbao','Thêm thành công!');
                    }
                    else{
                        return redirect('admin/district')->with('thatbai','Thêm thất bại!');
                    }
                }
                else{
                    $district=District::find($id);
                    $district->name=$name;
                    $district->name_en=$name_en;
                    $district->province_id=$province;
                    $district->sort_order=$sort;
                    if($district->save())
                    {
                        return redirect('admin/district')->with('thongbao','Cập nhật thành công!');
                    }
                    else{
                        return redirect('admin/district')->with('thatbai','Cập nhật thất bại!');
                    }
                }
            }
            catch (\Exception $e)
            {
                dd($e);
                return redirect('admin/district')->with('thatbai','Cập nhật thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }
    }
    public function DeleteDistrict($id)
    {
        if(Auth::check()){
            $district=District::find($id);
            $district->status=0;
            if($district->save())
            {
                return redirect('admin/district')->with('thongbao','Xóa thành công!');
            }
            else{
                return redirect('admin/district')->with('thatbai','Xóa thất bại!');
            }
        }
        else{
            return redirect('admin/log-in');
        }

    }
    public function GetProvince(Request $request)
    {
        $id=$request->get('id');
        $province=Province::where('country_id',$id)->where('status',1)->get();
        return response()->json(['province'=>$province]);
    }
    public function GetDistrict(Request $request)
    {
        $id=$request->get('id');
        $district=District::where('province_id',$id)->where('status',1)->get();
        return response()->json(['district'=>$district]);
    }
    public function SearchDistrict(Request $request)
{
    if(Auth::check()){
        $name=$request->txtsearch;
        $id_country=$request->searchCountry;
        $id_province=$request->searchProvince;
        $country=Country::where('status',1)->get();
        $province=null;
        $district=DB::table('country')
            ->join('province','country.id','=','province.country_id')
            ->join('district','province.id','=','district.province_id')
            ->where('country.status',1)
            ->where('province.status',1)
            ->where('district.status',1)
            ->where(function($query)use($name){
                $query ->where('district.name','like','%'.$name.'%')
                    ->orWhere('district.name_en','like','%'.$name.'%');
            });
        if($id_country!="0")
        {
            $district=$district->where('country.id',$id_country);
            $province=Province::where('country_id',$id_country)->where('status',1)->get();
        }
        if($id_province!="0")
        {
            $district=$district->where('province.id',$id_province);
        }
        $district=$district->orderBy('district.id','desc')
            ->select('district.*','province.name as province','province.id as id_province','country.name as country','country.id as id_country')
            ->paginate(10);
        return view('admin.filter.district',['search'=>$name,'id_country'=>$id_country,'id_province'=>$id_province,'country'=>$country,'province'=>$province,'district'=>$district->appends(Input::except('page'))]);
    }
    else{
        return redirect('admin/log-in');
    }


}
    public function SearchProvince(Request $request)
    {
        if(Auth::check()){
            $name=$request->txtsearch;
            $id_country=$request->searchCountry;
            $country=Country::where('status',1)->get();
            $district=DB::table('country')
                ->join('province','country.id','=','province.country_id')
                ->where('country.status',1)
                ->where('province.status',1)
                ->where(function($query)use($name){
                    $query ->where('province.name','like','%'.$name.'%')
                        ->orWhere('province.name_en','like','%'.$name.'%');
                });
            if($id_country!="0")
            {
                $district=$district->where('country.id',$id_country);
            }
            $district=$district->orderBy('province.id','desc')
                ->select('province.*','country.name as country')
                ->paginate(10);
            return view('admin.filter.province',['search'=>$name,'id_country'=>$id_country,'country'=>$country,'province'=>$district->appends(Input::except('page'))]);
        }
        else{
            return redirect('admin/log-in');
        }


    }
}
