<div class="container-fluid slider">
    <div class="row">
        <div class="col-md-12" id="slider">
            <div id="carousel-id" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php  
                    $slide=1;
                    while ($row2 = $this->objSlide->fetch(PDO::FETCH_ASSOC)) {
                        extract($row2);                                
                    ?>                    
                        <?php if ($slide==1){ ?>
                        <div class="item active">
                        <?php }else{ ?>
                        <div class="item">
                        <?php } ?>
                        <img alt="Third slide" src="<?php echo URL_BASE;?><?php echo $anh; ?>" style="width: 100%" class="imgSlide">
                    </div>
                    <?php $slide++; } ?>
                </div>
                <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span><span class="sr-only">Previous</span></a>
                <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span><span class="sr-only">Next</span></a>
            </div>
        </div>
    </div>
</div> 
<!-- End Slider -->
<div class="container_fullwidth">
            <div class="container">
               <div class="hot-products">
                  <h3 class="title"><strong>Hot</strong> Products</h3>
                  <div class="owl-carousel owl-theme DHMoiNhat">
                        <?php while ($row = $this->objDongHoMoiNhat->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);   ?>
                        <div class="item sale-watch">
                            <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho_id;?>&th=<?php echo $thuonghieu_id;?>"><img style="width: 80%;margin-left: 10%" src="<?php echo URL_BASE;?><?php echo $anh; ?>" class="img-sale-watch"/></a>
                                <div style="height: 50px;"><p class="p-sale-watch"><?php echo $ten; ?></div>
                                <p><?php echo $day; ?></p>
                                <p class="gia-sale">$<?php echo $giaMoi; ?> <span class="span-sale-watch">$<?php echo $giaCu; ?></span></p>
                                <a href="#" onclick="liveSoSanh('<?php echo $ma;?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                                <a href="#" onclick="livesale('<?php echo $ma;?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                        </div>
                    <?php } ?>
                    </div>
               </div>
               <div class="clearfix"></div>
               <div class="featured-products">
                  <h3 class="title"><strong>Featured </strong> Products</h3>
                  <div class="owl-carousel owl-theme">
                        <?php while ($row = $this->objDongHoGiaRe->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);   ?>
                        <div class="item sale-watch text-center">
                            <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho_id;?>&th=<?php echo $thuonghieu_id;?>"><img style="width: 80%;margin-left: 10%" src="<?php echo URL_BASE;?><?php echo $anh; ?>" class="img-sale-watch"/></a>
                            <div style="height: 50px;"><p class="p-sale-watch"><?php echo $ten; ?></div>
                            <p><?php echo $day; ?></p>
                            <p class="gia-sale">$<?php echo $giaMoi; ?> <span class="span-sale-watch">$<?php echo $giaCu; ?></span></p>
                            <a href="#" onclick="liveSoSanh('<?php echo $ma;?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                            <a href="#" onclick="livesale('<?php echo $ma;?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                        </div>
                    <?php } ?>
                    </div>
               </div>
               <div class="clearfix"></div>
               <div class="our-brand">
                  <h3 class="title"><strong>Our </strong> Brands</h3>
                  <div class="owl-carousel owl-theme">
                        <?php while ($row = $this->objDongHoKhuyenMai->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);   ?>
                        <div class="item sale-watch text-center">
                            <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho_id;?>&th=<?php echo $thuonghieu_id;?>"><img style="width: 80%;margin-left: 10%" src="<?php echo URL_BASE;?><?php echo $anh; ?>" class="img-sale-watch"/></a>
                            <div style="height: 50px;"><p class="p-sale-watch"><?php echo $ten; ?></div>
                            <p><?php echo $day; ?></p>
                            <p class="gia-sale">$<?php echo $giaMoi; ?> <span class="span-sale-watch">$<?php echo $giaCu; ?></span></p>
                            <a href="#" onclick="liveSoSanh('<?php echo $ma;?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                            <a href="#" onclick="livesale('<?php echo $ma;?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                        </div>
                    <?php } ?>
                    </div>
               </div>
            </div>
         </div>

<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    })
    $('.DHMoiNhat').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    })
    $('.DHNoiBat').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    })
</script>