@extends('master')
@section('main')
    <!-- PHẦN BANNER CỦA HEADER -->

    <div class="text-center banner_header">
        <div class="text-center">
            <div class="container">
                <div class="col-md-12">


                        @foreach($databanner as $row)
                            <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: -70px">
                                <div style=" background-color: #eaebe7;width:100%; height: 50px">
                                    <h3 class="titlebaner" style="padding: 15px 0px" class="fontTitle">
                                        <b>{{mb_strtoupper($row->title)}}</b></h3>
                                </div>
                                <div style="width:100%;">
                                    <a href=""><img src="images/{{$row->image}}" class="img-responsive"
                                                    style="width:100%;height: 200px"></a>
                                </div>
                            </div>
          @endforeach

                </div>
            </div>

        </div>
    </div>
    <!-- PHẦN BANNER CỦA HEADER -->
    <div style="clear:both;"></div>
    <div class="backgroundbody">
        <div class="container paddingchitiet">
            <div class="text-center">
                <h3 class="titlewweb"><b>{{trans('home.dealing')}}</b></h3>
                <hr style="border:2.5px solid #443427;width:80px;">
            </div>
            <div class="space" style="padding: 0px 15px">
                @foreach($dataduan as $data)
                    <div class="col-md-12 contentduan" style="margin-bottom: 10px;position: relative">
                        <div class="col-md-4" style="padding: 0px">
                            <a href="">
                                <img src="images/{{$data->image}}" class="img-responsive img_body" style="width:100%;">
                            </a>
                        </div>

                        <div class="col-md-8" style="padding-top: 10px">
                            <a href=""><h4 style="text-align:left;font-size: 17px;font-family: verdana;">
                                    <b>{{$data->title}}</b></h4></a>
                            <h5 style="text-align:left; font-size: 16px;font-family: verdana;"> {{$data->address}}</h5>
                            <div style="padding-top: 10px; font-family: Verdana">
                                {!!str_limit($data->info,200)!!}
                            </div>
                        </div>
                        <div class=""
                             style="padding: 0px 30px; position: absolute; right: 0;bottom: 0; text-align: right">
                            <h5 style="font-size: 17px;margin-top: 8px; float: right; font-family: Verdana">{{$data->acreage}}
                                </h5><span style="float:right;"><img src="" class="img-responsive"
                                                                       style="width:100%;"></span>
                        </div>

                    </div>

                @endforeach
                <div class="text-center"> {!! $dataduan->render() !!} </div>
            </div>

        </div>
    </div>
    <div class="backgroundphimtulieu">
        <!-- <img src="img/bg_img.jpg" id="img_ban"> -->
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-8 text-left" id="cot_so">
                    <h3 style="color:#3f3024;margin-left:-10px"><b>{{trans('home.documentfilm')}}</b></h3>
                    <hr style="border:2.5px solid #3f3024;margin-left:-10px;width:20%;">
                    <div class="row text-center space divvideo">
                        <div class="col-md-12 col-sm-12 text-center" style="padding:0px 5px;">
                            @foreach($videos as $video)

                                <iframe id="main_video" width="100%" style="border:0px" src="{{$video->url}}"></iframe>
                            @endforeach

                        </div>
                        <div id="pagingbody">
                            <div id="rowbody" style="padding-left: 0px"></div>
                            <div class="clr"></div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="goPrevious glyphicon glyphicon-triangle-left"></div>
                            <div class="goNext glyphicon glyphicon-triangle-right"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-left" id="cot_so">
                    <h3 style="color:#3f3024;"><b>{{trans('home.latestnews')}}</b></h3>
                    <hr style="border:2.5px solid #3f3024;margin-left:0px;width:40%;">
                    <div class="space" id="divtintuc" style="background-color:white;opacity:0.9;padding: 5px 0px">

                        @if($news !=null)
                            @foreach ($news as $row)
                                <div class="col-md-12 tintucmoi">


                                    <a href="{{asset('/news')}}" class="texttintuc"
                                       style="color: #3f3024;font-size: 16px"
                                       title="{{$row->title}}">{{$row->title}}</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>

@endsection