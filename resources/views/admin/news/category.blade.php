@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Danh mục tin tức</h1>
            {{--<a href="{{url('admin/introduce/0')}}" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspSlider</i></a>--}}
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Tin tức</li>
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
                <div class="row">
                    @foreach($category as $item)
                        <div class="col-md-6">
                            <form action="{{url('admin/category-save')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input hidden value="{{$item->id}}" name="txtid">
                                <img src="{{asset('images/category')}}/{{$item->image}}" id="imFile{{$item->id}}" class="img-responsive">
                                <input style="margin-top: 10px" type="file" name="file{{$item->id}}" onchange="readURL(this, '{{$item->id}}')">
                                <input style="margin-top: 10px"  type="text" required value="{{$item->title}}" name="txtname" class="form-control">
                                <input style="margin-top: 10px"  type="text" required value="{{$item->title_en}}" name="txtname_en" class="form-control">
                                <button style="margin-top: 10px"  type="submit" class="btn btn-info">Cập nhật</button>
                            </form>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <br>
    </div>
    <script>
        $(function() {
            $('.alert').delay(5000).show().fadeOut('slow');
        });
        function readURL(input, $id) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imFile'+$id).attr('src', e.target.result);
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