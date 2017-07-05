@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if($type==1)
                <h1>Liên hệ - tin tức</h1>
            @else
                <h1>Liên hệ - dự án</h1>
            @endif

            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Liên hệ</li>
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
                <div class="row" >
                    <table class="table table-striped table-bordered">
                        <thead>
                        <td>#</td>
                        <td>Tên</td>
                        <td>Email</td>
                        <td>Số điện thoại</td>
                        <td>Ngày gửi</td>
                        <td>Tên bài viết</td>
                        <td>Trạng thái</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($contact!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($contact as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                        <?php
                                        $day=date_create($item->created_at);
                                        $ngay=date_format($day,'d/m/Y');
                                        echo $ngay;
                                        ?>
                                    </td>
                                    <td>
                                       <a href="{{url('admin/news/')}}/{{$item->id_type}}" target="_blank">{{$item->title}}</a>
                                    </td>
                                    <td>
                                        @if($item->status==1)
                                            <span class="label label-success">Đã duyệt</span>
                                        @else
                                            <span class="label label-danger">Chưa duyệt</span>
                                        @endif
                                    </td>
                                    <td  style="width: 110px">
                                        <a href="{{url('admin/contact-form')}}/{{$item->type}}/{{$item->id}}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/contact-form-delete')}}/{{$item->type}}/{{$item->id}}" class="btn btn-danger">
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
                        {{$contact->links()}}
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
    </script>
@endsection