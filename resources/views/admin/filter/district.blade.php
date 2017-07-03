@extends('admin.layouts.master')
@section('Content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <button onclick="ftGetModal()" class="btn btn-info" style="border-radius:0px;"><i class="fa fa-plus">&nbspQuận/Huyện</i></button>
            <a href="{{url('admin/district')}}" class="btn btn-danger" style="border-radius:0px;"><i class="fa fa-refresh">&nbspRefresh</i></a>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Quận/Huyện</li>
                <!-- <li class="active">video</li> -->
            </ol>
        </section>
        <section class="content-header">
            <div class="box box-primary" style="padding:20px;">
                <div class="col-md-12 divSearch" style="margin-bottom: 30px">
                    <form action="{{url('admin/search-district')}}" method="GET" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <div class="col-md-3 col-sm-3">
                        <input class="form-control" name="txtsearch" id="txtsearch" value="{{$search}}" placeholder="Nhập tên...">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <select name="searchCountry" id="searchCountry" class="form-control" onchange="ftGetProvinceSearch()">
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
                    <div class="col-md-4 col-sm-4">
                        <select name="searchProvince" id="searchProvince" class="form-control">
                            <option value="0">-- Chọn tỉnh --</option>
                            @if($province !=null)
                                @foreach ($province as $row)
                                    @if($row->id==$id_province)
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
                        <form action="{{url('admin/district-save')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Thông tin Quận/Huyện</h4>
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
                                    <select name="country" id="country" class="form-control" onchange="ftGetProvince()">
                                        <option value="0">-- Chọn quốc gia --</option>
                                        @if($country !=null)
                                            @foreach ($country as $row)
                                                <option value="{{$row->id}}">{{$row->name}} ({{$row->name_en}})</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="introduce">Tỉnh/Thành phố</label>
                                    <select name="province" id="province" class="form-control">
                                        <option value="0">-- Chọn tỉnh/thành phố --</option>
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
                        <td>Tỉnh/Thành phố</td>
                        <td>Thao tác</td>
                        </thead>
                        <tbody>
                        @if($district!=null)
                            <?php
                                $i=1;
                            ?>
                            @foreach($district as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                   <td>
                                       {{$item->name}}
                                   </td>
                                    <td>{{$item->name_en}}</td>
                                    <td>{{$item->country}}</td>
                                    <td>{{$item->province}}</td>
                                    <td  style="width: 110px">
                                        <a onclick="ftGetValue('{{$item->id}}','{{$item->name}}','{{$item->name_en}}','{{$item->id_province}}','{{$item->id_country}}','{{$item->sort_order}}');" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('admin/district-delete')}}/{{$item->id}}" class="btn btn-danger">
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
                        {{$district->links()}}
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
        function ftGetModal() {
            document.getElementById('country').selectedIndex = 0;
            $('#province').children().remove();
            $('#txtid').val('0');
            $('#name').val('');
            $('#name_en').val('');
            $('#thutu').val('0');
            $('#myModal').modal('show');
        }
        function ftGetValue(id, name, name_en, province, country,thutu) {
            document.getElementById('country').selectedIndex = country;

            ftGetProvince1(province);
            $('#txtid').val(id);
            $('#name').val(name);
            $('#name_en').val(name_en);
            $('#thutu').val(thutu);
            $('#province1').val(province);
            $('#myModal').modal('show');


        }
        function ftGetProvince1(province) {
            var idquocgia=document.getElementById("country").value;
            $('#province').children().remove();
            $.ajax({
                type: "POST",
                url: "{{url('admin/get-province')}}",
                data: {'id' :idquocgia,'_token':'{!! csrf_token()!!}'},
                dataType: "json",
                cache: false,
                success: function(data){
                    for(var i=0; i<data.province.length;i++)
                    {
                        if(data.province[i]['id']==province)
                        {
                            var op='<option value="'+data.province[i]['id']+'" selected>'+data.province[i]['name']+'</optin>';
                        }
                        else{
                            var op='<option value="'+data.province[i]['id']+'">'+data.province[i]['name']+'</optin>';

                        }
                        $('#province').append(op);
                    }
                }
            });
        }
        function ftGetProvince() {
            var idquocgia=document.getElementById("country").value;
            $('#province').children().remove();
            $.ajax({
                type: "POST",
                url: "{{url('admin/get-province')}}",
                data: {'id' :idquocgia,'_token':'{!! csrf_token()!!}'},
                dataType: "json",
                cache: false,
                success: function(data){
                    for(var i=0; i<data.province.length;i++)
                    {
                        var op='<option value="'+data.province[i]['id']+'">'+data.province[i]['name']+'</optin>';
                        $('#province').append(op);
                    }
                }
            });
        }
        function ftGetProvinceSearch() {
            var idquocgia=document.getElementById("searchCountry").value;
            $('#searchProvince').children().remove();
            $.ajax({
                type: "POST",
                url: "{{url('admin/get-province')}}",
                data: {'id' :idquocgia,'_token':'{!! csrf_token()!!}'},
                dataType: "json",
                cache: false,
                success: function(data){
                    $('#searchProvince').append('<option value="0">--Chọn tỉnh--</option>');
                    for(var i=0; i<data.province.length;i++)
                    {
                        var op='<option value="'+data.province[i]['id']+'">'+data.province[i]['name']+'</optin>';
                        $('#searchProvince').append(op);
                    }
                }
            });
        }
        function searchDistrict() {
            var name=$('#txtsearch').val();
            var country=$('#searchCountry').val();
            var province=$('#searchProvince').val();
            $.ajax({
                type: "GET",
                url: "{{url('admin/search-province')}}",
                data: {'name':name,'country':country,'province':province,'_token':'{!! csrf_token()!!}'},
                dataType: "json",
                cache: false,
                success: function(data){
                    for(var i=0; i<data.province.length;i++)
                    {
                        var op='<option value="'+data.province[i]['id']+'">'+data.province[i]['name']+'</optin>';
                        $('#searchProvince').append(op);
                    }
                }
            });
        }
    </script>
@endsection