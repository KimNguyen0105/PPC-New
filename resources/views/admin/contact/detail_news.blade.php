@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if($contact->type==1)
                <h1>Thông tin liên hệ - tin tức</h1>
            @else
                <h1>Thông tin liên hệ - dự án</h1>
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

                    <form action="{{url('admin/contact-form-save')}}/{{$contact->type}}" method="POST" enctype="multipart/form-data">
                        <div class="box-header with-border">
                            <button type="submit" id="saveIntroduce" class="btn btn-success usersubmit" name="save"><i class="fa fa-save"></i> Lưu</button>
                            <a class="btn btn-danger" href="{{url('admin/contact')}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                        </div>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <h5>Tin tức liên quan: <a href="{{url('admin/news')}}/{{$contact->id}}" target="_blank">{{$contact->title}}</a></h5>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên người gửi</label>
                                            <input class="form-control" type="text" id="name" value="{{$contact->name}}" name="name" disabled>
                                            <input id="txtid" name="txtid" value="{{$contact->id}}" hidden>
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input class="form-control" type="text" id="phone" value="{{$contact->phone}}" name="phone" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                                @if($contact->status==1)
                                                    <select class="form-control" name="status" id="status" disabled>
                                                        <option value="0">Chưa duyệt</option>
                                                        <option value="1" selected="selected">Đã duyệt</option>
                                                    </select>
                                                @else
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="0" selected="selected">Chưa duyệt</option>
                                                        <option value="1">Đã duyệt</option>
                                                    </select>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="text" id="email" value="{{$contact->email}}" name="email" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Ngày gửi</label>
                                            <input class="form-control" type="text" id="created_at" value="{{$contact->created_at}}" disabled name="created_at">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea class="form-control" type="text" id="content" disabled name="content" rows="5">{{$contact->content}}</textarea>
                                    </div>
                                </div>

                        </div>
                    </form>
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