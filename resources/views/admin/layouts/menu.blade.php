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
                <a href="">
                    <i class="fa fa-cubes"></i> <span>GIỚI THIỆU</span>
                    <span class="pull-right-container">
                            <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class="li1"><a href="{{url('admin/introduce-home')}}"><i class="fa fa-cubes"></i>GIỚI THIỆU</a></li>
                    <li class="li2"><a href="{{url('admin/banner')}}"><i class="fa fa-bars"></i>BANNER</a></li>
                    <li class="li2"><a href="{{url('admin/profile')}}"><i class="fa fa-file"></i>PROFILE</a></li>
                </ul>
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
                    <li class="li1"><a href="{{url('admin/property')}}"><i class="fa fa-folder-o"></i> DỰ ÁN</a></li>
                    <li class="li2"><a href="{{url('admin/project')}}"><i class="fa fa-bars"></i> DANH MỤC DỰ ÁN</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="">
                    <i class="fa fa-globe"></i> <span>QUẢN LÝ FILTER DỰ ÁN</span>
                    <span class="pull-right-container">
                            <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{url('admin/country')}}"><i class="fa fa-bolt"></i> QUỐC GIA</a></li>
                    <li class="li2"><a href="{{url('admin/province')}}"><i class="fa fa-futbol-o"></i> TỈNH</a></li>
                    <li class="li3"><a href="{{url('admin/district')}}"><i class="fa fa-cog"></i> HUYỆN</a></li>
                </ul>
            </li>
            <li class="treeview menuadmin6">
                <a href="">
                    <i class="fa fa-envelope"></i> <span>QUẢN LÝ LIÊN HỆ</span>
                    <span class="pull-right-container">
                            <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{url('admin/contact')}}"><i class="fa fa-bolt"></i> LIÊN HỆ</a></li>
                    <li class="li2"><a href="{{url('admin/contact-form/1')}}"><i class="fa fa-futbol-o"></i> LIÊN HỆ - TIN TỨC</a></li>
                    <li class="li3"><a href="{{url('admin/contact-form/0')}}"><i class="fa fa-cog"></i> LIÊN HỆ - DỰ ÁN</a></li>
                </ul>
            </li>
            <li class="treeview menuadmin6">
                <a href="{{url('admin/system-config')}}">
                    <i class="fa fa-envelope"></i> <span>SYSTEM CONFIG</span>
                </a>
            </li>
            <li class="treeview menuadmin8">
                <a href="">
                    <i class="fa fa-users"></i> <span>QUẢN TRỊ NGƯỜI DÙNG</span>
                    <span class="pull-right-container">
                            <i class="fa fa-caret-down"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    @if(session('role_admin')==0)
                        <li class="li1"><a href="{{url('admin/user')}}"><i class="fa fa-user"></i> NHÂN VIÊN</a></li>
                    @endif
                    <li class="li2"><a href="{{url('admin/user-font-end')}}"><i class="fa fa-shopping-cart"></i> NGƯỜI DÙNG</a></li>
                </ul>
            </li>
            <li class=" treeview">
                <a href="{{url('admin/log-out')}}">
                    <i class="fa   fa-sign-out"></i> <span>ĐĂNG XUẤT</span>
                    <span class="pull-right-container">
                    </span>
                </a>
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