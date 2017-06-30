@extends('master')
@section('main')
    <div class="container">
        <div class="text-center space" >
            <h3 class="titlewweb" style="color:#443427;" id="h2"><b>{{trans('home.humandev_trans')}}</b></h3>
            <hr style="border:2.5px solid #443427;width:90px;">
            <div class="text-left">
                <h4 style="font-family: Verdana"><b>{{trans('home.career_opp')}} </b>/{{trans('home.recruitment')}} </h4>
            </div>
        </div>
        <!-- hàng số 2 -->
        <div class="space">

            <div class="col-md-4">
                <img src="{{URL::asset('')}}images/{{$data->image}}" class="img-responsive" style="width:100%;">
            </div>
            <div class="col-md-8">
                <div class="col-md-12">
                    <h3 style="color:#443427; font-family: Verdana"><b>{{mb_strtoupper($data->title)}}</b></h3>
                </div>
                <div class="col-md-12" style="padding-top: 10px">

                    <p style="color:#443427; font-family:Verdana;font-size:13pt;text-align:justify;"><b>{{trans('home.dead_line')}}: </b>{{$data->updated_at}}</p>
                    <p style="color:#443427; font-family:Verdana;font-size:13pt;text-align:justify;">{{$data->content}}</p>
                </div>
            </div>

        </div>
    </div>
    @endsection