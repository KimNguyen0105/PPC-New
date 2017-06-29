@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Thông tin cấu hình</h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Config</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
                <!-- &nbsp<h3 class="box-title">VIDEO TRANG CHỦ</h3> -->
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
                <div class="row" >
                    <form id="frSoluoc" method="POST" action="{{url('admin/config-save')}}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <div class="box-header with-border">
                        <a class="btn btn-danger" href="{{url('admin/system-config')}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                        <button type="submit" id="saveIntroduce" class="btn btn-success usersubmit" name="save"><i class="fa fa-save"></i> Lưu</button>

                    </div>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" id="tabSoluoc">
                            <li class="active"><a href="#tab_info" data-toggle="tab" aria-expanded="true">Thông tin Công ty</a></li>
                            <li class=""><a href="#tab_address_vi" data-toggle="tab" aria-expanded="true">Địa chỉ công ty tại VN</a></li>
                            <li class=""><a href="#tab_address" data-toggle="tab" aria-expanded="true">Địa chỉ Công ty tại USA</a></li>
                            <li class=""><a href="#tab_link" data-toggle="tab" aria-expanded="true">Link liên kết</a></li>
                            <li class=""><a href="#tab_seo" data-toggle="tab" aria-expanded="true">Seo</a></li>
                        </ul>
                        <div class="tab-content" id="contentSoluoc">
                            <div class="tab-pane active" id="tab_info">
                                <div class="form-group">
                                    <label for="introduce">
                                        Logo
                                    </label>
                                    <img id="imgF" src="{{asset('images/system_config')}}/{{$config->ppc_logo}}" class="img-responsive" style="height: 200px;">
                                    <input id="file" accept="image/*" name="file" type="file" style="padding-bottom: 20px" onchange="readURL(this);" class="file-loading">
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Số điện thoại
                                    </label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{$config->ppc_phonenumber}}" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_address_vi">
                                <div class="form-group">
                                    <label for="introduce">
                                        Địa chỉ ( Tiếng việt)
                                    </label>
                                    <textarea class="form-control editors" name="address_vi" required id="address_vi" rows="3">{{$config->company_info}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Địa chỉ ( Tiếng anh)
                                    </label>
                                    <textarea class="form-control editors" name="address_en" required id="address_en" rows="3">{{$config->company_info_en}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_address">
                                <div class="form-group">
                                    <label for="introduce">
                                        Địa chỉ ( Tiếng việt)
                                    </label>
                                    <textarea class="form-control editors" name="usa_vi" required id="usa_vi" rows="3">{{$config->ppc_usa_info}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Địa chỉ ( Tiếng anh)
                                    </label>
                                    <textarea class="form-control editors" name="usa_en" required id="usa_en" rows="3">{{$config->ppc_usa_info_en}}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_link">
                                <div class="form-group">
                                    <label for="introduce">
                                        Facebook
                                    </label>
                                    <input type="text" class="form-control" name="link_face" id="link_face" value="{{$config->fb_link}}" placeholder="Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Youtube
                                    </label>
                                    <input type="text" class="form-control" name="link_youtube" id="link_youtube" value="{{$config->youtube_link}}" placeholder="Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Twitter
                                    </label>
                                    <input type="text" class="form-control" name="link_twitter" id="link_twitter" value="{{$config->twiter_link}}" placeholder="Title" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Linked
                                    </label>
                                    <input type="text" class="form-control" name="link_link" id="link_link" value="{{$config->linked_link}}" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_seo">
                                <div class="form-group">
                                    <label for="introduce">
                                        Author
                                    </label>
                                    <textarea class="form-control editors" name="author" required id="author" rows="3">{{$config->ppc_author}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Description
                                    </label>
                                    <textarea class="form-control editors" name="description" required id="description" rows="3">{{$config->ppc_description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Keyword
                                    </label>
                                    <textarea class="form-control editors" name="keyword" required id="keyword" rows="3">{{$config->ppc_seokeyword}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">
                                        Google analytic
                                    </label>
                                    <textarea class="form-control editors" name="google_analytic" required id="google_analytic" rows="5">{{$config->google_analytic}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>

        <br>
    </div>
    <script>
        $(function() {
            $('.alert').delay(5000).show().fadeOut('slow');
        });
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgF').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        CKEDITOR.replace( 'address_vi', {
            filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
            filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        } );
        CKEDITOR.replace( 'address_en', {
            filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
            filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        } );
        CKEDITOR.replace( 'usa_vi', {
            filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
            filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        } );
        CKEDITOR.replace( 'usa_en', {
            filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
            filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
            filebrowserWindowWidth: '1000',
            filebrowserWindowHeight: '700'
        } );
        function ftGetModal() {

            $('#txtid').val('0');
            $('#file').val('');
            document.getElementById("txtshow").checked = false;
            document.getElementById("imgF").src='';
            $('#txtthutu').val('');
            $('#myModal').modal('show');
        }
        function ftGetValue(id, image, show, sort) {
            $('#txtid').val(id);
            if(show==1)
            {
                document.getElementById("txtshow").checked = true;
            }
            else{
                document.getElementById("txtshow").checked = false;
            }
            document.getElementById("imgF").src='{{asset('images/sliders')}}/'+image;
            $('#txtthutu').val(sort);
            $('#myModal').modal('show');
        }
    </script>
@endsection