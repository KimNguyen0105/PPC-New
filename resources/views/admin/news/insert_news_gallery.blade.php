@extends('admin.layouts.master')


@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>Thêm Tin Tức</h4>

            <ol class="breadcrumb">
                <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thêm tin tức</li>
            </ol>
        </section>
        <section class="content-header">

            <div class="box box-primary" id="text">
                <!-- /.box-header -->
                <form id="frNews" method="POST" action="{{url('admin/news-gallery-save')}}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <div class="box-header with-border">
                        <button type="submit" id="saveNews" class="btn btn-success usersubmit" name="save"><i class="fa fa-save"></i> Lưu</button>
                        <a class="btn btn-danger" href="{{url('admin/news-gallery-home')}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                    </div>
                    <div class="box-body">
                        <div class="row col-md-12" style="padding-bottom: 10px">
                            <input hidden type="text" name="txtid" value="<?=$news ? $news->id: 0?>">
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs" id="tabSoluoc">
                                        <li class="active"><a href="#tab_vi" data-toggle="tab" aria-expanded="true">Tiếng Việt</a></li>
                                        <li class=""><a href="#tab_en" data-toggle="tab" aria-expanded="true">English</a></li>
                                        <li class=""><a href="#tab_seo" data-toggle="tab" aria-expanded="true">Seo</a></li>
                                        <li class=""><a href="#tab_news" data-toggle="tab" aria-expanded="true">Các tin tức liên quan</a></li>
                                    </ul>
                                    <div class="tab-content" id="contentSoluoc">
                                        @if($news==null)
                                            <div class="tab-pane active" id="tab_vi">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="title_vi" id="title_vi" value="" placeholder="Tiêu đề" required maxlength="255">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Giới thiệu
                                                    </label>
                                                    <textarea class="form-control editors" name="content_vi" required id="introduce_vi" rows="3"></textarea>
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
                                                    <textarea class="form-control editors" name="content_en" required id="introduce_en" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_seo">
                                                <div class="form-group">
                                                    <label>Seo Title</label>
                                                    <input type="text" class="form-control" name="author" id="author" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Keyword Description</label>
                                                    <textarea type="text" class="form-control" name="keyword" id="keyword" style="resize: none" rows="4" required></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label>Seo Description</label>
                                                    <textarea type="text" class="form-control" name="description" rows="4" style="resize: none" id="description" required></textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_news">
                                                <div class="form-group">
                                                    <label for="introduce">Các tin tức liên quan</label>
                                                    <select class="selectpicker form-control" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" multiple id="news_all" name="news_all[]">
                                                        <optgroup label="Tin tức bất động sản" style="font-weight: bold; font-size: 20px">
                                                            @if($news_1!=null)
                                                                @foreach($news_1 as $item)
                                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                        <optgroup label="Thư viện hình ảnh">
                                                            @if($news_2!=null)
                                                                @foreach($news_2 as $item)
                                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            @if($news_lang!=null)
                                                @foreach($news_lang as $item)
                                                    @if($item->lang=='vi')
                                                        <div class="tab-pane active" id="tab_vi">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="title_vi" id="title_vi" value="{{$item->title}}" placeholder="Tiêu đề" required maxlength="255">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="introduce">
                                                                    Giới thiệu
                                                                </label>
                                                                <textarea class="form-control editors" name="content_vi" required id="introduce_vi" rows="3">{{$item->content}}</textarea>
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
                                                                <textarea class="form-control editors" name="content_en" required id="introduce_en" rows="3">{{$item->content}}</textarea>
                                                            </div>
                                                        </div>
                                                    @endif
                                                        <div class="tab-pane" id="tab_seo">
                                                            <div class="form-group">
                                                                <label>Seo Title</label>
                                                                <input type="text" class="form-control" name="author" id="author" value="<?=$news ? $news->seo_author: ''?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Keyword Description</label>
                                                                <textarea type="text" class="form-control" name="keyword" id="keyword" style="resize: none" rows="4" required><?=$news ? $news->seo_keyword: ''?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Seo Description</label>
                                                                <textarea type="text" class="form-control" name="description" rows="4" style="resize: none" id="description" required><?=$news ? $news->seo_description: ''?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane" id="tab_news">
                                                            <div class="form-group">
                                                                <label for="introduce">Các tin tức liên quan</label>
                                                                <select class="selectpicker form-control" data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" multiple id="news_all" name="news_all[]">
                                                                    <?php
                                                                    $arr_news=explode(",",$news->news_relation);
                                                                    ?>
                                                                    <optgroup label="Tin tức bất động sản" style="font-weight: bold; font-size: 20px">
                                                                        @if($news_1!=null)
                                                                            @foreach($news_1 as $item)
                                                                                @if(in_array($item->id,$arr_news))
                                                                                    <option value="{{$item->id}}" selected>{{$item->title}}</option>
                                                                                @else
                                                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </optgroup>
                                                                    <optgroup label="Thư viện hình ảnh">
                                                                        @if($news_2!=null)
                                                                            @foreach($news_2 as $item)
                                                                                @if(in_array($item->id,$arr_news))
                                                                                    <option value="{{$item->id}}" selected>{{$item->title}}</option>
                                                                                @else
                                                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="introduce">Đính kèm Form</label>
                                    @if($news!=null)
                                        @if($news->is_form==1)
                                            <input style="margin-left: 40px;" type="checkbox" checked id="txtform" name="txtform">
                                        @else
                                            <input style="margin-left: 40px;" type="checkbox" id="txtform" name="txtform">
                                        @endif
                                    @else
                                        <input style="margin-left: 40px;" type="checkbox" id="txtform" name="txtform">
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label class="control-label">Hình ảnh(300 x 200)</label>
                                    <?php
                                    if($news!=null)
                                    {

                                        echo'<input id="file" accept="image/*" name="file" type="file" style="padding-bottom: 20px" onchange="readURL(this);" class="file-loading">';

                                    }
                                    else
                                    {
                                        echo '<input id="file" accept="image/*" name="file" type="file" style="padding-bottom: 20px" onchange="readURL(this);" class="file-loading" required>';
                                    }
                                    ?>
                                    <img id="imgF" src="{{asset('images/news')}}/<?=$news ? $news->image: ''?>" class="img-responsive" style="height: 200px;">
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
    $(document).ready(function() {
        $('body').on('click', function(e) {
            var target = $(event.target),
                $parent = target.parents('.bootstrap-select');

            if ($parent.length) {
                e.stopPropagation();
                $parent.toggleClass('open');
            } else {
                $('.bootstrap-select').removeClass('open');
            }
        });
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
    CKEDITOR.replace( 'content_vi', {
        filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
        filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700'
    } );
    CKEDITOR.replace( 'content_en', {
        filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
        filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700'
    } );
    jQuery(document).ready(function() {
        jQuery('#frNews').validate({
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

        jQuery('#saveNews').click(function(evt) {
            evt.preventDefault();

            jQuery('#frNews').submit()

        });
    });

</script>
@endsection