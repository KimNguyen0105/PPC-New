@extends('master')
@section('main')
    @extends('master')
@section('main')

    {{--BANNER TIN TUC--}}
    <div class="text-center banner_header">

        <div class="text-center ">
            <div class="container">
                <div class="col-md-8 col-md-offset-2">

                    @foreach ($banner_tin as $row)

                        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: -68px">
                            <div style=" background-color: #eaebe7;">
                                @if(Session::get('locale') == 'vi')
                                    <h3 class="titlebaner" style="padding: 15px 0px">
                                        <b>{{mb_strtoupper($row->title)}}</b></h3>
                                @else
                                    <h3 class="titlebaner" style="padding: 15px 0px">
                                        <b>{{mb_strtoupper($row->title_en)}}</b></h3>
                                @endif
                            </div>
                            <div style="width:100%;">
                                <a href="{{URL::asset('')}}ppc-news-{{$row->id}}.html">
                                    <img src="{{URL::asset('')}}images/category/{{$row->image}}" style="width: 100%; margin: -10px 1px"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{--END BANNER TIN TUC--}}
    <div style="clear: both"></div>
    <div class="backgroundbody">
        <div class="container paddingchitiet">
            <!-- hàng số 1 -->
            <div class="text-center">
                @if(Session::get('locale') == 'vi')
                    <h3 class="titlewweb" style="color:#443427;"><b>{{$banner_detail->title}}</b></h3>
                @else
                    <h3 class="titlewweb" style="color:#443427;"><b>{{$banner_detail->title_en}}</b></h3>
                @endif
                <hr style="border:2.5px solid #443427;width:90px;">
                <div class="col-md-12 text-left">
                    <h4 style="font-family: Verdana">{{trans('home.home')}} / @if(Session::get('locale') == 'vi')
                            <b>{{$banner_detail->title}}</b>
                        @else
                            <b>{{$banner_detail->title_en}}</b>
                        @endif
                    </h4>
                </div>
            </div>

            <div class="pace" style="padding: 0px 15px">


                @foreach ($news as $item)
                    <div class="col-md-12 contentduan" style="margin-bottom: 10px;position: relative">
                        <div class="col-md-4" style="padding: 0px">
                            <a href="{{asset('')}}/ppc-news/{{$item->id}}-{{$item->slug}}.html">
                                <img src="{{URL::asset('')}}images/news/{{$item->image}}"
                                     class="img-responsive img_body" style="width:100%;">
                            </a>
                        </div>

                        <div class="col-md-8" style="padding-top: 10px">
                            <a href="{{asset('ppc-news')}}/{{$item->id}}-{{$item->slug}}.html"><h4
                                        style="text-align:left;font-size: 17px;font-family: verdana;">
                                    <b>{{mb_strtoupper($item->title)}}</b></h4></a>

                            <div class="" style="padding-top: 10px; font-family: Verdana">
                                {!! str_limit($item->content,200) !!}
                            </div>
                        </div>
                        <div class=""
                             style="padding: 0px 30px; position: absolute; right: 0;bottom: 0; text-align: right">
                            <a href="{{asset('ppc-news')}}/{{$item->id}}-{{$item->slug}}.html"
                               style="font-family: Verdana">{{trans('home.read_more')}}</a>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="text-center">{!! $news->render() !!}</div>
        </div>

    </div>
@endsection
@endsection