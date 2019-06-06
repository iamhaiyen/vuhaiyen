<content class="soSanhWatch container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12" id="result2" style="margin-top: 90px;">	
					<div class="p-watch1">
						<a href="#"><p class="left-post">SO SÁNH SẢN PHẨM</p></a>
					</div>
					<?php 
			            $count = count($_SESSION['soSanh_item']);
			            if ($count>0) {
			        ?>
					<div class="row">
						<div class="col-md-3 col-xs-3">	
							<table class="table table-responsive table-striped table-bordered">
								<thead>		
									<tr>
										<th style="border: 2px solid #aaa;">TÊN</th>
									</tr>
									<tr style="width:100%; height: 200px;">
										<th style="border: 2px solid #aaa;"></th>
									</tr>								
									<tr>
										<th style="border: 2px solid #aaa;">Xuất xứ</th>
									</tr>
									<tr>
										<th style="border: 2px solid #aaa;">Kiểu máy</th>
									</tr>
									<tr>
										<th style="border: 2px solid #aaa;">Kích cỡ</th>
									</tr>
									<tr>
										<th style="border: 2px solid #aaa;">C.Liệu vỏ</th>
									</tr>								
									<tr>
										<th style="border: 2px solid #aaa;">C.Liệu dây</th>
									</tr>
									<tr>
										<th style="border: 2px solid #aaa;">C.Liệu kính</th>
									</tr>
									<tr>
										<th style="border: 2px solid #aaa;">Chịu nước</th>
									</tr>
									<tr>
										<th style="border: 2px solid #aaa;">Bảo hành</th>
									</tr>	
								</thead>
							</table>
						</div>	
						<?php  
                            foreach ($_SESSION['soSanh_item'] as $key => $value){
                        ?>
						<div class="col-md-3 col-xs-3">	
							<table class="table table-responsive table-striped table-bordered">
								<thead>	
									<tr>
										<td>
											<b><?php echo $value['ten']; ?></b>
											<a href="<?php echo URL_BASE.'index/deleteToSoSanh/?id='. $value['ma']; ?>"><span class="glyphicon glyphicon-remove" style="color: #000;float: right;cursor: pointer;font-size: 18px;display: inline;"></span></a>   
											
										</td>
									</tr>
									<tr style="height: 200px;">
										<td style="background-color: #FFF;">
											<img src="<?php echo URL_BASE;?><?php echo $value['anh'];?>" style="width: 60%;">		
											<p class="gia-sale">$<?php echo $value['giaMoi'];?> <span class="span-sale-watch">$<?php echo $value['giaCu'];?></span></p>
										</td>
									</tr>
									<tr>
										<td><?php echo $value['xuatXu'];?></td>
									</tr>
									<tr>
										<td><?php echo $value['kieuMay'];?></td>
									</tr>
									<tr>
										<td><?php echo $value['kichCo'];?></td>
									</tr>
									<tr>
										<td><?php echo $value['chatLieuVo'];?></td>
									</tr>								
									<tr>
										<td><?php echo $value['day'];?></td>
									</tr>
									<tr>
										<td><?php echo $value['chatLieuKinh'];?></td>
									</tr>
									<tr>
										<td><?php echo $value['doChiuNuoc'];?></td>
									</tr>
									<tr>
										<td><?php echo $value['baoHanh'];?></td>
									</tr>	
									<tr>
										<td style="background-color: #FFF; border:none;">
											<a href="#" onclick="livesale('<?php echo $value['ma'];?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
										</td>
									</tr>
								</thead>
							</table>
						</div>	
						<?php } ?>
					</div>
					<?php }else{ echo "<div class='alert alert-danger'>Chưa chọn sản phẩm so sánh</div>"; } ?>					
				</div>
			</div>
		</div>
	</content>

	<style>
		@media all and (max-width: 480px) {
 			th,td{
 				width: 100%;
 				height: 60px;
 			}
		}
	</style>