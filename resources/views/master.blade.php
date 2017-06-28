<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ppc comanny real estate perfect propeties ">
    
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">



<style>
    #go_top{
        display:block;
        width:40px;
        height:40px;
        position:fixed;
        background-color:#5b4f44;
        bottom:15px;
        left:15px;
        border-radius: 50%;
        z-index: 99;
    }
</style>
</head>
<body>
@include('header');
@yield('main');
@include('footer');
</body>
</html>