<content class="container-fluid">
    <div class="container chitietsanpham" id="result2" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-3 col-xs-12 left-content">   
                <!-- Lọc -->
                <div class="p-watch">
                    <a href="#"><p class="left-post">LỌC THEO GIÁ</p></a>
                </div>
                <div class="form-group">
                  <select class="form-control" onchange="locTheoGia(this.value);">
                    <option value="0">-- Chọn mức giá --</option>
                    <option value="400">Từ $0 -> $400</option>
                    <option value="700">Từ $400 -> $700</option>
                    <option value="1000">Từ $700 -> $1000</option>
                  </select>
                </div> 
                <!-- <div class="btn-sosanh" style="text-align: center;">
                    <a href="#" class="btn btn-danger btn-md" style="width: 100%;font-weight: bold;margin-bottom: 20px;">Lọc</a>
                </div>   -->                
                <!-- So sánh -->
                <div class="hidden-xs">
                    <div class="p-watch">
                        <a href="<?php echo URL_BASE;?>index/soSanh"><p class="left-post" style="margin-top: 30px;">BẢNG SO SÁNH</p></a>
                    </div>
                    <div id="soSanh1" class="alert alert-success">
                        So sánh tối đa 3 sản phẩm!!!
                    </div>
                    <!-- so sánh -->                    
                    <div class="hidden-xs">
                        <div class="p-watch1">
                            <a href="#"><p class="left-post" style="margin-top: 50px;">KHUYẾN MẠI SỐC</p></a>
                        </div>
                        <?php  
                        while ($rowKhuyenMai = $this->objDongHoKhuyenMai->fetch(PDO::FETCH_ASSOC)) {
                            extract($rowKhuyenMai);  
                        ?>
                        <div class="sale-watch">
                            <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho_id;?>&th=<?php echo $thuonghieu_id;?>"><img src="<?php echo URL_BASE;?><?php echo $anh; ?>" class="img-sale-watch"/></a>
                            <div style="height: 50px;"><p class="p-sale-watch"><?php echo $ten; ?></div>
                            <p><?php echo $day; ?></p>
                            <p class="gia-sale">$<?php echo $giaMoi; ?> <span class="span-sale-watch">$<?php echo $giaCu; ?></span></p>
                            <a href="" onclick="liveSoSanh('<?php echo $ma;?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                            <a href="#" onclick="livesale('<?php echo $ma;?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div> 
            <div class="col-md-9 col-xs-12 right-content" id="locTheoGia">
                <div class="p-watch">
                    <?php  
                        $dataThuongHieu = $this->result1;
                    ?>
                    <a href="#"><p class="left-post" style="text-transform: uppercase;"><?php echo $dataThuongHieu['ten'];?></p></a>
                </div>                     
                <div class="row"> 
                    <?php  
                    while ($row = $this->objDongHo1->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);                                
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <figure class="sale-watch">
                            <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho_id;?>&th=<?php echo $thuonghieu_id;?>"><img src="<?php echo URL_BASE;?><?php echo $anh; ?>" class="img-sale-watch"/></a>
                            <p class="p-sale-watch"><b><?php echo $ten; ?></b><br><?php echo $day; ?>
                            <p class="gia-sale">$<?php echo $giaMoi; ?> <span class="span-sale-watch">$<?php echo $giaCu; ?></span></p>
                            <a href="#" onclick="liveSoSanh('<?php echo $ma;?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                            <a href="#" onclick="livesale('<?php echo $ma;?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                        </figure>
                    </div> 
                    <?php  
                    }
                    ?>
                </div> 
                 <!-- SP bán chạy -->   
            </div>
        </div>
    </div>
</content> 