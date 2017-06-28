<div style="clear:both;"></div>
<div class="backgroundbody">
    <div class="container paddingchitiet">
        <div class="text-center">
            <h3 class="titlewweb"><b>{Duangiaodich}</b></h3>
            <hr style="border:2.5px solid #443427;width:80px;">
        </div>
        <div class="space" style="padding: 0px 15px">
            <?php
            if($dataduan!= null){
            foreach ($dataduan as $row){ ?>
            <div class="col-md-12 contentduan" style="margin-bottom: 10px;position: relative">
                <div class="col-md-4" style="padding: 0px">
                    <a href="<?=BASE_DIR.$_SESSION['lang']?>/controllerduan/chitietduan/<?=$row['id']?>">
                        <img src="<?=BASE_DIR?>img/<?=$row['image']?>" class="img-responsive img_body"  style="width:100%;">
                    </a>
                </div>
                <?php
                $dem =mb_strlen(strip_tags($row['info']));
                $info = strip_tags($row['info']);
                if($dem > 300)
                {
                    $info = mb_substr($info,0,300).'...';
                }
                ?>
                <div class="col-md-8" style="padding-top: 10px">
                    <a href="<?=BASE_DIR.$_SESSION['lang']?>/controllerduan/chitietduan/<?=$row['id']?>"><h4 style="text-align:left;font-size: 17px;font-family: verdana;"><b><?=mb_strtoupper($row['title'])?></b></h4></a>
                    <h5 style="text-align:left; font-size: 16px;font-family: verdana;"> <?=$row['address']?></h5>
                    <div style="padding-top: 10px; font-family: Verdana">
                        <?=$info?>
                    </div>
                </div>
                <div class="" style="padding: 0px 30px; position: absolute; right: 0;bottom: 0; text-align: right">
                    <h5 style="font-size: 17px;margin-top: 8px; float: right; font-family: Verdana"><?=$row['acreage']?> m2</h5><span style="float:right;"><img src="<?=BASE_DIR?>imgweb/home_icon.jpg" class="img-responsive"  style="width:100%;"></span>
                </div>

            </div>

            <?php } }
            ?>
        </div>
        <?php
        include "phantrang.php";
        ?>
    </div>
</div>

<div class="backgroundphimtulieu">
    <!-- <img src="img/bg_img.jpg" id="img_ban"> -->
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-8 text-left" id="cot_so">
                <h3 style="color:#3f3024;margin-left:-10px"><b>{phimtulieu}</b></h3>
                <hr style="border:2.5px solid #3f3024;margin-left:-10px;width:20%;">
                <div class="row text-center space divvideo">
                    <div class="col-md-12 col-sm-12 text-center" style="padding:0px 5px;">
                        <?php if(count($datavideo)!=0){ ?>
                        <iframe id="main_video" width="100%" style="border:0px" src="<?=$datavideo[0]['url']?>"></iframe>
                        <?php } ?>

                    </div>
                    <div id="pagingbody">
                        <div id="rowbody" style="padding-left: 0px"></div>
                        <div class="clr"></div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="goPrevious glyphicon glyphicon-triangle-left"></div>
                        <div class="goNext glyphicon glyphicon-triangle-right"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-left" id="cot_so">
                <h3 style="color:#3f3024;"><b>{tinmoinhat}</b></h3>
                <hr style="border:2.5px solid #3f3024;margin-left:0px;width:40%;">
                <div class="space" id="divtintuc" style="background-color:white;opacity:0.9;padding: 5px 0px">
                    <?php
                    if($datatintuc !=null){
                    foreach ($datatintuc as $row){ ?>
                    <div class="col-md-12 tintucmoi">
                        <?php
                        //                        $dem = mb_strlen($row['title']);
                        $title = ucwords($row['title']);
                        $count=str_word_count($title);
                        $dem=mb_strlen($title);
                        $result=mb_strtolower($title);
                        if($dem >30)
                        {
                            $result=mb_substr($result,0,30,'UTF-8').'...';
                        }
                        ?>
                        <a href="<?=BASE_DIR.$_SESSION['lang']?>/controllertintuc/chitiettintuc/<?=$row['id']?>" class="texttintuc" style="color: #3f3024;font-size: 16px" title="<?=$row['title']?>"><?=ucfirst($result)?></a>
                    </div>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<script>

    (function ($) {
        $.fn.zPaging = function (options) {


            //=============================================
            //Cac gia mac cua options
            //=============================================
            var defaults = {
                "rows": "#rowbody",
                "pages": "#pages",
                "items": 4,
                "height": 27,
                "currentPage": 1,
                "total": 0,
                "btnPrevious": ".goPrevious",
                "btnNext": ".goNext",
                "txtCurrentPage": "#currentPage",
                "pageInfo": ".pageInfo"
            };
            options = $.extend(defaults, options);
            //=============================================
            //Cac bien se su dung trong Plugin
            //=============================================
            var rows = $(options.rows);
            var pages = $(options.pages);
            var btnPrevious = $(options.btnPrevious);
            var btnNext = $(options.btnNext);
            var txtCurrentPage = $(options.txtCurrentPage);
            var lblPageInfo = $(options.pageInfo);

            var aRows = '';

            //=============================================
            //Khoi tao cac ham can thi khi Plugin duoc su dung
            //=============================================
            init();
            setRowsHeight();

            //=============================================
            //Ham khoi dong
            //=============================================
            function init() {

                //Lay tong so trang
                $.ajax({
                    url: "<?=BASE_DIR.$_SESSION['lang']?>/controller/laySoLuongVideo",
                    type: "GET",
                    dataType: "json"
                }).done(function (data) {
                    options.total = data.total;
                    loadData(options.currentPage);
                });

                //Gan su kien vao cho btnPrevious - btnNext - txtCurrentPage
                setCurrentPage(options.currentPage);

                btnPrevious.on("click", function (e) {
                    goPrevious();
                    e.stopImmediatePropagation();
                });

                btnNext.on("click", function (e) {
                    goNext();
                    e.stopImmediatePropagation();
                });

                txtCurrentPage.on("keyup", function (e) {

                    if (e.keyCode == 13) {
                        var currentPageValue = parseInt($(this).val());
                        console.log(currentPageValue);
                        if (isNaN(currentPageValue) || currentPageValue <= 0
                            || currentPageValue > options.total) {
                            alert("Gia tri nhap vao khong phu hop");
                        } else {
                            loadData(currentPageValue);
                            options.currentPage = currentPageValue;
                            pageInfo();
                        }
                    }

                });


            }

            //=============================================
            //Ham xu ly khi nhan vao nut btnPrevious
            //=============================================
            function goPrevious() {
                //console.log("goPrevious: " + options.currentPage);
                if (options.currentPage != 1) {
                    var p = options.currentPage - 1;
                    loadData(p);
                    setCurrentPage(p);
                    options.currentPage = p;
                    pageInfo();
                }
            }

            //=============================================
            //Ham xu ly khi nhan vao nut btnNext
            //=============================================
            function goNext() {
                //console.log("goNext: " + options.currentPage);
                if (options.currentPage != options.total) {
                    var p = options.currentPage + 1;
                    loadData(p);
                    setCurrentPage(p);
                    options.currentPage = p;
                    pageInfo();
                }
            }

            //=============================================
            //Ham xu ly gan gia tri vao
            //trong o textbox currentPage
            //=============================================
            function setCurrentPage(value) {
                txtCurrentPage.val(value);
            }

            //=============================================
            //Ham hien thi thong tin phan trang
            //=============================================
            function pageInfo() {
                lblPageInfo.text("Page " + options.currentPage + " of " + options.total);
            }

            //=============================================
            //Thiet lap chieu cao cho ul#rows
            //=============================================
            function setRowsHeight() {
                var ulHeight = (options.items * options.height) + "px";
                rows.css("height", ulHeight);
            }

            //=============================================
            //Ham load cac thong trong database va dua vao #row
            //=============================================
            function loadData(page) {
                //console.log("loadData");
                $.ajax({
                    url: "<?=BASE_DIR.$_SESSION['lang']?>/controller/layDanhSachVideo",
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    data: {
                        "items": options.items,
                        "currentPage": page
                    }

                }).done(function (data) {
                    //console.log(data);
                    if (data.length > 0) {
                        rows.empty();

                        $.each(data, function (i, val) {
                            var str = '<div class="col-md-3 col-sm-3 col-xs-6" style="padding: 5px">' +
                                '<a id="linkdata" data-value="' + val.url + '">' +
                                '<img src="https://img.youtube.com/vi/' + val.thumb + '/0.jpg" style="width:100%;"></a>' +
                                '</div>';
                            rows.append(str);
                        });

                        //console.log(rows);
                    }

                });

            }
            var heightvideo = $(".divvideo").height();
            heightvideo=heightvideo+ 121+'px';
            console.log(heightvideo);
            var width=$(window).width();
            if(width>991)
            {

                document.getElementById("divtintuc").style.height=heightvideo;
            }
            else {
                document.getElementById("divtintuc").style.height='auto';
            }
        }

    })(jQuery);

    $(document).ready(function (e) {
        var obj = {'items': 2};
        $("#pagingbody").zPaging(obj);
        $(document).on("click", '#linkdata', function (e) {
            e.preventDefault();
            data = $(this).data("value");
            $('#main_video').attr('src', data);
            e.preventDefault();
        });
//        var heightvideo = $(".divvideo").height();
//        heightvideo=heightvideo+'px';
//        console.log(heightvideo);
//        var width=$(window).width();
//        if(width>991)
//        {
//
//            document.getElementById("divtintuc").style.height=heightvideo;
//        }
//        else {
//            document.getElementById("divtintuc").style.height='auto';
//        }
        $(window).resize(function() {
            var width=$(window).width();
            var heightvideo = $(".divvideo").height();
            heightvideo=heightvideo+'px';
            if(width>991)
            {
                document.getElementById("divtintuc").style.height=heightvideo;
            }
            else {
                document.getElementById("divtintuc").style.height='auto';
            }
        });
    });

</script>