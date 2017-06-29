@extends('master')
@section('main')

{{--BANNER TIN TUC--}}
<div class="text-center banner_header">

    <div class="text-center ">
        <div class="container">
            <div class="col-md-12">

                @foreach ($banner_tin as $row)

                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: -68px">
                    <div style=" background-color: #eaebe7;">
                        <h3 class="titlebaner" style="padding: 15px 0px"><b>{{mb_strtoupper($row->title)}}</b></h3>
                    </div>
                    <div  style="width:100%;">
                        <a href=""><img src="images/news/{{$row->image}}"  ></a>
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
        <div class="container paddingchitiet" >
            <!-- hàng số 1 -->
            <div class="text-center">
                <h3 class="titlewweb" style="color:#443427;"><b>{TINTUCSUKIEN}</b></h3>
                <hr style="border:2.5px solid #443427;width:90px;">
                <div class="col-md-12 text-left">
                    <h4 style="font-family: Verdana">{TrangChu} / <b>{TinTucSuKien} </b></h4>
                </div>
            </div>

            <div class="pace" style="padding: 0px 15px">



                @foreach ($news as $item)
                <div class="col-md-12 contentduan" style="margin-bottom: 10px;position: relative">
                    <div class="col-md-4" style="padding: 0px">
                        <a href="">
                            <img src="" class="img-responsive img_body"  style="width:100%;">
                        </a>
                    </div>
                    {!! str_limit($item->content,200) !!}
                    <div class="col-md-8" style="padding-top: 10px">
                        <a href=""><h4 style="text-align:left;font-size: 17px;font-family: verdana;"><b>{{mb_strtoupper($item->title)}}</b></h4></a>

                        <div class="" style="padding-top: 10px; font-family: Verdana">
                            {!! str_limit($item->content,200) !!}
                        </div>
                    </div>
                    <div class="" style="padding: 0px 30px; position: absolute; right: 0;bottom: 0; text-align: right">
                        <a href="" style="font-family: Verdana">{them} ...</a>
                    </div>

                </div>
                @endforeach
            </div>
            <div class="text-center">{!! $news->render() !!}</div>
        </div>

    </div>
@endsection