@extends('admin.layouts.master')


@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>Thêm Dự án</h4>

            <ol class="breadcrumb">
                <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thêm dự án</li>
            </ol>
        </section>
        <section class="content-header">

            <div class="box box-primary" id="text">
                <!-- /.box-header -->
                <form id="frNews" method="POST" action="{{url('admin/property-save')}}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <div class="box-header with-border">
                        <button type="submit" id="saveNews" class="btn btn-success usersubmit" name="save"><i class="fa fa-save"></i> Lưu</button>
                        <a class="btn btn-danger" href="{{url('admin/property')}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                    </div>
                    <div class="box-body">
                        <div class="row col-md-12" style="padding-bottom: 10px">
                            <input hidden type="text" name="txtid" value="0">
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs" id="tabSoluoc">
                                        <li class="active"><a href="#tab_vi" data-toggle="tab" aria-expanded="true">Tiếng Việt</a></li>
                                        <li class=""><a href="#tab_en" data-toggle="tab" aria-expanded="true">English</a></li>
                                        <li class=""><a href="#tab_seo" data-toggle="tab" aria-expanded="true">Seo</a></li>
                                    </ul>
                                    <div class="tab-content" id="contentSoluoc">
                                            <div class="tab-pane active" id="tab_vi">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="title_vi" id="title_vi" value="" placeholder="Tiêu đề" required maxlength="255">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Hình thức sở hữu
                                                    </label>
                                                    <input type="text" id="ownership_vi" name="ownership_vi" value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Chủ đầu tư
                                                    </label>
                                                    <input type="text" id="investor_vi" name="investor_vi" value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Địa chỉ
                                                    </label>
                                                    <input type="text" id="address_vi" name="address_vi" value="" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Thông tin
                                                    </label>
                                                    <textarea class="form-control editors" name="info_vi" required id="info_vi" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Các dịch vụ
                                                    </label>
                                                    <textarea class="form-control editors" name="service_vi" required id="service_vi" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_en">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="title_en" id="title_en" value="" placeholder="Title" required maxlength="255">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        OwnerShip
                                                    </label>
                                                    <input type="text" id="ownership_en" name="ownership_en" value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Investor
                                                    </label>
                                                    <input type="text" id="investor_en" name="investor_en" value="" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Address
                                                    </label>
                                                    <input type="text" id="address_en" name="address_en" value="" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Information
                                                    </label>
                                                    <textarea class="form-control editors" name="info_en" required id="info_en" rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="introduce">
                                                        Services
                                                    </label>
                                                    <textarea class="form-control editors" name="service_en" required id="service_en" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab_seo">
                                                <div class="form-group">
                                                    <label>Seo Title</label>
                                                    <input type="text" class="form-control" name="author" id="author" value="" required>
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
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="introduce">Đính kèm Form
                                    <input style="margin-left: 40px;" type="checkbox" id="form" name="form"></label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Loại giao dịch</label>
                                    <label style="margin-left: 10px"><input type="radio" name="type" value="0" checked>Bán</label>
                                    <label style="margin-left: 10px"><input type="radio" name="type" value="1">Thuê</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Loại dự án</label>
                                    <select class="form-control" name="project" id="project">
                                       @if($project!=null)
                                           @foreach($project as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                       @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Quốc gia</label>
                                    <select class="form-control" id="country" required name="country" onchange="ftgetProvince()">
                                        <option value="">--Chọn--</option>
                                        @if($country!=null)
                                            @foreach($country as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tỉnh/Thành phố</label>
                                    <select class="form-control" name="province" required id="province" onchange="ftgetDistrict()">

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label class="control-label">Quận/Huyện</label>
                                    <select class="form-control" required name="district" id="district">

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="introduce">Số tầng</label>
                                    <input type="text" id="floor" name="floor" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Mã căn hộ</label>
                                    <input type="text" id="apartment" name="apartment" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Số phòng ngủ</label>
                                    <input type="text" id="bed" name="bed" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Số phòng tắm</label>
                                    <input type="text" id="bath" name="bath" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Diện tích dự án</label>
                                    <input type="text" id="acreage" name="acreage" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Diện tích căn hộ (m2)</label>
                                    <input type="text" id="area_apartment" name="area_apartment" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Giá</label>
                                    <input type="text" id="price" name="price" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Số điện thoại</label>
                                    <input type="text" maxlength="15" id="phone" name="phone" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Email</label>
                                    <input type="text" id="email" name="email" value="" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="0">Chưa duyệt</option>
                                        <option value="1">Đã duyệt</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="col-md-12" style="padding-bottom: 20px">
                            <div class="col-md-6 col-xs-6">
                                <input type="file" accept="image/*" id="file" name="file"  onchange="readURL(this);" class="form-control" required>
                                <img id="blah" src="" class="img-responsive" style="height: 250px">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="file" accept="image/*" id="file-overall" name="file-overall"  onchange="readURL1(this);" class="form-control" required>
                                <img id="blahtongthe" src="" class="img-responsive" style="height: 250px">
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-bottom: 20px">
                            <div class="col-md-12">
                                <label class="control-label">Chọn thêm hình ảnh</label>
                                <input id="file-multi" type="file" name="file-multi[]" class="file" multiple data-preview-file-type="text" >
                                <!--                                            <input id="inputimage" name="inputKE1[]" type="file" multiple class="file-loading" data-preview-file-type="text"  accept="image">-->
                            </div>
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
                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL1(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blahtongthe').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(function() {
        $('.editors').each(function(){
            CKEDITOR.replace( $(this).attr('id'), {
                filebrowserBrowseUrl: '{{url('ckeditor/ckfinder/ckfinder.html')}}',
                filebrowserUploadUrl: '{{url('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
                filebrowserWindowWidth: '1000',
                filebrowserWindowHeight: '700'
            } );
        });
//        $("#input-id").fileinput({
//            allowedFileExtensions: ["jpg", "png", "gif"]
//        });
    });
    function ftgetProvince() {
        var id=document.getElementById("country").value;
        $('#province').children().remove();
        $.ajax({
            type: "POST",
            url: "{{url('admin/get-province')}}",
            data: {'id' :id,'_token':'{!! csrf_token()!!}'},
            dataType: "json",
            cache: false,
            success: function(data){
                $('#province').append('<option value="0">--Chọn Tỉnh/Thành phố--</optin>');
                for(var i=0; i<data.province.length;i++)
                {
                    var op='<option value="'+data.province[i]['id']+'">'+data.province[i]['name']+'</optin>';
                    $('#province').append(op);
                }
            }
        });
    }
    function ftgetDistrict() {
        var id=document.getElementById("province").value;
        $('#district').children().remove();
        $.ajax({
            type: "POST",
            url: "{{url('admin/get-district')}}",
            data: {'id' :id,'_token':'{!! csrf_token()!!}'},
            dataType: "json",
            cache: false,
            success: function(data){
                $('#district').append('<option value="0">--Chọn Quận/Huyện--</optin>');
                for(var i=0; i<data.district.length;i++)
                {
                    var op='<option value="'+data.district[i]['id']+'">'+data.district[i]['name']+'</optin>';
                    $('#district').append(op);
                }
            }
        });
    }
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