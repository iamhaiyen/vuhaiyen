<?php  
	//Hàm khởi động SESSION (Do websever sinh ra)
	session_start();	
?>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
			<div class="login">
				<!-- <h2 style="text-align: center;">Đăng nhập hệ thống</h2> -->
				<?php  
				if ($_POST) {
					$database = new Libs_Model();
		            $db = $database->getConnection(); 
					$objEmp = new Admin_Models_Employee($db);

					$objEmp->emailAdmin = $_POST['txtEmail'];
					$objEmp->password = $_POST['txtPassword'];
					if ($objEmp->checkEmployee()) {
						$_SESSION['emailAdmin'] = $objEmp->emailAdmin;
						//Điều hướng tới 'index'
						?>
						<script>
				            window.location = "<?php echo URL_BASE;?>admin";
				        </script>
						<?php
					}else{
						echo "<div class='alert alert-danger'>Tài khoản không tồn tại!</div>";
					}
				}
				?>
				<div class="logo text-center" >
                    <img src="<?php echo URL_BASE;?>templates/default/img/logo.png" width="200px">
                    <hr>
                </div>              
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">                            
                    <p class="labelLogin">Email: </p>
                    <input type="email" name="txtEmail" class="form-control" 
                           placeholder="Nhập Email của bạn">
                    <p class="labelLogin">Mật khẩu: </p>
                    <input type="password" name="txtPassword" class="form-control" 
                           placeholder="Nhập mật khẩu của bạn">
                    <button type="submit" class="btn btn-danger btn-login">Đăng nhập</button>
                </form>
			</div>
		</div>
	</div>
</div>

