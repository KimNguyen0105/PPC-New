@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <a href="{{url('admin/news-gallery/0')}}" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspTin tức thư viện hình ảnh</i></a>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Thư viện hình ảnh</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
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
                    <div style="clear: both"></div>
                <div class="col-md-12 divSearch" style="margin-bottom: 30px">
                    <form action="{{url('admin/search-news-gallery')}}" method="GET" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <div class="col-md-4 col-sm-4">
                            <input class="form-control" value="{{$search}}" name="txtsearch" id="txtsearch" placeholder="Nhập tiêu đề tin tức...">
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
                        <td>Category</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($news!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($news as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td  style="width: 150px;"><img src="{{asset('images/news')}}/{{$item->image}}" style="width:100%; height: 100px" class="img-responsive"></td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->category}}</td>
                                    <td  style="width: 250px">
                                        <a href="{{url('admin/news-gallery-image')}}/{{$item->id}}" class="btn btn-primary"><span class="fa fa-plus"></span> Thêm hình ảnh</a>
                                        <a href="{{url('admin/news-gallery')}}/{{$item->id}}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/news-delete')}}/{{$item->id}}" class="btn btn-danger">
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
                        {{$news->links()}}
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