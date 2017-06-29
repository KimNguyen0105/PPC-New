@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <button onclick="ftGetModal()" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspĐối Tác</i></button>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Đối tác</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="{{url('admin/partners-save')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="form-group">
                                <img src="" class="img-responsive" id="imgF">
                                <input type="file" accept="image/*" class="form-control" name="file" id="file" onchange="readURL(this);" style="margin-bottom: 10px">
                                <input id="txtid" name="txtid" value="0" hidden>
                            </div>
                            <div class="form-group">
                                <label for="introduce">Tên công ty Vi</label>
                                <input style="margin-left: 10px;" type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="introduce">Tên công ty En</label>
                                <input style="margin-left: 10px;" type="text" id="name_en" name="name_en" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="introduce">Link liên kết</label>
                                <input style="margin-left: 10px;" type="text" id="link" name="link" class="form-control">
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
                    <table class="table table-striped table-bordered" style="text-align: center">
                        <thead>
                        <td>#</td>
                        <td>Hình ảnh</td>
                        <td>Tên Công ty Vi</td>
                        <td>Tên Công ty En</td>
                        <td>Link liên kết</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($partners!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($partners as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td  style="width: 150px"><img src="{{asset('images/partners')}}/{{$item->image}}" style="width:100%;" class="img-responsive"></td>
                                    <td>{{$item->name}}</td>

                                    <td>{{$item->name_en}}</td>
                                    <td>{{$item->link}}</td>
                                    <td  style="width: 110px">
                                        <a onclick="ftGetValue('{{$item->id}}','{{$item->image}}','{{$item->name}}','{{$item->name_en}}','{{$item->link}}');" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/partners-delete')}}/{{$item->id}}" class="btn btn-danger">
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
            $('#file').val('');
            $('#name').val('');
            $('#name_en').val('');
            $('#link').val('');
            document.getElementById("imgF").src='';
            $('#myModal').modal('show');
        }
        function ftGetValue(id, image, name, name_en,link) {
            $('#txtid').val(id);
            $('#name').val(name);
            $('#name_en').val(name_en);
            $('#link').val(link);
            document.getElementById("imgF").src='{{asset('images/partners')}}/'+image;
            $('#myModal').modal('show');
        }
    </script>
@endsection