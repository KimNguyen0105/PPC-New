@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Danh mục</h1>
            {{--<a href="{{url('admin/introduce/0')}}" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspSlider</i></a>--}}
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Slide</li>
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
                    <table class="table table-striped table-bordered" style="text-align: center">
                        <thead>
                        <td>#</td>
                        <td>Hình ảnh</td>
                        <td>Tiêu đề</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($introduce!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($introduce as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td  style="width: 250px"><img src="{{asset('images/introduce')}}/{{$item->image}}" style="width:100%; height: 150px" class="img-responsive"></td>
                                    <td>{{$item->title}}</td>
                                    <td  style="width: 110px">
                                        <a href="{{url('admin/introduce')}}/{{$item->id}}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
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

    </script>
@endsection