@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <button onclick="ftGetModal()" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspTỉnh</i></button>
            <a href="{{url('admin/province')}}" class="btn btn-danger" style="border-radius:0px;"><i class="fa fa-refresh">&nbspRefresh</i></a>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Tỉnh</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
                <div class="col-md-12 divSearch" style="margin-bottom: 30px">
                    <form action="{{url('admin/search-province')}}" method="GET" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <div class="col-md-3 col-sm-3">
                            <input class="form-control" value="<?=$search ? $search: ''?>" name="txtsearch" id="txtsearch" placeholder="Nhập tên...">
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select name="searchCountry" id="searchCountry" class="form-control">
                                <option value="0">-- Chọn quốc gia --</option>
                                @if($country !=null)
                                    @foreach ($country as $row)
                                        @if($row->id==$id_country)
                                            <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endif

                                    @endforeach
                               @endif
                            </select>
                        </div>
                        <div class="col-md-1 col-sm-1">
                            <button class="btn btn-info" type="submit">Tìm</button>
                        </div>
                    </form>
                </div>

                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="{{url('admin/province-save')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Thông tin Tỉnh/Thành phố</h4>
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
                                <div class="form-group">
                                    <label for="introduce">Quốc gia</label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="0">-- Chọn quốc gia --</option>
                                        @if($country !=null)
                                            @foreach ($country as $row)
                                                <option value="{{$row->id}}">{{$row->name}} ({{$row->name_en}})</option>
                                           @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Thứ tự hiển thị</label>
                                    <input style="margin-left: 10px; width: 50px" type="text" id="thutu" name="thutu">
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
                        <td>Quốc Gia</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($province!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($province as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                   <td>
                                       {{$item->name}}
                                   </td>
                                    <td>{{$item->name_en}}</td>
                                    <td>{{$item->country}}</td>
                                    <td  style="width: 110px">
                                        <a onclick="ftGetValue('{{$item->id}}','{{$item->name}}','{{$item->name_en}}','{{$item->country_id}}','{{$item->sort_order}}');" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/province-delete')}}/{{$item->id}}" class="btn btn-danger">
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
                        {{$province->links()}}
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
        function ftGetModal() {

            $('#txtid').val('0');
            $('#name').val('');
            $('#name_en').val('');
            $('#thutu').val('0');
            document.getElementById('country').selectedIndex = 0;
//            $('#country option[value=0]').attr('selected','selected');
            $('#myModal').modal('show');
        }
        function ftGetValue(id, name, name_en, idcountry,thutu) {
            document.getElementById('country').selectedIndex = idcountry;
            $('#txtid').val(id);
            $('#name').val(name);
            $('#name_en').val(name_en);
            $('#thutu').val(thutu);
//            $('#country option[value='+idcountry+']').attr('selected','selected');
            $('#myModal').modal('show');
        }
    </script>
@endsection