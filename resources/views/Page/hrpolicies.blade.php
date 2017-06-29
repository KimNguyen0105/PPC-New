@extends('master')
@section('main')
    <div style="clear: both"></div>
    <div class="backgroundbody">
        <div class="container paddingchitiet">
            <div class="text-center">
                <h3 class="titlewweb" style="color:#443427;"><b>{GIOITHIEU}</b></h3>
                <hr style="border:2.5px solid #443427;width:80px;">

            </div>

            <div class="space">
                <?php

                foreach ($data as $row)
                { ?>
                <div class="col-md-4 col-sm-12 text-center divgioithieu">
                    <a href=""><img src="images/{{$row->image}}" class="img-responsive img_body" style=" width: 100%"></a>
                    <a href=""><h4 class="titlewweb" style="color:#443427;"><b>{!! $row->title !!}</b></h4></a>
                </div>
                <?php }
                ?>
            </div>
        </div>
    </div>

@endsection