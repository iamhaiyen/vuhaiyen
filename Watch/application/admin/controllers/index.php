<?php  
class Admin_Controllers_Index extends Libs_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->view->render("index/index");
	}
	
	public function login(){
		$this->view->render("login");
	}
	public function logout(){
		$this->view->render("logout");
	}

	public function dongho(){
		$database = new Libs_Model();
		$db = $database->getConnection();
		$dongho = new Admin_Models_Dongho($db);
		if ($dongho->getAllDongHo() != NULL) {
			$this->view->objDongHo = $dongho->getAllDongHo();
			$this->view->render("index/dongho");
		}else{
			$this->view->render("index/error");
		}		
	}	
	public function detail(){
		$database = new Libs_Model();
		$db = $database->getConnection();
		$dongho = new Admin_Models_Dongho($db);
		$dongho->dongho_id = isset($_GET['id']) ? $_GET['id'] : "";
        $thuonghieu = new Admin_Models_ThuongHieu($db);
        $thuonghieu->thuonghieu_id = isset($_GET['th']) ? $_GET['th'] : "";
        $this->view->result = $dongho->getDongHoById();
        $this->view->result1 = $thuonghieu->getThuongHieuById();
		$this->view->render("dongho/detail");
	}
	public function add(){
		$this->view->render("dongho/add");
	}
	public function update(){
		$this->view->render("dongho/update");
	}
	public function delete(){
		$this->view->render("dongho/delete");
	}

	public function donhang(){
		$database = new Libs_Model();
		$db = $database->getConnection();
		$donhang = new Admin_Models_Donhang($db);
		if ($donhang->getAllDonHang() != NULL) {
			$this->view->objDonHang = $donhang->getAllDonHang();
			$this->view->render("index/donhang");
		}else{
			$this->view->render("index/error");
		}		
	}
	public function deleteDonHang(){
		$this->view->render("donhang/deleteDonHang");
	}
	public function trangThaiDonHang(){
		$this->view->render("donhang/trangThaiDonHang");
	}

	public function khachhang(){
		$database = new Libs_Model();
		$db = $database->getConnection();
		$khachhang = new Admin_Models_Khachhang($db);
		if ($khachhang->getAllKhachHang() != NULL) {
			$this->view->objKhachHang = $khachhang->getAllKhachHang();
			$this->view->render("index/khachhang");
		}else{
			$this->view->render("index/error");
		}
	}
	public function gopYKH(){
		$database = new Libs_Model();
		$db = $database->getConnection();
		$khachhang = new Admin_Models_Khachhang($db);
		$khachhang->khachhang_id = isset($_GET['id']) ? $_GET['id'] : "";
        $this->view->result = $khachhang->getKhachHangById();
		$this->view->render("khachhang/gopYKH");
	}
	public function addKH(){
		$this->view->render("khachhang/addKH");
	}
	public function updateKH(){
		$this->view->render("khachhang/updateKH");
	}
	public function deleteKH(){
		$this->view->render("khachhang/deleteKH");
	}

	public function thuonghieu(){
		$database = new Libs_Model();
		$db = $database->getConnection();
		$thuonghieu = new Admin_Models_ThuongHieu($db);
		if ($thuonghieu->getAllThuongHieu() != NULL) {
			$this->view->objThuongHieu = $thuonghieu->getAllThuongHieu();
			$this->view->render("index/thuonghieu");
		}else{
			$this->view->render("index/error");
		}
	}
	public function addTH(){
		$this->view->render("thuonghieu/addTH");
	}
	public function updateTH(){
		$this->view->render("thuonghieu/updateTH");
	}
	public function deleteTH(){
		$this->view->render("thuonghieu/deleteTH");
	}

	public function slide(){
		$database = new Libs_Model();
		$db = $database->getConnection();
		$slide = new Admin_Models_Slide($db);
		if ($slide->getAllSlide() != NULL) {
			$this->view->objSlide = $slide->getAllSlide();
			$this->view->render("index/slide");
		}else{
			$this->view->render("index/error");
		}
	}
	public function addSlide(){
		$this->view->render("slide/addSlide");
	}
	public function deleteSlide(){
		$this->view->render("slide/deleteSlide");
	}

	public function search(){
	    $ten = isset($_REQUEST['ten']) ? $_REQUEST['ten'] : "";
		    if ($ten != "") {
		        $con = new PDO("mysql:host=localhost;dbname=watch;charset=UTF8","root","");
		        $query = "SELECT * FROM dongho WHERE ten LIKE '%".$ten."%'";
		        $stmt = $con->prepare($query);
		        $stmt->execute();
		        //Biểu diễn dữ liệu
		    }
		?>		 
		<table class="table table-bordered table-responsive table-hover text-center">
		    <thead bac>
		        <th class="text-center">ID</th>
		        <th class="text-center">Tên</th>
		        <th class="text-center">Xuất xứ</th>
		        <th class="text-center">Thương hiệu</th>
		        <th class="text-center">Dây</th>
		        <th class="text-center">Giá cũ</th>
		        <th class="text-center">Giá mới</th>
		        <th class="text-center">Bảo hành</th>
		        <th class="text-center">Chức năng</th>
		    </thead>
		    <?php  
		    if($dongho = $stmt->fetch(PDO::FETCH_ASSOC) != ""){
                ?>
                <?php
                $stmt->execute();
		    while ($dongho = $stmt->fetch(PDO::FETCH_ASSOC)) {      
		    $idD=$dongho['dongho_id'];              
		    ?>
		    <tr>
		        <td><?php echo $dongho['dongho_id'];?></td>
		        <td><?php echo $dongho['ten'];?></td>
		        <td><?php echo $dongho['xuatXu'];?></td>
		        <td>
		            <?php         
		                $database = new Libs_Model();
		                $db = $database->getConnection();               
		                $thuonghieu = new Admin_Models_ThuongHieu($db);
		                $thuonghieu->thuonghieu_id = $dongho['thuonghieu_id'];
		                //Lấy tất cả dữ liệu từ bảng 'categories'
		                $data = $thuonghieu->getThuongHieuById();
		                echo $data['ten'];
		            ?> 
		        </td>
		        <td><?php echo $dongho['day'];?></td>
		        <td><?php echo $dongho['giaCu'];?></td>
		        <td><?php echo $dongho['giaMoi'];?></td>
		        <td><?php echo $dongho['baoHanh'];?></td>
		        <td>
		            <a href="<?php echo URL_BASE;?>admin/detail?id=<?php echo $dongho['dongho_id'];?>&th=<?php echo $dongho['thuonghieu_id'];?>" class="btn btn-xs  btn-info">Xem</a>
		            <a href="<?php echo URL_BASE;?>admin/update?id=<?php echo $dongho['dongho_id'];?>" class="btn btn-xs  btn-primary">Sửa</a>
		            <?php  
		            $idD = $dongho['dongho_id'];
		            echo "<a href='#' onclick='delete_dongho($idD)' class='btn btn-xs btn-danger'>Xoá</a>";
		            ?>
		        </td>
		    </tr>
		    <?php 
			}}else{
                    echo "<div class='alert alert-danger'>Không tìm thấy đồng hồ có tên như bạn vừa nhập</div>";
                }  
		    ?>
		</table>
		<script>
		function delete_dongho(id) {
		    var response = confirm("Bạn có chắc muốn xoá SP?");
		    if (response==true) {
		        window.location = "<?php echo URL_BASE;?>admin/delete?id="+id;
		    }
		}
		</script>

	<?php 
	} 
	
	public function searchKH(){
	    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
		    if ($email != "") {
		        $con = new PDO("mysql:host=localhost;dbname=watch;charset=UTF8","root","");
		        $query = "SELECT * FROM khachhang WHERE email LIKE '%".$email."%'";
		        $stmt = $con->prepare($query);
		        $stmt->execute();
		        //Biểu diễn dữ liệu
		    }
		?>		 
		<table id="result" class="table table-bordered table-responsive table-hover text-center">
            <thead>
                <th class="text-center">ID</th>
                <th class="text-center">Email</th>
                <th class="text-center">Password</th>
                <th class="text-center">Tên</th>
                <th class="text-center">SĐT</th>
                <th class="text-center">Địa chỉ</th>
                <th class="text-center">Góp ý</th>
                <th class="text-center">Chức năng</th>
            </thead>
		    <?php  
		    if($khachhang = $stmt->fetch(PDO::FETCH_ASSOC) != ""){
                ?>
                <?php
                $stmt->execute();
		    while ($khachhang = $stmt->fetch(PDO::FETCH_ASSOC)) {      
		    $idD=$khachhang['khachhang_id'];              
		    ?>
		    <tr>
		        <td><?php echo $khachhang['khachhang_id'];?></td>
		        <td><?php echo $khachhang['email'];?></td>
		        <td><?php echo $khachhang['password'];?></td>
		        <td><?php echo $khachhang['ten'];?></td>
		        <td><?php echo $khachhang['soDienThoai'];?></td>
		        <td><?php echo $khachhang['diaChi'];?></td>
		        <td>
                    <?php  
                    if($khachhang['gopY'] != ""){
                    ?>
                    <a href="<?php echo URL_BASE;?>admin/gopYKH?id=<?php echo $khachhang['khachhang_id'];?>" class="btn btn-xs btn-default"> 1 góp ý</a>
                    <?php }else{echo "0";} ?>
                </td>
                <td>
                    <a href="<?php echo URL_BASE;?>admin/updateKH?id=<?php echo $khachhang['khachhang_id'];?>" class="btn btn-xs  btn-primary">Sửa</a>
                    <?php  
                    echo "<a href='#' onclick='delete_khachhang($idD);' class='btn btn-xs btn-danger'>Xoá</a>";
                    ?>
                </td>
		    </tr>
		    <?php 
			}}else{
                    echo "<div class='alert alert-danger'>Không tìm thấy đồng hồ có tên như bạn vừa nhập</div>";
                }  
		    ?>
		</table>
		<script>
        function delete_khachhang(id) {
            var response = confirm("Bạn có chắc muốn xoá khách hàng này?");
            if (response==true) {
                window.location = "<?php echo URL_BASE;?>admin/deleteKH?id="+id;
            }
        }
    </script>

	<?php 
	}
}
?>