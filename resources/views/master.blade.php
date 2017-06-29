<!DOCTYPE html>
<html>
<head>
    <title>Perfect property company - PPC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ppc comanny real estate,perfect propeties, Perfect property company, PPC, Công ty bất động sản PPC">
    
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick-theme.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/slick.min.js')}}"></script>

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script>
    
    function ftResgiter() {
        $('#myLogin').modal('hide');
    };
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgF').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };
    function ftShowMenu() {
        $("#menuMobile").toggle();
    };
</script>
<script type="text/javascript">
	(function ($) {
	$(document).ready(function () {
	   $('.carousel-inner .item:first').addClass('active');
	   $('.carousel .item img').addClass("img-responsive");

	});
	})(jQuery);

	var $ = jQuery.noConflict();

	$(document).ready(function () {
	$('#myCarousel').carousel({
	   interval: 5000,
	   cycle: true
	});
	});
</script>










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
@include('header')
@yield('main')
@include('footer')
</body>
</html>