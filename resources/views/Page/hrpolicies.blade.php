@extends('master')
@section('main')
    <div style="clear: both"></div>
    <div class="backgroundbody">
        <div class="container paddingchitiet">
            <div class="text-center">
                <h3 class="titlewweb" style="color:#443427;"><b>{{trans('home.hr_policies')}}</b></h3>
                <hr style="border:2.5px solid #443427;width:80px;">

            </div>

            <div class="space">


                @foreach ($data as $row)

                <div class="col-md-4 col-sm-12 text-center divgioithieu">
                    <a href="{{URL::asset('')}}hr-policies-detail/{{$row->id}}-{{$row->slug}}.html">
                        <img src="{{URL::asset('')}}images/{{$row->image}}" class="img-responsive img_body" style=" width: 100%"></a>
                    <a href="">
                        <h4 class="titlewweb" style="color:#443427;"><b>{!! $row->title !!}</b></h4></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection