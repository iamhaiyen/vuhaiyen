<?php  
    //Hàm khởi động SESSION (Do websever sinh ra)
    session_start();
?>
<?php          
    if (!isset($_SESSION['email'])) {
        ?>
        <script>
        	confirm("Để mua hàng xin quý khách vui lòng đăng nhập hoặc đăng ký khi chưa có tài khoản. Xin cảm ơn!");
            window.location = "<?php echo URL_BASE;?>";
        </script>
    <?php
    }else{
        $database = new Libs_Model();
        $db = $database->getConnection(); 
        $objKhachHang = new Default_Models_KhachHang($db);
        $objKhachHang->email = $_SESSION['email'];
        $khachHang = $objKhachHang->getKhachHangByInfo();
        ?>
	<content class="soSanhWatch container-fluid">
		<div class="container" id="result2" style="margin-top: 90px;">
			<div class="row">
				<div class="col-md-12 col-xs-12">					
					<div class="p-watch1">
						<a href="#"><p class="left-post">THANH TOÁN ĐƠN HÀNG</p></a>
					</div>													
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">		
					<h3>*/ Các sản phẩm chọn mua</h3>
					<table class="table table-bordered table-responsive">
						<style type="text/css">
                            th{
                                text-align: center;
                            }
                        </style>
						<tr>
							<th class="col-md-3">Tên</th>
							<th class="col-md-3">Ảnh</th>
							<th class="col-md-2">Số lượng</th>
							<th class="col-md-2">Đơn giá</th>
							<th class="col-md-2">Thành tiền</th>
						</tr>
						<?php  
                            $total=0;
                            foreach ($_SESSION['cart_item'] as $key => $value){
                        ?>
						<tr>
							<td class="col-md-3"><?php echo $value['ten']; ?></td>
							<td class="col-md-3"><img src="<?php echo URL_BASE;?><?php echo $value['anh'];?>" style="width: 40px;"></td>
							<td class="col-md-2"><?php echo $value['quantity']; ?></td>
							<td class="col-md-2"><?php echo $value['giaMoi'] ?></td>
							<td class="col-md-2"><?php echo ($value['giaMoi']*$value['quantity']); ?></td>
						</tr>	

						<?php  
						$database = new Libs_Model();
		        		$db = $database->getConnection(); 
						if (isset($_POST['datHang'])) {

	    					$objDonHang = new Default_Models_Donhang($db);

	    					$objDonHang->dongho_id = $value['dongho_id'];
	    					$objDonHang->khachhang_id = $khachHang['khachhang_id'];
	    					$objDonHang->soLuong = $value['quantity'];
	    					$objDonHang->thanhTien = $value['giaMoi']*$value['quantity'];

	    					if ($objDonHang->addDonHang()) {
	    						?>
                                <script>
                                    alert("<?php echo "Bạn đã đặt hàng thành công!" ?>");
                                    function datHang(){
                                    	<?php unset($_SESSION['cart_item']); ?>
                                    }
                                    window.location = "<?php echo URL_BASE;?>";
                                </script>
                                <?php
	    					}
						}
						?>

						<?php
                        $total+=$value['giaMoi']*$value['quantity'];
                        }
                    ?>					
					</table>
					<p style="font-size: 18px;float: right;"><b>Tổng tiền: </b><span><i><b>$<?php echo $total; ?></b></i></span></p>
					<br>
				</div>

				<div class="col-md-6">
					<h3>*/ Thông tin người mua</h3>									
					<form>
						<label> Họ tên</label>
						<input disabled type="text" name="name" class="form-control" value="<?php echo $khachHang['ten'];?>">
						<label> Số điện thoại</label>
						<input disabled type="text" name="phone" class="form-control" value="<?php echo $khachHang['soDienThoai'];?>">
						<label> Địa chỉ nhận hàng</label>
						<input disabled type="text" name="phone" class="form-control" value="<?php echo $khachHang['diaChi'];?>">
					</form>		
					<p style="margin-top: 10px;color: green;">*Khách hàng muốn thêm hoặc sửa đổi thông tin. Vui lòng truy cập trang Quản lý tài khoản</p>			
				</div>	


				<div class="col-md-6">
					<h3>*/ Hình thức thanh toán</h3>
					<label><input type="radio" name="optradio" checked>Thanh toán bằng tiền mặt khi nhận hàng</label>
					<br>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
					<div>	
						<button type="submit" name="datHang" class="btn btn-danger" onclick="datHang()">Đặt hàng</button>
					</div>	
					</form>	
				</div>
			</div>
		</div>
	</content>
<?php } ?>