@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <a href="{{url('admin/property/0')}}" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspDự án</i></a>
            <a href="{{url('admin/property')}}" class="btn btn-danger" style="border-radius:0px;"><i class="fa fa-refresh">&nbspRefresh</i></a>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dự án</li>
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
                <div class="col-md-12 divSearch" style="margin-bottom: 30px">
                    <form action="{{url('admin/search-property')}}" method="GET" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <div class="col-md-3 col-sm-3">
                            <input class="form-control" name="txtsearch" id="txtsearch" value="{{$search}}" placeholder="Nhập tên...">
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select name="project" id="project" class="form-control" onchange="ftGetProvinceSearch()">
                                <option value="0">-- Chọn loại dự án --</option>
                                @if($project !=null)
                                    @foreach ($project as $row)
                                        @if($row->id==$id_project)
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif

                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select name="status" id="status" class="form-control">
                                        @if($id_status==1)
                                            <option value="2">-- Chọn trạng thái --</option>
                                            <option value="0">Chưa duyệt</option>
                                            <option value="1" selected>Đã duyệt</option>

                                        @elseif($id_status==0)
                                            <option value="2">-- Chọn trạng thái --</option>
                                            <option value="0" selected>Chưa duyệt</option>
                                            <option value="1" >Đã duyệt</option>

                                        @else
                                            <option value="2" selected>-- Chọn trạng thái --</option>
                                            <option value="0" >Chưa duyệt</option>
                                            <option value="1" >Đã duyệt</option>

                                        @endif
                            </select>
                        </div>
                        <div class="col-md-1 col-sm-1">
                            <button class="btn btn-info" type="submit">Tìm</button>
                        </div>
                    </form>
                </div>
                <div class="row" >
                    <table class="table table-striped table-bordered">
                        <thead>
                        <td>#</td>
                        <td>Hình ảnh</td>
                        <td>Tiêu đề</td>
                        <td>Loại dự án</td>
                        <td>Trạng thái</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($property!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($property as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td  style="width: 150px;"><img src="{{asset('images/property')}}/{{$item->image}}" style="width:100%; height: 100px" class="img-responsive"></td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        @if($item->status==1)
                                            <span class="label label-success">Đã duyệt</span>
                                        @else
                                            <span class="label label-danger">Chưa duyệt</span>
                                        @endif
                                    </td>
                                    <td  style="width: 110px">
                                        <a href="{{url('admin/property')}}/{{$item->id}}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/property-delete')}}/{{$item->id}}" class="btn btn-danger">
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
                        {{$property->links()}}
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
    </script>
@endsection