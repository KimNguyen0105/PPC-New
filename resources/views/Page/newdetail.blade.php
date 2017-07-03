@extends('master')
@section('main')
    <div style="clear: both"></div>
    <div class="backgroundbody">
        <div class="container paddingchitiet">
            <div class="text-center">
                <h1 class="titlewweb" style="color:#443427;"><b>{{$news->title}}</b></h1>
                <hr style="border:2.5px solid #443427;width:80px;">

            </div>

            <div class="space">




                <div class="col-md-4 col-sm-12 text-center divgioithieu">
                    <a href=""><img src="images/{{$news->image}}" class="img-responsive img_body" style=" width: 100%"></a>
                    <a href=""><h4 class="titlewweb" style="color:#443427;"><b>{!! $news->content !!}</b></h4></a>
                </div>

            </div>
        </div>
    </div>

@endsection