@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Thông tin liên hệ</h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Liên hệ</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="{{url('admin/slide-save')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <div class="box-header with-border">
                                <button type="submit" id="saveIntroduce" class="btn btn-success usersubmit" name="save"><i class="fa fa-save"></i> Lưu</button>
                                <a class="btn btn-danger" href="{{url('admin/recruitment')}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                            </div>
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Thông tin Liên hệ</h4>
                            </div>
                            <div class="modal-body">
                            <div class="form-group">
                                <label>Tên người gửi</label>
                                <input class="form-control" type="text" id="name" name="name" disabled>
                                <input id="txtid" name="txtid" value="0" hidden>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" id="email" name="email" disabled>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" type="text" id="title" name="title" disabled>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" type="text" id="phone" name="phone" disabled>
                            </div>
                            <div class="form-group">
                                <label>Ngày gửi</label>
                                <input class="form-control" type="text" id="created_at" disabled name="created_at">
                            </div>
                            <div class="form-group">
                                <label>Copy</label>
                                <input type="checkbox" id="copy" name="copy">
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control" type="text" id="content" disabled name="content"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="0">Chưa duyệt</option>
                                    <option value="1" selected="selected">Đã duyệt</option>
                                </select>
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

                    <form action="{{url('admin/contact-save')}}" method="POST" enctype="multipart/form-data">
                        <div class="box-header with-border">
                            <button type="submit" id="saveIntroduce" class="btn btn-success usersubmit" name="save"><i class="fa fa-save"></i> Lưu</button>
                            <a class="btn btn-danger" href="{{url('admin/contact')}}"><i class="fa fa-close"></i> Hủy bỏ</a>
                        </div>
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <div class="box-body">
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
                                            <label>Tiêu đề</label>
                                            <input class="form-control" type="text" id="title" value="{{$contact->title}}" name="title" disabled>
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
                                        <div class="form-group">
                                            <label>Copy</label>
                                            @if($contact->is_copy==1)
                                                <input type="checkbox" id="copy" name="copy" disabled>
                                            @else
                                                <input type="checkbox" id="copy" checked name="copy" disabled>
                                            @endif

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