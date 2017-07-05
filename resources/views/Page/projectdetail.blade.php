@extends('master')
@section('main')
    <div style="position:relative;" class="backgroundbody">
        <div class="container paddingchitiet" style="min-height: 400px">
            <div class="text-center space">
                <h3 style="color:#443427;"><b>{{trans('home.project')}}</b></h3>
                <hr style="border:2.5px solid #443427;width:90px;">
                <br>
                <div class="col-md-12 text-left">
                    <h5 style="font-size:12pt;font-family:verdana;">{{trans('home.home')}} / {{trans('home.project')}}/ <b>{{$detail->title}} </b></h5>
                </div>
            </div>
            @if($detail !=null)
                <div class="space">
                    <div class="col-md-12 col-sm-12">
                        <a href=""><img src="{{URL::asset('images/property')}}/{{$detail->image}}" class="img-responsive" style="width: 100%"></a>
                    </div>
                </div>

                <div class="text-left">

                    <div class="col-md-12 col-sm-12">
                        <h3 style="color:#443427;"><b>{{mb_strtoupper($detail->title)}}</b></h3>
                        <hr style="border:2.5px solid #443427;width:90px;margin-left:0px; margin-top: 0px">
                        <p id="font_noidung2">{!! ($detail->info)!!}</p>
                    </div>
                </div>
                <div class="col-md-12 text-center paddinglr0">

                    @if($dataimage != null)
                        @foreach ($dataimage as $row)
                        <div class="col-md-4 col-sm-12" style="padding-bottom: 30px">
                            <a href=""><img src="{{URL::asset('')}}images/property_image/{{$row->image}}" style="width: 100%"
                                            class="img-responsive img_body"></a>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="text-left">
                    <h3 style="color:#443427;margin-left:15px;"><b>{matbangtongthe}</b></h3>
                    <hr style="border:2.5px solid #443427;width:90px;margin-left:15px; margin-top: 0px">
                    <div class="col-md-12 col-sm-12">
                        <img src="{{URL::asset('')}}images/property/{{$detail->image_overall}}" class="img-responsive"
                             style="width: 100%">
                    </div>
                </div>
                <div style="clear: both"></div>
                <div class="space text-left">
                    <h3 style="color:#443427; margin-left: 15px"><b>{thongtinduan}</b></h3>
                    <hr style="border:2.5px solid #443427;width:90px;margin-left:15px; margin-top: 0px">
                    <div class="col-md-12 col-sm-12">
                        <table style="border:1px solid black;width:100%;" id="tbthongtinduan">
                            <tr style="text-align:left;border-bottom:1px solid;">
                                <td style="border-right:1px solid;" class="col-md-3 col-xs-4">&nbsp<h5>{DUAN}</h5></td>
                                <td class="col-md-9 col-xs-8">&nbsp<p>
                                        {{$detail->title}}</p></td>
                            </tr>
                            <tr style=";border-bottom:1px solid;">
                                <td style="border-right:1px solid;">&nbsp<h5>{chudautu}</h5></td>
                                <td><p>{{$detail->investor}}</p></td>
                            </tr>
                            <tr style="border-bottom:1px solid;">
                                <td style="border-right:1px solid;">&nbsp<h5>{vitri}</h5></td>
                                <td>&nbsp<p>{{$detail->address}}</p></td>
                            </tr>
                            <tr style="border-bottom:1px solid;">
                                <td style="border-right:1px solid;">&nbsp<h5>{hinhthucsohuu}</h5></td>
                                <td>&nbsp<p>{{$detail->ownership}}</p></td>
                            </tr>
                            <tr style="border-bottom:1px solid;">
                                <td style="border-right:1px solid;">&nbsp<h5>{dientichduan}</h5></td>
                                <td>&nbsp<p>{{$detail->acreage}}</p></td>
                            </tr>
                            <tr style="border-bottom:1px solid;">
                                <td style="border-right:1px solid;">&nbsp<h5>{dientichcanho}</h5></td>
                                <td>
                                    &nbsp<p>{sotang}: {{$detail->floor}}</p>
                                    &nbsp<p>{sophongngu}:{{$detail->bedroom}}</p>
                                    &nbsp<p>{sophongtam}: {{$detail->bathroom}}</p>
                                </td>
                            </tr>
                            <tr style="border-bottom:1px solid;">
                                <td style="border-right:1px solid;">&nbsp<h5>{tongsocanho}</h5></td>
                                <td>&nbsp<p>{{$detail->apartment}} {can}</p></td>
                            </tr>
                            <tr style="border-bottom:1px solid;">
                                <td style="border-right:1px solid;">&nbsp<h5>{cacdichvutienich}</h5></td>
                                <td>
                                    &nbsp<p>{!!$detail->service !!}</p>

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


        </div>
        @else
           <h1>Chi tiết null</h1>
        @endif


        <br>
    </div>
@endsection