@extends('master')
@section('main')
    <!-- PHẦN BANNER CỦA HEADER -->

    <div class="text-center banner_header">
        <div class="text-center">
            <div class="container">
                <div class="col-md-12">


                    @foreach($data as $row)
                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: -70px">
                            <div style=" background-color: #eaebe7;width:100%; height: 50px">
                                <h3 class="titlebaner" style="padding: 15px 0px" class="fontTitle">
                                    <b>{!! mb_strtoupper($row->title) !!}</b></h3>
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
    <div style="clear: both"></div>
    <div class="container" style="font-family: Verdana">
        <div class="text-center">
            <h3 class="titlewweb" style="color:#443427;"><b>{GIOITHIEU}</b></h3>
            <hr style="border:2.5px solid #443427;width:80px;">
            <div class="col-md-12 text-left">
                <h4>{TrangChu} / {GioiThieu} / <b>{VeChungToi}</b></h4>
            </div>
        </div>

        @if($data !=null)

        @foreach ($data as $row)

        <div class="space">
            <div class="col-md-4 col-xs-4">
                <img src="images/{{$row->image}}" class="img-responsive" style="width:100%;">
            </div>
            <div class="col-md-8  col-xs-8">
                <h4 style="color:#443427; font-family: verdana;"><b>{!! $row->title!!}</b></h4>
                <p class="txtlanhdao" >{!! $row->content!!}</p>
            </div>
        </div>
       @endforeach
            @endif



    </div>

@endsection