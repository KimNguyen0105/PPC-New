@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1>Liên hệ</h1>
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
                <div class="row" >
                    <table class="table table-striped table-bordered">
                        <thead>
                        <td>#</td>
                        <td>Tên</td>
                        <td>Email</td>
                        <td>Tiêu đề</td>
                        <td>Ngày gửi</td>
                        <td>Copy</td>
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
                                    <td>{{$item->title}}</td>
                                    <td>
                                        <?php
                                        $day=date_create($item->created_at);
                                        $ngay=date_format($day,'d/m/Y');
                                        echo $ngay;
                                        ?>
                                    </td>
                                    <td>
                                        @if($item->is_copy==1)
                                            <p style="color: blue">Có</p>
                                        @else
                                            <p style="color: red">Không</p>
                                       @endif
                                    </td>
                                    <td>
                                        @if($item->status==1)
                                            <span class="label label-success">Đã duyệt</span>
                                        @else
                                            <span class="label label-danger">Chưa duyệt</span>
                                        @endif
                                    </td>
                                    <td  style="width: 110px">
                                        <a href="{{url('admin/contact/')}}/{{$item->id}}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/contact-delete')}}/{{$item->id}}" class="btn btn-danger">
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