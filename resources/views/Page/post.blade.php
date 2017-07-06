@extends('master')
@section('main')


    <script src="{{asset('')}}js/jquery.validate.js"></script>

    
    <script src="ckeditor/ckeditor.js"></script>


    <style>
        .fileUpload {
            position: relative;
            overflow: hidden;
        }

        .fileUpload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
    </style>
    <div style="clear: both"></div>

    <div class="container paddingchitiet">
        <div class="text-center space">
            <h3 class="titlewweb" style="color:#443427;"><b>{{trans('home.post_info')}}</b></h3>
            <hr style="border:2.5px solid #443427;width:70px;">
            <div class="col-md-12 text-left">
                <h4 style="font-family: verdana;">{{trans('home.home')}} / <b>{{trans('home.post')}} </b></h4>
            </div>
        </div>

        <div class="space text-center admin-form">
            {{Form::open(array('route'=>'post-form-post','files'=>true))}}
            <div class="col-md-6 col-sm-12 text-left">
                <div class="form-group" style="margin-bottom: 24px">
                    <p style="margin-bottom: 20px">{{trans('home.transaction')}}</p>
                    <input type="radio" value="0" id="giaodich" name="giaodich"
                           style="font-family: verdana;" checked><span>{{trans('home.sale')}}</span>
                    <input type="radio" value="1" id="giaodich" name="type"
                           style="font-family: verdana;margin-left: 20px"> <span>{{trans('home.rent')}}</span>
                </div>
                <div class="form-group">
                    <p>{{trans('home.title')}}</p>
                    <input hidden type="text" name="title" id="txtid" value="0">
                    <input type="text" id="txttieude" name="title" class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.investor')}}</p>
                    <input type="text" id="txtchudautu" name="investor" class="gui-input form-control" required>
                </div>

                <div class="form-group">
                    <p>{{trans('home.project_area')}}</p>
                    <input type="text" onkeyup="return numberFloat(this)" id="txtdtduan" name="acreage"
                           class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.apartments_area')}}</p>
                    <input type="text" onkeyup="return numberFloat(this)" id="txtdtcanho" name="area_apartment"
                           class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.quatity_apartments')}}</p>
                    <input type="text" onkeyup="return numberKey(this)" id="txtsocanho" name="apartment"
                           class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.quatity_floors')}}</p>
                    <input type="text" onkeyup="return numberKey(this)" id="txtsotang" name="floor"
                           class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.bedrooms')}}</p>
                    <input type="text" onkeyup="return numberKey(this)" id="txtphongngu" name="bedroom"
                           class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.bathrooms')}}</p>
                    <input type="text" onkeyup="return numberKey(this)" id="txtsopvs" name="bathroom"
                           class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.services')}}</p>
                    <textarea class="form-control editors" name="txtdichvu" required id="service"
                              style="border-radius: 0px;resize: none" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <p>{{trans('home.project_picture')}}</p>
                    <div class="fileUpload btn" style="background-color:#443427;color:white;border:2px #443427;">
                        <span><i class="fa fa-paperclip" style="font-size: 20px;"></i></span>
                        <input type="file" class="upload" accept="image/*" name="imgDuAn" id="file1"
                               onchange="readURL(this);" required/>
                    </div>
                    <div style="padding: 12px 0px;">
                        <img src="{{URL::asset('images')}}" id="imgDuAn" class="img-responsive"
                             style="height: 150px;border: 2px solid #eee;">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 text-left">
                <div class="form-group">
                    <p>{{trans('home.type_projects')}}</p>
                    <select class="form-control" name="project_id" style="" id="loaiduan">
                        <option value="">--Select--</option>
                        @foreach($project_types as $project)
                            <option value="{{$project->id}}">
                                @if(Session::get('locale') =='vi')
                                    {{$project->name}}
                                @else
                                    {{$project->name_en}}
                                @endif

                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p>{{trans('home.country')}}</p>
                    <select class="form-control" id="quocgia" required name="country_id"
                            style="border-radius: 0px; height: 36px" onchange="ftgetTinh();">
                        <option value="">--Select--</option>
                        @foreach($country as $row)
                            <option value="{{$row->id}}">
                                @if(Session::get('locale') =='vi')
                                    {{$row->name}}
                                @else
                                    {{$row->name_en}}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <p>{{trans('home.province')}}</p>
                    <select class="form-control" id="tinh" style="border-radius: 0px; height: 36px" required name="province_id"
                            onchange="ftgetQuan()">
                        <option value="">--Select--</option>
                    </select>
                </div>
                <div class="form-group">
                    <p>{{trans('home.district')}}</p>
                    <select class="form-control" id="quan" style="border-radius: 0px; height: 36px" required
                            name="district_id">
                        <option value="">--Select--</option>
                    </select>
                </div>
                <div class="form-group">
                    <p>{{trans('home.price')}}</p>
                    <input type="text" id="txtgia" name="price" class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.property_ownership')}}</p>
                    <input type="text" id="txthinhthuc" name="ownership" class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.address')}}</p>
                    <input type="text" id="txtdiachi" name="address" class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.phone')}}</p>
                    <input type="text" onkeyup="return numberphone(this)" maxlength="15" id="txtsdt" name="phone"
                           class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>Email</p>
                    <input type="email" id="txtemail" name="email" class="gui-input form-control" required>
                </div>
                <div class="form-group">
                    <p>{{trans('home.project_info')}}</p>
                    <textarea class="form-control editors" name="info" required id="txtthongtin"
                              style="border-radius: 0px;resize: none" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <p>{{trans('home.plan_picture')}}</p>
                    <div class="fileUpload btn" style="background-color:#443427;color:white;border:2px #443427;">
                        <span><i class="fa fa-paperclip" style="font-size: 20px;"></i></span>
                        <input type="file" class="upload" accept="image/*" name="imgGeneral" id="fileTT"
                               onchange="readURLTT(this);" required/>
                    </div>
                    <div style="padding: 12px 0px;">
                        <img src="{{URL::asset('images')}}" id="imgDuAnTT" class="img-responsive"
                             style="height: 150px;border: 2px solid #eee;">
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-left">
                <div class="form-group">
                    <p>{{trans('home.detail_picture')}}</p>
                     <input id="input-id" type="file" name="imgDetail[]" class="file" multiple data-preview-file-type="text">

                </div>

            </div>


            <div class="col-md-12 text-left">
                <div class="form-group">
                    <button type="submit" class="btn"
                            style="background-color:#443427;color:white;border:2px #443427;">{{trans('home.submit_post')}}</button>
                </div>
            </div>
            {{Form::close()}}
        </div>

    </div>

    <script>


        function ftgetTinh() {
            var idquocgia=$('#quocgia').val();

            $('#tinh').children().remove();
            $('#quan').children().remove();
            $.ajax({
                type: "GET",
                url: "ppc-tinh/"+idquocgia,

                success: function(data){
                    var JSONObject = $.parseJSON(data);
                    if(JSONObject != null){
                        for (var i=0; i<JSONObject.length;i++)
                        {
                            var string='<option value="'+JSONObject[i]["id"]+'">'+JSONObject[i]["name"]+'</option>';
                            $('#tinh').append(string);
                        }
                    }
                }
            });
        }
        function ftgetQuan() {
            var id_quan=$("#tinh").val();
            $('#quan').children().remove();
            $.ajax({
                type: "GET",
                url: "ppc-quan/" + id_quan,

                success: function(data){
                    var JSONObject = $.parseJSON(data);
                    if(JSONObject != null){
                        for (var i=0; i<JSONObject.length;i++)
                        {
                            var string='<option value="'+JSONObject[i]["id"]+'">'+JSONObject[i]["name"]+'</option>';
                            $('#quan').append(string);
                        }
                    }
                }
            });
        }
        $(document).ready(function () {
            $("#fromContact").validate({
                errorClass: "state-error",
                validClass: "state-success",
                errorElement: "em",
                messages: {
                    txtname: {
                        required: 'Tên không được trống.'
                    },
                    txtemail: {
                        required: 'Email không được trống.',
                        email: 'Địa chỉ email không hợp lệ.'
                    },
                    txttitle: {
                        required: 'Tiêu đề không được trống.'
                    },
                    txtcontent: {
                        required: 'Nội dung không được trống.'
                    }
                }
            });
        });
        $(function () {
            $('.editors').each(function () {
                CKEDITOR.replace($(this).attr('id'));
            });
            $("#input-id").fileinput();
        });
        function numberphone(input) {
            input.value = input.value.replace(/[^0-9\.\-\+\(\)\s]/g, '');
        }
        function numberFloat(input) {
            input.value = input.value.replace(/[^0-9\.]/g, '');
        }
        function numberKey(input) {
            if (input.value.length == 1) {
                input.value = input.value.replace(/[^1-9]/g, '');
            }
            else {
                input.value = input.value.replace(/[^0-9]/g, '');
            }
            return true;
        }
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgDuAn').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        function readURLTT(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgDuAnTT').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function ftDeleteImg($id) {
            $.ajax({
                type: "POST",
                url: "",
                data: {'id': $id},
                success: function (data) {

                }
            });
        }



    </script>


@endsection