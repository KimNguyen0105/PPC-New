@extends('master')
@section('main')

    <!-- slider -->
    <div style="clear: both"></div>
    <div class="backgroundbody">
        <!-- PHẦN BANNER CỦA HEADER -->
        <div class="container paddingchitiet">
            <div class="text-center space" >
                <h3 class="titlewweb" style="color:#443427;" id="h2"><b>{DUAN}</b></h3>
                <hr style="border:2.5px solid #443427;width:90px;">
                <div class="col-md-12 text-left">
                    <h4 style="font-family: Verdana">{TrangChu} / <b>{DuAn}</b>
                        <?php
                        if(isset($name))
                        {
                            echo '/ '.$name;
                        }
                        ?>
                    </h4>
                </div>
            </div>


            <!-- hàng số 1 -->
            <div class="space" id="content_duan" style="padding: 0px 15px">
                <?php
                if($dataduan !=null){
                foreach ($dataduan as $row) { ?>
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
                        <div class="" style="padding-top: 10px; font-family: Verdana">
                            <?=$info?>
                        </div>
                    </div>
                    <div class="" style="padding: 0px 30px; position: absolute; right: 0;bottom: 0; text-align: right">
                        <h5 style="font-size: 17px;margin-top: 8px; float: right; font-family: Verdana"><?=$row['acreage']?> m2</h5><span style="float:right;"><img src="<?=BASE_DIR?>imgweb/home_icon.jpg" class="img-responsive"  style="width:100%;"></span>
                    </div>

                </div>
                <?php } }
                else{?>
                <h1 class="text-center">Danh sách dự án rỗng!!!</h1>
                <?php }
                ?>
            </div>


        </div>
        <?php include"view/phantrang.php" ?>
    </div>




    <!-- Modal -->




@endsection