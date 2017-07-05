<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PPC | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="admin PPC company">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/styleadmin.css')}}">
</head>
<body background="{{asset('images/admin/000.jpg')}}">
<div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="col-md-4 col-md-offset-4" style="padding-top: 150px">
            <div class="login-logo text-center">
                <p style="font-size: 20px"><b>Admin</b>PPC</p>
            </div>


        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

            <div style="background-color: #fff; padding: 30px">
        <form action="{{url('admin/log-in')}}" method="post">
            @if(session('thatbai'))
                <div class="alert alert-danger">
                    {{session('thatbai')}}
                </div>
            @endif
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
            <div class="form-group has-feedback">
                <?php
                if (isset($_COOKIE["email"]))
                    echo '<input type="text" name="email" class="form-control" value="' . $_COOKIE["email"] . '">';
                else
                    echo '<input type="text" name="email" class="form-control" placeholder="Username">';
                ?>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?php
                if (isset($_COOKIE["pass"]))
                    echo '<input type="password" name="password" class="form-control" value="' . $_COOKIE["pass"] . '">';
                else
                    echo '<input type="password" name="password" class="form-control" placeholder="Password">';
                ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <?php
                            if (isset($_COOKIE["pass"]))
                                echo '<input type="checkbox" name="remember" id="remember" checked> Remember Me';
                            else
                                echo '<input type="checkbox" name="remember" id="remember"> Remember Me';
                            ?>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script>
    $(function() {
        $('.alert').delay(5000).show().fadeOut('slow');
    });
</script>
</body>
</html>