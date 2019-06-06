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
                    <div class="hidden-xs">
                    <div class="p-watch1">
                        <a href="#"><p class="left-post" style="margin-top: 30px;">ĐỌC TRUYỆN CƯỜI</p></a>
                    </div>
                    <iframe frameborder="1" width="100%" src="http://www.luudiachiweb.com/truyencuoi.htm" height="258"></iframe>
                 </div>
                </div>
            </div> 
            <div class="col-md-9 col-xs-12 right-content" id="locTheoGia">					
                <div class="p-watch">
					<a href="#"><p class="left-post">Chi tiết sản phẩm</p></a>
				</div>
				<?php 
				$dataDongHo = $this->result; 
                $dataThuongHieu = $this->result1;
				?>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Trigger/Open The Modal -->
                        <div id="myBtn" onclick="modalbtn();">
                        	<?php 
		                    if($dataDongHo['anh']!="")
		                    { ?>
		                        <img src="<?php echo URL_BASE;?><?php echo $dataDongHo['anh']; ?>" class="anhto" style="width: 70%;margin-left: 15%"/>
		                    <?php
		                    }else{
		                        echo "Không có ảnh.";
		                    }
		                    ?>
                        </div>
                        <!-- Trigger the modal with a button -->
                        <div id="tapanhnho" style="margin: 5px 0px;text-align: center;">
                            <?php 
		                    if($dataDongHo['anh']!="")
		                    { ?>
		                        <img src="<?php echo URL_BASE;?><?php echo $dataDongHo['anh']; ?>" class="anhnho anhnho1" onclick="showAnhTo(1)"/>
		                    <?php
		                    }else{
		                        echo "Không có ảnh.";
		                    }
		                    ?>
                            <?php
                            $imgArr = explode(";", $dataDongHo['anhPhu']); 
                            for($i=0; $i<count($imgArr); $i++){ ?>
                                <img src="<?php echo URL_BASE;?>templates/admin/uploads/DetailWatch/<?php echo $imgArr[$i]; ?>" class="anhnho anhnho<?php echo ($i+2);?>" onclick="showAnhTo(<?php echo ($i+2);?>)">
                            <?php 
                            } 
                            ?>
                        </div>
                        <div id="myModal" class="modal">
                          <!-- Modal content -->
                          <div class="modal-content clearfix" 
                          	style= "background-color: #fefefe;
								    margin: auto;
								    padding: 20px;
								    border: 1px solid #888;
								    width: 80%;">
                            <span class="close" onclick="modalspan();">&times;</span>
                            <div style="float: left;position: relative;">
                                <img src="<?php echo URL_BASE;?><?php echo $dataDongHo['anh']; ?>" class="anhto" id="anhtomodal">   
                            </div>
                            <div style="position: relative;float: left; margin-top: 10px;">
                                <!-- <img src="img/watch/watches_1.png" class="anhnho anhnho1" onclick="showAnhToModal(1)" > -->
                                <?php 
			                    if($dataDongHo['anh']!="")
			                    { ?>
			                        <img src="<?php echo URL_BASE;?><?php echo $dataDongHo['anh']; ?>" class="anhnho anhnho1" onclick="showAnhToModal(1)"/>
			                    <?php
			                    }else{
			                        echo "Không có ảnh.";
			                    }
			                    ?>
                                <?php
                                $imgArr = explode(";", $dataDongHo['anhPhu']); 
                                for($i=0; $i<count($imgArr); $i++){ ?>
                                    <img src="<?php echo URL_BASE;?>templates/admin/uploads/DetailWatch/<?php echo $imgArr[$i]; ?>" class="anhnho anhnho<?php echo ($i+2);?>" onclick="showAnhToModal(<?php echo ($i+2);?>)">
                                <?php 
                                } 
                                ?>                                   
                            </div>                                                       
                            <div style="position: relative;float: right; margin: 10px 10px 0 0;">
                                <a class="btn btn-danger btn-md" onclick="zoomin()" id="zoomin">
                                  <span class="glyphicon glyphicon-zoom-in"></span> Phóng to
                                </a>
                                <a class="btn btn-danger btn-md" onclick="zoomout()" id="zoomout">
                                  <span class="glyphicon glyphicon-zoom-out"></span> Thu nhỏ
                                </a>                                                            
                            </div>
                          </div>
                        </div>                                                      
                    </div>
                    <div class="col-md-6">
                        <h3 style="font-weight: bold;"><?php echo $dataDongHo['ten'];?></h3>
                        <p><?php echo $dataDongHo['day']; ?></p>
                        <strike class="span-sale-watch" style="font-weight: 700; font-size: 20px;">Giá gốc: $<?php echo $dataDongHo['giaCu'];?></strike>
                        <p class="gia-sale" style="font-weight: 700; color: red; font-size: 20px;">Giá sale: $<?php echo $dataDongHo['giaMoi'];?></p>
                        <span style="font-weight: bold;">Chất liệu vỏ: </span><?php echo $dataDongHo['chatLieuVo'];?><br>
                        <span style="font-weight: bold;">Xuất xứ: </span><?php echo $dataDongHo['xuatXu'];?><br>
                        <span style="font-weight: bold;">Bảo hành: </span><?php echo $dataDongHo['baoHanh'];?>
                        <p>
                            <?php echo $dataDongHo['moTa'];?>
                        </p>                                  
                        <a href="#" onclick="liveSoSanh('<?php echo $dataDongHo['ma'];;?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                        <a href="#" onclick="livesale('<?php echo $dataDongHo['ma'];;?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>     
                    </div>
                </div>
				<hr>
                <div id="main">
				    <div class="group-tabs">
				      <!-- Nav tabs -->
				      <ul class="nav nav-tabs" role="tablist">
				        <li role="presentation" class="active"><a href="#moTaSP" aria-controls="moTaSP" role="tab" data-toggle="tab" style="color: black; font-weight: bold;">Mô tả sản phẩm</a></li>
				        <li role="presentation"><a href="#chiTietSP" aria-controls="chiTietSP" role="tab" data-toggle="tab" style="color: black; font-weight: bold;">Thông số chi tiết</a></li>
				      </ul>
				      <!-- Tab panes -->
				      <div class="tab-content" style="text-align: justify;">
				        <div role="tabpanel" class="tab-pane active" id="moTaSP">
                        <br>				        	
				        	<?php echo $dataDongHo['baiViet'];?>                            
				        </div>
				        <div role="tabpanel" class="tab-pane" id="chiTietSP">
				        	<div style="text-align: center; margin-top: 20px;">
				        		<a href="#">
				        			<!-- <img src="img/watch/watches_1.png" class="img-sale-watch"> -->
									<?php 
				                    if($dataDongHo['anh']!="")
				                    { ?>
				                        <img src="<?php echo URL_BASE;?><?php echo $dataDongHo['anh']; ?>" style="width: 125px;"/>
				                    <?php
				                    }else{
				                        echo "Không có ảnh.";
				                    }
				                    ?>		
				        		</a>
								<p class="p-sale-watch"><?php echo $dataDongHo['ten'];?><br><?php echo $dataDongHo['day'];?></p>
				        	</div>
				        	<table class="table table-responsive table-striped">
								<thead>
									<tr>
										<th>Thương hiệu</th>										
                                        <td><?php echo $dataThuongHieu['ten'];?></td>
									</tr>
									<tr>
										<th>Xuất xứ</th>
										<td><?php echo $dataDongHo['xuatXu'];?></td>
									</tr>
									<tr>
										<th>Kiểu máy</th>
										<td><?php echo $dataDongHo['kieuMay'];?></td>
									</tr>
									<tr>
										<th>Kích cỡ</th>
										<td><?php echo $dataDongHo['kichCo'];?></td>
									</tr>
									<tr>
										<th>Chất liệu vỏ</th>
										<td><?php echo $dataDongHo['chatLieuVo'];?></td>
									</tr>	
									<tr>
										<th>Chất liệu kính</th>
										<td><?php echo $dataDongHo['chatLieuKinh'];?></td>
									</tr>
									<tr>
										<th>Độ chịu nước</th>
										<td><?php echo $dataDongHo['doChiuNuoc'];?></td>
									</tr>
									<tr>
										<th>Bảo hành</th>
										<td><?php echo $dataDongHo['baoHanh'];?></td>
									</tr>	
								</thead>
							</table>	
				        </div>
				      </div>
				    </div>
				</div>					
			</div>
        </div>
    </div>
</content>   