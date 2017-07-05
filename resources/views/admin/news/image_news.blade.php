@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <a class="btn btn-danger" href="{{url('admin/news-gallery-home')}}"><i class="fa fa-arrow-left"></i> Quay lại</a>
            <button onclick="ftGetModal()" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspThêm hình ảnh</i></button>

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thư viện hình ảnh</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="{{url('admin/news-gallery-image-save')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Thông tin Hình ảnh tin tức</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <img src="" class="img-responsive" style="width: 100%" id="imgF">
                                        <input type="file" accept="image/*" class="form-control" name="file" id="file" onchange="readURL(this);" style="margin-bottom: 10px; width: 100%">
                                        <input id="txtid" name="txtid" value="0" hidden>
                                        <input id="txtid_news" name="txtid_news" value="{{$id}}" hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="introduce">Tiêu đề (tiếng việt)</label>
                                        <input style="margin-left: 10px;" type="text" id="name_vi" name="name_vi" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="introduce">Tiêu đề (tiếng anh)</label>
                                        <input style="margin-left: 10px;" type="text" id="name_en" name="name_en" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info" style="margin-right: 15px"><i class="fa fa-save"></i><b> Save</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


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
                    <table class="table table-striped table-bordered">
                        <thead>
                        <td>#</td>
                        <td>Hình ảnh</td>
                        <td>Tiêu đề Vi</td>
                        <td>Tiêu đề En</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($images!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($images as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td  style="width: 150px;"><img src="{{asset('images/gallery_image')}}/{{$item->image}}" style="width:100%; height: 100px" class="img-responsive"></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->name_en}}</td>
                                    <td  style="width: 110px">
                                        <a onclick="ftGetValue('{{$item->id}}','{{$item->image}}','{{$item->name}}','{{$item->name_en}}');" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/news-gallery-image-delete')}}/{{$id}}-{{$item->id}}" class="btn btn-danger">
                                            <span class="fa fa-trash" onclick="return confirm('bạn có chắc xóa?')"></span></a>

                                    </td>
                                </tr>
                                <?php
                                $i++;
                                ?>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="col-md-12 text-center">
                        {{$images->links()}}
                    </div>
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
        function ftGetModal() {

            $('#txtid').val('0');
            $('#name_vi').val('');
            $('#name_en').val('');
            $('#file').val('');
            document.getElementById("imgF").src='';
            $('#myModal').modal('show');
        }
        function ftGetValue(id, image, name, name_en) {
            $('#txtid').val(id);
            $('#name_vi').val(name);
            $('#name_en').val(name_en);
            document.getElementById("imgF").src='{{asset('images/gallery_image')}}/'+image;
            $('#myModal').modal('show');
        }
    </script>
@endsection