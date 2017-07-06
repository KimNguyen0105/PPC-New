@extends('master')
@section('main')
    <div style="clear: both"></div>

    <div class="container paddingchitiet">

        <div class="text-center space">
            <h3 class="titlewweb" style="color:#443427;"><b>{{trans('home.contact_trans')}}</b></h3>
            <hr style="border:2.5px solid #443427;width:130px;">

        </div>
    <div class="space text-left" style="font-family: Verdana">
        <div class="col-md-4 col-sm-12">


        </div>
        <div class="col-md-8 col-sm-12 text-left">
            <h4>{{trans('home.contact_title')}} </h4>
            <hr style="border:0.5px solid #443427;margin-top:0px;">
            {!! Form::open(array('route'=>'post-contact')) !!}
                <div class="row text-left" style="padding: 5px 0px;">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <h5>{{trans('home.name')}}*</h5>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="text" id="txtname" name="name" class="form-control" required>
                    </div>

                </div>
                <div class="row text-left" style="padding: 5px 0px;">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <h5>Email*</h5>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input type="email" id="txtemail" name="email" class="form-control" required>
                    </div>
                </div>
            <div class="row text-left" style="padding: 5px 0px;">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <h5>{{trans('home.title')}}*</h5>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input  id="txttitle" name="title" class="form-control" type="text" required>
                </div>
            </div>
            <div class="row text-left" style="padding: 5px 0px;">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <h5>{{trans('home.content')}}*</h5>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <!-- <input type="text" name="1" style="width:100%;"  placeholder="NHẬP NỘI DUNG"> -->
                    <textarea  id="txtcontent" name="content" class="form-control" rows="5" required></textarea>
                </div>
            </div>


                <div class="row text-left" style="padding: 5px 0px;">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <h5 style="margin-top: 0px">{{trans('home.send_copy')}}</h5>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input  id="checkcopy" type="checkbox" name="is_copy">
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col-md-12 col-sm-12 col-xs-12">


                        <button type="submit" style="background-color:#443427;color:white;border:2px #443427;" class="btn">{{trans('home.send_mail')}}</button>
                    </div>
                </div>
            {!! Form::close() !!}
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
                }
            });
        });

    </script>
@endsection