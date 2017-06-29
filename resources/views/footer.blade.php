<div style="clear: both"></div>
<div class="container">
    <hr style="border:2.5px solid #443427;width:100%; margin-left:0px;">
    <div class="text-center">
        <div class="col-md-3 col-sm-12">
            <img src=" images/5.gif" style="width:50%;">
        </div>
        @foreach($systems as $system)
        <div class="col-md-5 col-sm-12" style="text-align: left">
            <h4 style="text-align:left; color:#342315;"><b>Perfect Property Company VietNam</b></h4>
            <hr style="border:2.5px solid #342315;margin-left:0px;width:80px; margin-top: 5px" id="hr">
            <p style="text-align: left;font-family: verdana;font-weight: 300; font-size: 12pt; color:#342315;">{{$system->company_info}}</p>
            <p style="text-align: left;font-family: verdana;font-weight: 300; font-size: 12pt; color:#342315;">Phone: +84 8 38201107</p>
            <p style="text-align: left;font-family: verdana;font-weight: 300; font-size: 12pt; color:#342315;">Hotline: 0988 084 009</p>
        </div>
        @endforeach
        {{--<div class="col-md-4 col-sm-12" style="text-align: left">--}}
            {{--<h4 style="text-align:left; color:#342315;"><b>Perfect Property Company USA</b></h4>--}}
            {{--<hr style="border:2.5px solid #342315;margin-left:0px;width:80px; margin-top: 5px" id="hr">--}}
            {{--<p style="text-align: left;font-family: verdana;font-weight: 300; font-size: 12pt; color:#342315;">42 Broadway Suit 12-233 New York, NY 10004</p>--}}
            {{--<p style="text-align: left;font-family: verdana;font-weight: 300; font-size: 12pt; color:#342315;">Phone: 917 831 0562</p>--}}
            {{--<p style="text-align: left;font-family: verdana;font-weight: 300; font-size: 12pt; color:#342315;">Email: info@perfectproperties.vn</p>--}}
        {{--</div>--}}
    </div>
</div>

<div class="container">
    <hr style="border:2.5px solid #342315;margin-left:0px;">

    <div class="iconlink text-center">
        <ul style="list-style-type:none;">
            <li style="display:inline;"><a href="#"><img src=" images/icon/social1.png"></a></li>
            <li style="display:inline;"><a href="#"><img src=" images/icon/social2.png"></a></li>
            <li style="display:inline;"><a href="#"><img src=" images/icon/social3.png"></a></li>
            <li style="display:inline;"><a href="#"><img src=" images/icon/social4.png"></a></li>
        </ul>
    </div>
    <div class="text-center" style="padding: 0 15px;">
        <p class="copyright"><b>Copyright &copy; - Perfect Property Company</b></p>
    </div>
    <br>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){

        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5897f0c22051070a0c604193/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);

    })();
</script>
<script>

    var w = screen.width;
    if(w<=768)
    {
        //$('.content-menu').removeClass('container');
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    }
    else
    {
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    }

</script>
<!--End of Tawk.to Script-->
<!--Slider Script-->
