<header class="main-header">

    <!-- Logo -->
    <a href="{{url('admin/')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>P</b>PC</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b> PPC</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="color: #fff">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="hidden-xs">Admin</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                {{session('user_admin')}}<small>admin@gmail.com</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Thông tin</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" data-method="post" class="btn btn-default btn-flat">Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- menu  -->

    </nav>
</header>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.dropdown').on('click', function(e) {
            $(this).toggleClass('open');
        });
    });
</script>