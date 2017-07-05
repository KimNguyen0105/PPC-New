@extends('master')
@section('main')
<div class="container" style="font-family: Verdana">
    <div class="text-center">
        <h3 class="titlewweb" style="color:#443427;"><b>{{$data->title}}</b></h3>
        <hr style="border:2.5px solid #443427;width:80px;">
        <div class="col-md-12 text-left">
            <h4>{{trans('home.home')}} / {{trans('home.about')}} / <b>{{$data->title}}</b></h4>
        </div>
    </div>
    <div class="space">
        <div class="col-md-4 col-xs-4">
            <img src="{{URL::asset('')}}images/introduce/{{$data->image}}" class="img-responsive" style="width:100%;">
        </div>
        <div class="col-md-8  col-xs-8">
            <h4 style="color:#443427; font-family: verdana;"><b>{{$data->title}}</b></h4>
            <p class="txtlanhdao" >{!! $data->content !!}</p>
        </div>
    </div>
</div>
    @endsection