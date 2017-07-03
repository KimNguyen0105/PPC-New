@extends('master')
@section('main')
    <div style="clear: both"></div>
    <div class="backgroundbody" style="position:relative;">
        <div class="container paddingchitiet" style="min-height: 400px">
            <div class="text-center space">
                <h3 style="color:#443427;"><b>{{trans('home.news_event')}}</b></h3>
                <hr style="border:2.5px solid #443427;width:90px;">
                <br>
                <div class="col-md-6 text-left">
                    <h5 style="font-size:12pt;font-family:verdana;">{{trans('home.home')}} /{{trans('home.news_event_trans')}}</h5>
                </div>
                <div class="col-md-6"></div>
            </div>



            <!-- hàng số 1 -->
            <div class="space">
                <div class="col-md-12 col-sm-12">
                    <img src="{{asset('images')}}/news/{{$news->image}}" class="img-responsive" style="width:100%;">
                </div>
            </div>
            <!-- hàng số 2 -->
            <div class="space">
                <div class="col-md-12 col-sm-12">
                    <h3 style="color:#443427;"><b>{{mb_strtoupper($news->title)}}</b></h3>
                    <hr style="border:2.5px solid #443427;width:90px;margin-left:0px;">
                </div>
            </div>
            <div class="space" >
                <div class="col-md-12 col-sm-12" id="imgTintuc">
                    <p style="color:#443427; font-family:arial;font-size:13pt;text-align:justify;">{!! $news->content !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection