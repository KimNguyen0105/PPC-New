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
                <div class="row" style="padding: 20px">
                    <form id="validatedForm" action="{{url('admin/profile-save')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <div class="row">
                            <div class="col-md-8 col-xs-8 paddinglr0">
                                <input type="file" class="form-control" value="{{$name}}" id="file" name="file" accept="application/pdf" style="margin-bottom: 10px">
                                <h5>(File tải lên phải là file pdf)</h5>
                            </div>

                            <div class="col-md-2 col-xs-4 paddinglr0">
                                <button class="btn btn-info" type="submit"><i class="fa fa-plus"> Cập nhật</i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row" style="padding: 0 20px">
                    <h5>(File mới khi được tải lên sẽ được đổi tên thành profile)</h5>
                    <h4>Tên file: <a href="{{asset('profile/profile.pdf')}}" target="_blank">profile.pdf</a></h4> <h5>Size: {{$mb}} MB</h5>
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