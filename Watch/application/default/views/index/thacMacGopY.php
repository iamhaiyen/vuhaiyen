<?php  
    //Hàm khởi động SESSION (Do websever sinh ra)
    session_start();
?>
<?php          
    if (!isset($_SESSION['email'])) {
        ?>
        <script>
        	alert("Để gửi góp ý đến Admin xin quý khách vui lòng đăng nhập hoặc đăng ký khi chưa có tài khoản. Xin cảm ơn!");
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
		<div class="container"id="result2" style="margin-top: 90px;">
			<div class="row">
				<div class="col-md-12 col-xs-12">					
					<div class="p-watch1">
						<a href="#"><p class="left-post">GÓP Ý THẮC MẮC</p></a>
					</div>													
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p>Mọi thắc mắc và yêu cầu cần hỗ trợ từ chúng tôi, vui lòng để lại thông tin tại đây. Chúng tôi sẽ xem xét và gửi phản hồi sớm nhất.</p>
					<form class="form" action="<?php ($_SERVER['PHP_SELF']);?>" method="POST">
						<?php  
                            if (isset($_POST['gopY'])) {                             
                                $objKhachHang->gopY = $_POST['txtGopY'];
                                if ($objKhachHang->updateKhachHang()) {
                                    // echo "<div class='alert alert-success'>Cập nhật thông tin thành công.</div>";
                                    ?>
                                    <script>
                                        confirm("<?php echo "Góp ý của bạn đã được gửi cho Admin!" ?>");
                                        window.location = "<?php echo URL_BASE;?>";
                                    </script>
                                    <?php
                                }else{
                                    echo "<div class='alert alert-danger'>Góp ý của bạn chưa được gửi cho Admin!.</div>";
                                }
                            }
                        ?>
						<div class="row">
							<div class="col-md-7">
								<label class="label-GopY">Họ và tên</label>
								<input disabled type="text" name="name" class="form-control" value="<?php echo $khachHang['ten']; ?>">
							</div>
							<div class="col-md-5">
								<label class="label-GopY">Số điện thoại</label>
								<input disabled type="text" name="phone" class="form-control" value="<?php echo $khachHang['soDienThoai']; ?>">
							</div>
						</div>
						<label class="label-GopY">Ý kiến góp ý</label>
						<textarea class="form-control" name="txtGopY" rows="8" ></textarea>

						<br>
						<button class="btn btn-md btn-danger" name="gopY" type="submit">Gửi</button>	
					</form>					
				</div>
			</div>
		</div>
	</content>
<?php } ?>