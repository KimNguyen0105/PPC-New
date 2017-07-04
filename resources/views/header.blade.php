<div class="header backgroundheader">
    <div class="container" style="text-align: center; position: relative; padding-top: 10px;">
        <div class="row">


            <div class="col-lg-4 col-md-4 col-xs-4"
                 style="position: absolute; left: 0;bottom: 0; text-align: left;font-family: verdana;">
            <span class="photro" style="display:inline;">
                <img src="{{URL::asset('')}}images/icon/30.png" style="width: 6%; margin-top: 6px;margin-bottom: 6px" id="img_icon"> (+84) 838 221 122</span><br>
                <a style="display:inline; text-decoration: none; color: black; cursor: pointer" href="javascript:void(Tawk_API.toggle())">
                    <img src="{{URL::asset('')}}images/icon/29.png" style="width: 6%" id="img_icon">
                    <span class="photro"> <b>{{trans('home.onlinesupport')}}</b></span>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-4 center-block" style="float: none">
                <img src="{{URL::asset('')}}images/logo.png" id="logo_header">
            </div>

            <div class="col-lg-4 col-md-4 col-xs-4 pull-right" style="position: absolute; right: 15px;bottom: 0; text-align: right">
                <ul class="nav navbar-nav navbar-right">
                    @if(Session::has('username'))
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"
                               style="padding: 0px 5px;color: #5b4f44;font-size: 15px;font-weight: bold">
                                <span class="fa fa-user"></span>
                                <span class="fw600"><?=$_SESSION['name']?> <span class="fa fa-caret-down"></span></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="" style="color: black">
                                        <i class="fa fa-user"></i>&nbsp;&nbsp;{Thongtin}</a>
                                </li>
                                <li style="border-top: 1px solid #eeeeee !important;">
                                    <a href="" style="color: black">
                                        <i class="fa fa-info-circle"></i>&nbsp;&nbsp;{Quanlyduan}</a>
                                </li>
                                <li style="border-top: 1px solid #eeeeee !important;">
                                    <a href="" style="color: black">
                                        <i class="fa fa-sign-out"></i>&nbsp;&nbsp;{Dangxuat} </a>
                                </li>

                            </ul>
                        </li>
                    @else
                        <li>
                            <a style="padding: 0px;text-decoration: none;color: #5b4f44;font-size: 15px;font-weight: bold" data-toggle="modal" href="#myLogin"><i class="fa fa-user"></i>&nbsp;{{trans('home.login')}}</a>
                        </li>
                    @endif

                    <li><a style="padding: 0px;margin-left: 5px " href="{{URL::asset('')}}language/en"><img src="{{URL::asset('')}}images/icon/FlagUS.jpg"></a>
                    </li>
                    <li><a style="padding: 0px;margin-left: 5px" href="{{URL::asset('')}}language/vi"><img src="{{URL::asset('')}}images/icon/vi.gif"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-default" id="menu_name" style="margin-bottom:0px;margin-top:10px;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" onclick="ftShowMenu()" data-toggle="collapse"
                        data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="container">
                <div class="collapse navbar-collapse"
                     style="width:100%;padding-right:0px;margin-left: -15px">
                    <ul class="nav navbar-nav width_menu menucell">
                        <li class="limenu menu1" style="display: table-cell;float: none">
                            <a class="menua" href="{{asset('/')}}">{{trans('home.home')}}</a>
                        </li>
                        <li class="limenu menu2" style="display: table-cell;float: none">
                            <a class="menua" href="{{asset('/ppc-project.html')}}">{{trans('home.project')}}</a>
                            <ul>
                                <li class="limenu"><a href="{{asset('/project-rent.html')}}">{{trans('home.rent')}}</a></li>
                                <li class="limenu"><a href="{{asset('/project-sale.html')}}">{{trans('home.sale')}}</a></li>
                            </ul>
                        </li>
                        <li class="limenu menu3" style="display: table-cell;float: none">
                            <a class="menua" href="{{asset('/about-ppc.html')}}">{{trans('home.about')}}</a>
                        </li>
                        <li class="limenu menu4" style="display: table-cell;float: none">
                            <a class="menua" href="{{asset('/ppc-news.html')}}">{{trans('home.news')}}</a>
                        </li>
                        <li class="limenu menu5" style="display: table-cell;float: none">
                            <a class="menua">{{trans('home.humandev')}}</a>
                            <ul>
                                <li class="limenu">
                                    <a href="{{asset('/ppc-recruitment.html')}}">{{trans('home.recruitment')}}</a>
                                    <img src="{{URL::asset('images/new.gif')}}" width="50px"/>
                                </li>
                                <li class="limenu">
                                    <a href="{{asset('/ppc-hrpolicies.html')}}">{{trans('home.hrpolicies')}}</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                        if(isset($_SESSION['name']))
                        {
                        if($_SESSION['name'] != null){
                        ?>
                        <li class="limenu menu6" style="display: table-cell;float: none">
                            <a class="menua" href="">{{trans('home.post')}}</a>
                        </li>
                        <?php } else {

                        ?>
                        <li class="limenu menu6" style="display: table-cell;float: none">
                            <a class="menua" data-toggle="modal" href="#myLogin">{{trans('home.post')}}</a>
                        </li>
                        <?php  }
                        }
                        else{ ?>
                        <li class="limenu menu6" style="display: table-cell;float: none">
                            <a class="menua" data-toggle="modal" href="#myLogin">{{trans('home.post')}}</a>
                        </li>
                        <?php }
                        ?>
                        <li class="limenu menu7" style="display: table-cell;float: none">
                            <a class="menua" href="{{asset('/ppc-contact.html')}}">{{trans('home.contact')}}</a>
                        </li>
                        </li>
                        <form class="navbar-form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="...">
                            </div>
                            <button type="submit" class="btn btn-default">{{trans('home.search')}}</button>
                        </form>
                    </ul>
                </div>
                <div id="menuMobile">
                    <div class="col-xs-12 text-center" style="padding: 10px 0px">
                        <div class="col-xs-4 paddinglr0 menu1 divmenu">
                            <a class="menua" style="color: #5b4e45" href="{{asset('/')}}">{{trans('home.home')}}</a>
                        </div>
                        <div class="col-xs-4 paddinglr0 menu2 divmenu">
                            <li class="dropdown" style="display: inline">
                                <a class="dropdown-toggle menua" data-toggle="dropdown" href="{{asset('/ppc-project.html')}}"
                                   style="padding: 0px 5px;color: #5b4f44;font-size: 15px;">
                                    {{trans('home.project')}}
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a style="color: #5b4e45" href="{{asset('/project-rent.html')}}">{{trans('home.rent')}}</a>
                                    </li>
                                    <li style="border-top: 1px solid #eeeeee !important;">
                                        <a style="color: #5b4e45" href="{{asset('/project-sale.html')}}">{{trans('home.sale')}}</a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                        <div class="col-xs-4 menu3 divmenu">
                            <a class="menua" style="color: #5b4e45" href="{{asset('/about-ppc.html')}}">{{trans('home.about')}}</a>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center" style="padding: 10px 0px">
                        <div class="col-xs-4 menu4 divmenu">
                            <a class="menua" style="color: #5b4e45" href="{{asset('/ppc-news.html')}}">{{trans('home.news')}}</a>
                        </div>
                        <div class="col-xs-4 menu5 divmenu" style="height: 50px;">
                            <li class="dropdown" style="display: inline">
                                <a class="dropdown-toggle menua" data-toggle="dropdown" href="#" style="padding: 0px 5px;color: #5b4f44;font-size: 15px;">
                                    {{trans('home.humandev')}}
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a style="color: #5b4e45" href="{{asset('/ppc-recruitment.html')}}">{{trans('home.recruitment')}}</a>
                                    </li>
                                    <li style="border-top: 1px solid #eeeeee !important;">
                                        <a style="color: #5b4e45" href="{{asset('/ppc-hrpolicies.html')}}">{{trans('home.hrpolicies')}}</a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                        <div class="col-xs-4 menu6 divmenu">
                            <?php
                            if(isset($_SESSION['name']))
                            {
                            if($_SESSION['name'] != null){
                            ?>
                            <a class="menua" style="color: #5b4e45" href="">{{trans('home.post')}}</a>

                            <?php } else {

                            ?>
                            <a class="menua" style="color: #5b4e45" data-toggle="modal"
                               href="#myLogin">{{trans('home.post')}}</a>
                            <?php  }
                            }
                            else{ ?>
                            <a class="menua" style="color: #5b4e45" data-toggle="modal"
                               href="#myLogin">{{trans('home.post')}}</a>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center" style="padding: 10px 0px">
                        <div class="col-xs-4 menu7 divmenu">
                            <a class="menua" style="color: #5b4f44" href="{{asset('/ppc-contact.html')}}">{{trans('home.contact')}}</a>
                        </div>
                        <div class="col-xs-4 menu8 divmenu" style="height: 50px;">
                            <a class="menua" style="color: #5b4f44" href="https://play.google.com/store/apps/details?id=com.perfectproperties.app.ppc_app&hl=vi"
                               target="_blank">{{trans('home.dowloadapp')}}</a>
                        </div>
                        <div class="col-xs-4 paddinglr0">
                            <li class="dropdown" style="display: inline">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"
                                   style="padding: 0px 5px;color: #5b4f44;font-size: 15px;">
                                    <span class="glyphicon glyphicon-search"></span>
                                </a>
                                <ul class="dropdown-menu" style="margin-left: -100px;padding: 0px" role="menu">
                                    <li>
                                        <form method="POST" action="">
                                            <div class="paddinglr0">
                                                <div class="col-sm-8 col-xs-9 paddinglr0">
                                                    <input type="text" name="text_search" id="text_search"
                                                           style="width: 100%; color: black">
                                                </div>
                                                <div class="col-sm-4 col-xs-3 paddinglr0">
                                                    <button type="submit" id="btn_tim" style="border-radius:0px;"><span
                                                                class="glyphicon glyphicon-search"></span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</div>

<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">


            @foreach($sliders as $slide)
                <div class="item">
                    <img src="{{URL::asset('')}}images/sliders/{{$slide->image}}" class="img-responsive slider" alt="">
                </div>
            @endforeach

        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div>

<div id="myLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            {{--{!! Form::open() !!}--}}
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{trans('home.login')}}</h4>
                </div>

                <div class="modal-body admin-form">
                    <div class="section">
                        <input type="text" name="username" id="username" class="gui-input form-control"
                               placeholder="{{trans('home.username')}}">
                        <label for="firstname" class="field-icon">
                        </label>
                    </div>
                    <div class="section">
                        <input type="password" name="password" id="password" class="gui-input form-control"
                               placeholder="{{trans('home.password')}}">
                        <label for="firstname" class="field-icon">
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="rememberme"><label
                                style="font-size: 15px; font-weight: 100">&nbsp;{{trans('home.remember')}}</label><br>
                        <a href="">{{trans('home.account')}}</a><br>
                        <a data-toggle="modal" href="#forgetpass"
                           onclick="ftResgiter()">{{trans('home.forgetpass')}}</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">{{trans('home.login')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('home.close')}}</button>
                </div>
            {{--{!! Form::close() !!}--}}
        </div>
    </div>
</div>

<div id="forgetpass" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="fromResgiter" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{laypass}</h4>
                </div>
                <div class="modal-body admin-form">
                    <div class="form-group">
                        <p>Email</p>
                        <input type="email" name="email" id="email" required class="gui-input form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">{gui}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{Dong}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="display: none">
    <input id="txtmenu" value="">
</div>
<a href="#" id="go_top" style="text-align: center"><i style="color: #fff;margin-top: 12px" class="fa fa-arrow-up"></i></a>
