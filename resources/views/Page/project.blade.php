@extends('master')
@section('main')

    <!-- slider -->
    <div style="clear: both"></div>
    <div class="backgroundbody">
        <!-- PHẦN BANNER CỦA HEADER -->
        <div class="container paddingchitiet">
            <div class="text-center space">
                <h3 class="titlewweb" style="color:#443427;" id="h2"><b>{DUAN}</b></h3>
                <hr style="border:2.5px solid #443427;width:90px;">
                <div class="col-md-12 text-left">
                    <h4 style="font-family: Verdana">{TrangChu} / <b>{DuAn}</b>

                    </h4>
                </div>
            </div>


            <!-- hàng số 1 -->
            <div class="space" id="content_duan" style="padding: 0px 15px">

                @if($sale !=null)
                    @foreach ($sale as $row)
                        <div class="col-md-12 contentduan" style="margin-bottom: 10px;position: relative">
                            <div class="col-md-4" style="padding: 0px">
                                <a href="{{URL::asset('')}}ppc-project/{{$row->id}}-{{$row->slug}}.html">
                                    <img src="{{URL::asset('')}}images/property/{{$row->image}}" alt="{{$row->title}}" class="img-responsive img_body" style="width:100%;">
                                </a>
                            </div>
                            <!--                            -->
                            <div class="col-md-8" style="padding-top: 10px">
                                <a href="{{URL::asset('')}}ppc-project/{{$row->id}}-{{$row->slug}}.html"><h4 style="text-align:left;font-size: 17px;font-family: verdana;">
                                        <b>{{$row->title}}</b></h4></a>
                                <i style="text-align:left; font-size: 12px;font-family: verdana;"> {{$row->address}}</i>
                                <div class="" style="padding-top: 10px; font-family: Verdana">
                                    {{str_limit(strip_tags($row->info),290)}}
                                </div>
                            </div>
                            <div class=""
                                 style="padding: 0px 30px; position: absolute; right: 0;bottom: 0; text-align: right">
                                <h5 style="font-size: 17px;margin-top: 8px; float: right; font-family: Verdana">{{$row->acreage}}
                                    m2</h5><span style="float:right;"><img src="{{URL::asset('images/home_icon.jpg')}}" class="img-responsive"
                                                                           style="width:100%;"></span>
                            </div>

                        </div>
                        {!! $sale->render() !!}
                    @endforeach
                @else
                    <h1 class="text-center">Danh sách dự án rỗng!!!</h1>
                @endif
            </div>


        </div>

    </div>




    <!-- Modal -->




@endsection