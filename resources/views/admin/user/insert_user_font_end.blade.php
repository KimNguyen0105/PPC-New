@extends('admin.layouts.master')


@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>Thêm User</h4>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thêm user</li>
            </ol>
        </section>
        <section class="content-header">

            <div class="box box-primary" id="text">
                @if(session('thongbao'))
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <i style="color: green" class="fa fa-check"></i>  {{session('thongbao')}}
                    </div>
                @endif
                @if(session('thatbai'))
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <i style="color: green" class="fa fa-close"></i>  {{session('thatbai')}}
                    </div>
                @endif
                <!-- /.box-header -->
                <form id="frSoluoc" method="POST" action="{{url('admin/user-font-end-save')}}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <div class="box-header with-border">
                        <button type="submit" id="saveIntroduce" class="btn btn-success usersubmit" name="save"><i class="fa fa-save"></i> Lưu</button>
                        <a class="btn btn-danger" href="{{url('admin/user-font-end')}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                    </div>
                    <div class="box-body">
                        <div class="row col-md-12" style="padding-bottom: 10px">
                            <input hidden type="text" name="txtid" value="<?=$user ? $user->id: 0?>">
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs" id="tabSoluoc">
                                        <li class="active"><a href="#tab_info" data-toggle="tab" aria-expanded="true">Thông tin</a></li>
                                        <li class=""><a href="#tab_pass" data-toggle="tab" aria-expanded="true">Mật khẩu</a></li>
                                    </ul>
                                    <div class="tab-content" id="contentSoluoc">
                                        @if($user==null)
                                            <div class="tab-pane active" id="tab_info">
                                                <div class="col-md-12 row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="introduce">Tên đăng nhập</label>
                                                            <input type="text" class="form-control" name="username" id="username" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="introduce">Email</label>
                                                            <input type="text" class="form-control" name="email" id="email" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="introduce">Số điện thoại</label>
                                                            <input type="text" class="form-control" name="phone" id="phone">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="introduce">Địa chỉ</label>
                                                            <input type="text" class="form-control" name="address" id="address">
                                                        </div>
                                                    </div>
                                                    <div class="clo-md-6">
                                                        <div class="form-group">
                                                            <input id="file" accept="image/*" name="file" type="file" style="padding-bottom: 20px" onchange="readURL(this);" class="file-loading" required>
                                                            <img id="imgF" class="img-responsive" style="height: 200px;"/>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab_pass">
                                                <div class="form-group">
                                                    <label for="introduce">Mật khẩu</label>
                                                    <input type="password" class="form-control" name="pass" id="pass" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">Nhập lại mật khẩu</label>
                                                    <input type="password" class="form-control" name="re_pass" id="re_pass" required>
                                                </div>
                                            </div>
                                        @else

                                            <div class="tab-pane active" id="tab_info">
                                                <div class="col-md-12 row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="introduce">Tên đăng nhập</label>
                                                            <input type="text" class="form-control" name="username" value="{{$user->username}}" id="username" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="introduce">Email</label>
                                                            <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="introduce">Số điện thoại</label>
                                                            <input type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="introduce">Địa chỉ</label>
                                                            <input type="text" class="form-control" name="address" id="address" value="{{$user->address}}">
                                                        </div>
                                                    </div>
                                                    <div class="clo-md-6">
                                                        <div class="form-group">
                                                            <input id="file" accept="image/*" name="file" type="file" style="padding-bottom: 20px" onchange="readURL(this);" class="file-loading">
                                                            <img id="imgF" src="{{asset('images/user')}}/{{$user->avatar}}" class="img-responsive" style="height: 200px;"/>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_pass">
                                                <div class="form-group">
                                                    <label for="introduce">Mật khẩu cũ</label>
                                                    <input type="password" class="form-control" name="pass_old_" id="pass_old_">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">Mật khẩu mới</label>
                                                    <input type="password" class="form-control" name="pass_" id="pass_">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">Nhập lại mật khẩu</label>
                                                    <input type="password" class="form-control" name="re_pass_" id="re_pass">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                        </div>
                    </div>
                </form>
            </div>


        </section>
        <!-- Main content -->
        <br>
    </div>

<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgF').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    jQuery(document).ready(function() {
        jQuery('#frSoluoc').validate({
            ignore: ".ignore",
            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",
            rules: {
                "pass": {
                    minlength: 6
                },
                "re_pass": {
                    minlength: 6,
                    equalTo: "#pass"
                },
                "pass_": {
                    minlength: 6
                },
                "re_pass_": {
                    minlength: 6,
                    equalTo: "#pass_"
                }
            },
            messages: {
                username: {
                    required: 'Tên đăng nhập không được trống.'
                },
                email: {
                    required: 'Email không được trống.'
                },
                pass:{
                    required: 'Mật khẩu không được trống.'
                },
                re_pass:{
                    required: 'Vui lòng nhập lại mật khẩu.'
                }
            },
            invalidHandler: function(e, validator){
                if(validator.errorList.length)
                    $('#tabSoluoc a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show')
            }
        });

        jQuery('#saveIntroduce').click(function(evt) {
            evt.preventDefault();

            jQuery('#frSoluoc').submit()

        });
    });

</script>
@endsection