@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <button onclick="ftGetModal()" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspSlider</i></button>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Slide</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="{{url('admin/slide-save')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Thông tin Slider</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <img src="" class="img-responsive" id="imgF">
                                    <input type="file" accept="image/*" class="form-control" name="file" id="file" onchange="readURL(this);" style="margin-bottom: 10px">
                                    <input id="txtid" name="txtid" value="0" hidden>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Hiển thị</label>
                                    <input style="margin-left: 10px;" type="checkbox" id="txtshow" name="txtshow">
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Thứ tự hiển thị</label>
                                    <input style="margin-left: 10px; width: 50px" type="text" id="txtthutu" name="txtthutu">
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
                    <table class="table table-striped table-bordered" style="text-align: center">
                        <thead>
                        <td>#</td>
                        <td>Hình ảnh</td>
                        <td>Hiển thị</td>
                        <td>Thứ tự hiển thị</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($slider!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($slider as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td  style="width: 250px"><img src="{{asset('images/sliders')}}/{{$item->image}}" style="width:100%; height: 150px" class="img-responsive"></td>
                                    <td>
                                    @if($item->is_show==1)
                                        <i style="color: green" class="fa fa-check-circle"></i>
                                    @else

                                    @endif
                                        </td>
                                    <td>{{$item->sort_order}}</td>
                                    <td  style="width: 110px">
                                        <a onclick="ftGetValue('{{$item->id}}','{{$item->image}}','{{$item->is_show}}','{{$item->sort_order}}');" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/slide-delete')}}/{{$item->id}}" class="btn btn-danger">
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