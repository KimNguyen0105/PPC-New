@extends('admin.layouts.master')


@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>Thêm giới thiệu</h4>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thêm giới thiệu</li>
            </ol>
        </section>
        <section class="content-header">

            <div class="box box-primary" id="text">
                <!-- /.box-header -->
                <form id="frSoluoc" method="POST" action="{{url('admin/introduce-save')}}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <div class="box-header with-border">
                        <button type="submit" id="saveIntroduce" class="btn btn-success usersubmit" name="save"><i class="fa fa-save"></i> Lưu</button>
                        <a class="btn btn-danger" href="{{url('admin/introduce-home')}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                    </div>
                    <div class="box-body">
                        <div class="row col-md-12" style="padding-bottom: 10px">
                            <input hidden type="text" name="txtid" value="<?=$introduce ? $introduce->id: 0?>">
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs" id="tabSoluoc">
                                        <li class="active"><a href="#tab_vi" data-toggle="tab" aria-expanded="true">Tiếng Việt</a></li>
                                        <li class=""><a href="#tab_en" data-toggle="tab" aria-expanded="true">English</a></li>
                                    </ul>
                                    <div class="tab-content" id="contentSoluoc">
                                        @if($introduce==null)
                                            <div class="tab-pane active" id="tab_vi">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="title_vi" id="title_vi" value="" placeholder="Tiêu đề" required maxlength="255">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Giới thiệu
                                                    </label>
                                                    <textarea class="form-control editors" name="introduce_vi" required id="introduce_vi" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="tab_en">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="title_en" id="title_en" value="" placeholder="Title" required maxlength="255">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Introduce
                                                    </label>
                                                    <textarea class="form-control editors" name="introduce_en" required id="introduce_en" rows="3"></textarea>
                                                </div>
                                            </div>
                                        @else
                                            @if($introduce_lang!=null)
                                                @foreach($introduce_lang as $item)
                                                    @if($item->lang=='vi')
                                                        <div class="tab-pane active" id="tab_vi">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="title_vi" id="title_vi" value="{{$item->title}}" placeholder="Tiêu đề" required maxlength="255">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="introduce">
                                                                    Giới thiệu
                                                                </label>
                                                                <textarea class="form-control editors" name="introduce_vi" required id="introduce_vi" rows="3">{{$item->content}}</textarea>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="tab-pane" id="tab_en">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="title_en" id="title_en" value="{{$item->title}}" placeholder="Title" required maxlength="255">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="introduce">
                                                                    Introduce
                                                                </label>
                                                                <textarea class="form-control editors" name="introduce_en" required id="introduce_en" rows="3">{{$item->content}}</textarea>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Hình ảnh(300 x 200)</label>
                                    <?php
                                    if($introduce!=null)
                                    {

                                        echo'<input id="file" accept="image/*" name="file" type="file" style="padding-bottom: 20px" onchange="readURL(this);" class="file-loading">';

                                    }
                                    else
                                    {
                                        echo '<input id="file" accept="image/*" name="file" type="file" style="padding-bottom: 20px" onchange="readURL(this);" class="file-loading" required>';
                                    }
                                    ?>
                                    <img id="imgF" src="{{asset('images/introduce')}}/<?=$introduce ? $introduce->image: ''?>" class="img-responsive" style="height: 200px;">
                                </div>
                            </div>
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
    CKEDITOR.replace( 'introduce_vi', {
        filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
        filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700'
    } );
    CKEDITOR.replace( 'introduce_en', {
        filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
        filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700'
    } );
    jQuery(document).ready(function() {
        jQuery('#frSoluoc').validate({
            ignore: ".ignore",
            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",
            messages: {
                title_vi: {
                    required: 'Tiêu đề không được trống.'
                },
                title_en: {
                    required: 'Title không được trống.'
                },
                file:{
                    required: 'File không được trống.'
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