@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <button onclick="ftGetModal()" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspQuốc gia</i></button>
            <a href="{{url('admin/country')}}" class="btn btn-danger" style="border-radius:0px;"><i class="fa fa-refresh">&nbspRefresh</i></a>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Quốc gia</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="{{url('admin/country-save')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Thông tin Quốc gia</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input id="txtid" name="txtid" value="0" hidden>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Tên quốc gia (Tiếng việt)</label>
                                    <input style="margin-left: 10px;" type="text" id="name" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Tên quốc gia (Tiếng anh)</label>
                                    <input style="margin-left: 10px;" type="text" id="name_en" class="form-control" name="name_en">
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
                        <td>Tên tiếng việt</td>
                        <td>Tên tiếng anh</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($country!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($country as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                   <td>
                                       {{$item->name}}
                                   </td>
                                    <td>{{$item->name_en}}</td>
                                    <td  style="width: 110px">
                                        <a onclick="ftGetValue('{{$item->id}}','{{$item->name}}','{{$item->name_en}}');" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/country-delete')}}/{{$item->id}}" class="btn btn-danger">
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
            $('#name').val('');
            $('#name_en').val('');
            $('#myModal').modal('show');
        }
        function ftGetValue(id, name, name_en) {
            $('#txtid').val(id);
            $('#name').val(name);
            $('#name_en').val(name_en);
            $('#myModal').modal('show');
        }
    </script>
@endsection