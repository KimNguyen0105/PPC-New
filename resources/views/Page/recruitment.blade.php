@extends('master')
@section('main')
    <div class="backgroundbody">
        <div class="container paddingchitiet">
            <div class="text-center space" >
                <h2 class="titlewweb" style="color:#443427;" id="h2"><b>{{trans('home.humandev_trans')}}</b></h2>
                <hr style="border:2.5px solid #443427;width:90px;">
                <div class="col-md-6 col-sm-6 text-left">
                    <h3 style="font-family: Verdana">{{trans('home.home')}} / <b>{{trans('home.recruitment')}} </b></h3>
                </div>
            </div>
            <!-- hàng số 2 -->
            <div class="space" style="padding: 0px 15px">

                @foreach ($data as $row)

                <div class="col-md-12 contentduan" style="margin-bottom: 10px;position: relative">
                    <div class="col-md-4" style="padding: 0px">
                        <a href="{{URL::asset('')}}ppc-recruitment/{{$row->id}}-{{$row->slug}}.html">
                            <img src="{{URL::asset('')}}images/recruitment/{{$row->image}}" class="img-responsive img_body" title="{{$row->slug}}"  style="width:100%;">
                        </a>
                    </div>

                    <div class="col-md-8" style="padding-top: 10px">
                        <a href="{{URL::asset('')}}ppc-recruitment/{{$row->id}}-{{$row->slug}}.html"><h4 style="text-align:left;font-size: 17px;font-family: verdana;"><b>{{mb_strtoupper($row->title)}}</b></h4></a>
                        <h1 style="text-align:left; font-size: 16px;font-family: verdana;">{{trans('home.dead_line')}}:  {{$row->updated_at}}</h1>
                        <div class="" style="padding-top: 10px; font-family: Verdana">
                            {!! str_limit($row->content,300) !!}
                        </div>
                    </div>
                    <div class="" style="padding: 0px 30px; position: absolute; right: 0;bottom: 0; text-align: right">
                        <a href="{{URL::asset('')}}ppc-recruitment/{{$row->id}}-{{$row->slug}}.html" style="font-family: Verdana">{{trans('home.read_more')}}</a>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection