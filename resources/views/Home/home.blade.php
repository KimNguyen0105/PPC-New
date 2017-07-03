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
                            <a href="{{URL::asset('project')}}/{{$data->id}}-{{$data->slug}}.html">
                                <img src="images/{{$data->image}}" class="img-responsive img_body" alt="{{$data->title}}" style="width:100%;">
                            </a>
                        </div>

                        <div class="col-md-8" style="padding-top: 10px">
                            <a href="{{URL::asset('project')}}/{{$data->id}}-{{$data->slug}}.html"><h4 style="text-align:left;font-size: 17px;font-family: verdana;">
                                    <b>{{$data->title}}</b></h4></a>
                            <h5 style="text-align:left; font-size: 16px;font-family: verdana;"> {{$data->address}}</h5>
                            <div style="padding-top: 10px; font-family: Verdana">
                                {!!str_limit($data->info,250)!!}
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
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h3 class="titlewweb"><b>{{trans('home.latestnews')}}</b></h3>
                        <hr style="border:2.5px solid #443427;width:80px;">
                    </div>
                    <section class="regular slider">
                        @if($news!=null)

                            @foreach ($news as $item)
                                <div class="col-md-4">
                                    <a style="border-bottom: 1px solid"
                                       href="{{url('news')}}/{{$item->id}}-{{$item->slug}}.html"
                                       title="{{$item->title}}">
                                        <img src="{{asset('images/news')}}/{{$item->image}}" alt="{{$item->title}}"></a>
                                    <div class="content-tintuc" style="background-color: #ffffff;padding: 10px;">
                                        <h3 style="font-size:20px;"><a style="border-bottom: 1px solid"
                                                                       href="{{url('news')}}/{{$item->id}}-{{$item->slug}}.html"
                                                                       title="{{$item->title}}">{{str_limit($item->title,20)}}</a>
                                        </h3>
                                        <?php
                                        $newDateTime = date('h:i A', strtotime($item->updated_at));
                                        $date = date_create($item->updated_at);
                                        $date = date_format($date, "d/m/Y")
                                        ?>
                                        <i style="font-size:10px;">{{$date}} {{$newDateTime}}</i><br>
                                        <span>{!! str_limit(strip_tags($item->content),290) !!}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </section>
                </div>


            </div>

        </div>
        <br>
    </div>
    <div class="container">


        <div class="row">
            <div class="text-center">
                <h3 class="titlewweb"><b>{{trans('home.documentfilm')}}</b></h3>
                <hr style="border:2.5px solid #443427;width:80px;">
            </div>
            @foreach($videos as $video)
                @if($loop->iteration ==1)
                    <div class="col-md-8 text-left" id="cot_so">


                        <iframe id="main_video" width="100%" style="border:0px;" src="{{$video->url}}"></iframe>


                    </div>
                @else
                    <div class="col-md-2 text-left" id="cot_so">
                        <a href="" class="changevideo" data-link="{{$video->url}}">
                            <img src="https://img.youtube.com/vi/{{$video->thumb}}/0.jpg" class="img-responsive"
                                 style="padding-bottom: 25px;"/>
                        </a>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
    <script>
        $('.changevideo').click(function (e) {
            var link = $(this).attr('data-link')+'?autoplay=1';
            e.preventDefault();

            $('#main_video').attr('src',link);
        });
    </script>
@endsection