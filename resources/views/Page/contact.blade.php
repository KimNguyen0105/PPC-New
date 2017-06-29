@extends('master')
@section('main')
    <div style="clear: both"></div>

    <div class="container paddingchitiet">

        <div class="text-center space">
            <h3 class="titlewweb" style="color:#443427;"><b>{{trans('home.contact_trans')}}</b></h3>
            <hr style="border:2.5px solid #443427;width:130px;">
            <div class="col-md-12 text-left">
                <h4 style="font-family: Verdana">{{trans('home.home')}} / <b>{{trans('home.contact')}} </b></h4>
            </div>
        </div>
    <div class="space text-left" style="font-family: Verdana">
        <div class="col-md-4 col-sm-12">
            <img src="images/logo.png" id="logo_lh">
            <div class="space">
                <h5><img src="images/icon/32.png" style="width: 5%"> <b>{{trans('home.see_project')}}</b></h5>
            </div>
            <hr style="border:0.5px solid #443427;">
            <div class="">
                <h5>{{trans('home.address')}}:</h5>
                <h5>49 Đinh Công Tráng, P Tân Định, Quận 1,TP.HCM</h5>
                <h5>{{trans('home.phone')}}: +84 8 38201107</h5>
                <h5>Mobile: 0988 084 009</h5>
                <h5><img src="images/icon/31.png" style="width: 5%"> Hotline: <b>+84 8 38201107</b></h5>
                <h5><img src="images/icon/33.png"  style="width: 5%"> {{trans('home.work_time')}}: <b>8h30 - 18h</b></h5>
                <h5>({{trans('home.work_hour')}})</h5>
            </div>
        </div>
        <div class="col-md-8 col-sm-12 text-left">
            <h4>{{trans('home.contact_title')}} </h4>
            <hr style="border:0.5px solid #443427;margin-top:0px;">
            <form id="fromContact" method="POST" action="">
                <div class="row text-left" style="padding: 5px 0px;">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <h5>{{trans('home.name')}}*</h5>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="text" id="txtname" name="txtname" class="form-control" required>
                    </div>

                </div>
                <div class="row text-left" style="padding: 5px 0px;">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <h5>Email*</h5>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="email" id="txtemail" name="txtemail" class="form-control" required>
                    </div>
                </div>
                <div class="row text-left" style="padding: 5px 0px;">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <h5>{{trans('home.title')}}*</h5>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input  id="txttitle" name="txttitle" class="form-control" type="text" required>
                    </div>
                </div>
                <div class="row text-left" style="padding: 5px 0px;">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <h5>{{trans('home.content')}}*</h5>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <!-- <input type="text" name="1" style="width:100%;"  placeholder="NHẬP NỘI DUNG"> -->
                        <textarea  id="txtcontent" name="txtcontent" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="row text-left" style="padding: 5px 0px;">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <h5 style="margin-top: 0px">{{trans('home.send_copy')}}</h5>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input  id="checkcopy" type="checkbox" name="checkcopy">
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col-md-12 col-sm-12 col-xs-12">


                        <button type="submit" style="background-color:#443427;color:white;border:2px #443427;" class="btn">{{trans('home.send_mail')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>

    <script>
        $(document).ready(function() {
            $("#fromContact").validate({
                errorClass: "state-error",
                validClass: "state-success",
                errorElement: "em",
                messages: {
                    txtname: {
                        required: 'Tên không được trống.'
                    },
                    txtemail: {
                        required: 'Email không được trống.',
                        email: 'Địa chỉ email không hợp lệ.'
                    },
                    txttitle: {
                        required: 'Tiêu đề không được trống.'
                    },
                    txtcontent: {
                        required: 'Nội dung không được trống.'
                    }
                }
            });
        });

    </script>
@endsection