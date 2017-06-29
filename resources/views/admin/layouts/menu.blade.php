<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" id="Tabmenu">
            <li class="header" style="color: #fff;">QUẢN LÝ TRANG ADMIN</li>
            <!-- QUẢN LÝ TRANG CHỦ -->
            <li class="treeview">
                <a href="">
                    <i class="fa fa-home"></i> <span>TRANG CHỦ</span>
                    <span class="pull-right-container">
                        <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="li1"><a href="{{url('admin/video-home')}}"><i class="fa fa-video-camera"></i>VIDEO TRANG CHỦ</a></li>
                    <li class="li2"><a href="{{url('admin/slide')}}"><i class="fa fa-image"></i>SLIDE</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{url('admin/introduce-home')}}">
                    <i class="fa fa-cubes"></i> <span>GIỚI THIỆU</span>
                </a>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-newspaper-o"></i> <span>TIN TỨC - SỰ KIỆN</span>
                    <span class="pull-right-container">
                            <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="li2"><a href="{{url('admin/category-home')}}"><i class="fa fa-bars"></i> DANH MỤC TIN TỨC</a></li>
                    <li class="li1"><a href="{{url('admin/news-home')}}"><i class="fa fa-newspaper-o"></i> TIN TỨC</a></li>

                    <li class="li3"><a href="{{url('admin/news-gallery-home')}}"><i class="fa fa-image"></i> THƯ VIỆN HÌNH ẢNH</a></li>
                    <li class="li4"><a href="{{url('admin/gallery-video')}}"><i class="fa fa-video-camera"></i> THƯ VIỆN VIDEO</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{url('admin/recruitment')}}">
                    <i class="fa fa-briefcase"></i> <span>QUẢN LÝ TUYỂN DỤNG</span>
                </a>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-briefcase"></i> <span>CHÍNH SÁCH NHÂN SỰ</span>
                    <span class="pull-right-container">
                            <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="li2"><a href="{{url('admin/term')}}"><i class="fa fa-book"></i>DANH MỤC</a></li>
                    <li class="li2"><a href="{{url('admin/partners')}}"><i class="fa fa-user"></i>ĐỐI TÁC</a></li>
                </ul>
            </li>
            <li class="treeview menuadmin5">
                <a href="">
                    <i class="fa fa-suitcase"></i> <span>QUẢN LÝ DỰ ÁN</span>
                    <span class="pull-right-container">
                            <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="li1"><a href=""><i class="fa fa-folder-o"></i> DỰ ÁN</a></li>
                    <li class="li2"><a href=""><i class="fa fa-bars"></i> DANH MỤC DỰ ÁN</a></li>
                </ul>
            </li>
            <li class="treeview menuadmin6">
                <a href="">
                    <i class="fa fa-envelope"></i> <span>QUẢN LÝ LIÊN HỆ</span>
                </a>
            </li>
            <li class="treeview menuadmin6">
                <a href="{{url('admin/system-config')}}">
                    <i class="fa fa-envelope"></i> <span>SYSTEM CONFIG</span>
                </a>
            </li>

            <li class="treeview">
                <a href="">
                    <i class="fa fa-globe"></i> <span>QUẢN LÝ FILTER DỰ ÁN</span>
                    <span class="pull-right-container">
                            <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href=""><i class="fa fa-bolt"></i> QUỐC GIA</a></li>
                    <li class="li2"><a href=""><i class="fa fa-futbol-o"></i> TỈNH</a></li>
                    <li class="li3"><a href=""><i class="fa fa-cog"></i> HUYỆN</a></li>
                </ul>
            </li>

        </ul>

    </section>
    <!-- /.sidebar -->
</aside>
<script>
    $('#Tabmenu li a').on('click', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#Tabmenu li').removeClass('active');
        $('#Tabmenu li a[href="' + activeTab + '"]').parents('li').addClass('active');
    }
</script>