<?php
class Default_Controllers_Index extends Libs_Controller{
    
    public function __construct() {
        parent::__construct();
        //Đã có thuộc tính view của cha
    }
    public function logout(){
        $this->view->render("index/logout");
    }
    public function profile(){
        $this->view->render("index/profile");
    }
    public function index(){
        //Khởi tạo CSDL
        $database = new Libs_Model();
        $db = $database->getConnection();
        //Khởi tạo model 'dongho'
        $dongho = new Default_Models_Dongho($db);
        $this->view->objDongHo = $dongho->getAllDongHo();
        $this->view->objDongHoGiaRe = $dongho->getDongHoGiaRe();
        $this->view->objDongHoMoiNhat = $dongho->getDongHoMoiNhat();
        $this->view->objDongHoKhuyenMai = $dongho->getDongHoKhuyenMai();
        $slide = new Default_Models_Slide($db);
        $this->view->objSlide = $slide->getAllSlide();
        $this->view->render('index/index');
    }

    public function detail(){
        //Khởi tạo CSDL
        $database = new Libs_Model();
        $db = $database->getConnection();
        $dongho = new Default_Models_Dongho($db);
        $this->view->objDongHoKhuyenMai = $dongho->getDongHoKhuyenMai();
        $dongho->dongho_id = isset($_GET['id']) ? $_GET['id'] : "";
        $thuonghieu = new Default_Models_ThuongHieu($db);
        $thuonghieu->thuonghieu_id = isset($_GET['th']) ? $_GET['th'] : "";
        //Khởi tạo model 'dongho'
        $this->view->result = $dongho->getDongHoById();
        $this->view->result1 = $thuonghieu->getThuongHieuById();
    	$this->view->render('index/detail');
    }

    public function category(){
        $database = new Libs_Model();
        $db = $database->getConnection();
        $dongho = new Default_Models_Dongho($db);
        $this->view->objDongHoKhuyenMai = $dongho->getDongHoKhuyenMai();
        $dongho->thuonghieu_id = isset($_GET['th']) ? $_GET['th'] : "";        
        $thuonghieu = new Default_Models_ThuongHieu($db);
        $thuonghieu->thuonghieu_id = $dongho->thuonghieu_id;
        if ($dongho->getAllDongHoByCategory_Id() != NULL && $thuonghieu->getThuongHieuById() != NULL) {
            
        $this->view->objDongHo1 = $dongho->getAllDongHoByCategory_Id();
        $this->view->result1 = $thuonghieu->getThuongHieuById();
        $this->view->render('index/category');
        }else{
            $this->view->render('index/error');
        }  
    }

    public function cart(){
        $this->view->render('index/cart');
    }
    public function thanhToan(){
        $this->view->render('index/thanhToan');
    }
    public function soSanh(){
        $this->view->render('index/soSanh');
    }
    public function thongTinLienHe(){
        $this->view->render('index/thongTinLienHe');
    }
    public function thacMacGopY(){
        $this->view->render('index/thacMacGopY');
    }

    public function addtocart(){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
        if ($id != "") {
            // echo $id;
            //Lấy dữ liệu từ bảng 'products' theo 'productid' sản phẩm
            $quantity = $_REQUEST['quantity'];
            $database = new Libs_Model();
            $db = $database->getConnection();
            $dongho = new Default_Models_Dongho($db);
            $dongho->ma = $id;
            $row = $dongho->getDongHoByIdToCart();

            $itemArray = array(
                $row[0]['ma'] => array(
                    'ten'      =>  $row[0]['ten'],
                    'dongho_id' => $row[0]['dongho_id'],
                    'ma'        =>  $row[0]['ma'],
                    'giaCu'     =>  $row[0]['giaCu'],
                    'giaMoi'     =>  $row[0]['giaMoi'],
                    'quantity'   =>  $quantity,
                    'anh'     =>  $row[0]['anh']
            ));

            if(!empty($_SESSION['cart_item'])){
                //Kiểm tra sản phẩm cần thêm vào giỏ hàng đã tồn tại trong $_SESSION['cart_item'] chưa?
                //Nếu đã tồn tại:
                if(in_array($row[0]['ma'], array_keys($_SESSION['cart_item']))){
                    foreach ($_SESSION['cart_item'] as $k => $v){
                        if($row[0]['ma'] == $k){
                            if(empty($_SESSION['cart_item'][$k]['quantity'])){
                                $_SESSION['cart_item'][$k]['quantity']= 0;
                            }
                            $_SESSION['cart_item'][$k]['quantity'] += $quantity;
                        }
                    }
                } else{
                    $_SESSION['cart_item'] = array_merge($_SESSION['cart_item'], $itemArray);
                }
            }else{
                $_SESSION['cart_item'] = $itemArray;
            }
               echo count($_SESSION['cart_item']);
        }
    }

    public function deleteToCart(){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
        if($id!=""){
            unset($_SESSION['cart_item'][$id]);        
        }
        $this->view->render('index/cart');

    }
    public function datHang(){
        unset($_SESSION['cart_item']);   
        $this->view->render('index/cart');

    }
    
    public function addSoSanh(){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
        if ($id != "") {
            // echo $id;
            //Lấy dữ liệu từ bảng 'products' theo 'productid' sản phẩm
            $quantity = $_REQUEST['quantity'];
            $database = new Libs_Model();
            $db = $database->getConnection();
            $dongho = new Default_Models_Dongho($db);
            $dongho->ma = $id;
            $row = $dongho->getDongHoByIdToSoSanh();

            $itemArray = array(
                $row[0]['ma'] => array(
                    'ten'      =>  $row[0]['ten'],
                    'ma'        =>  $row[0]['ma'],
                    'xuatXu'        =>  $row[0]['xuatXu'],
                    'kieuMay'        =>  $row[0]['kieuMay'],
                    'kichCo'        =>  $row[0]['kichCo'],
                    'chatLieuVo'        =>  $row[0]['chatLieuVo'],
                    'day'        =>  $row[0]['day'],
                    'chatLieuKinh'        =>  $row[0]['chatLieuKinh'],
                    'doChiuNuoc'        =>  $row[0]['doChiuNuoc'],
                    'baoHanh'        =>  $row[0]['baoHanh'],
                    'giaCu'     =>  $row[0]['giaCu'],
                    'giaMoi'     =>  $row[0]['giaMoi'],
                    'quantity'   =>  $quantity,
                    'anh'     =>  $row[0]['anh']
            ));

            if(!empty($_SESSION['soSanh_item'])){
                //Kiểm tra sản phẩm cần thêm vào giỏ hàng đã tồn tại trong $_SESSION['cart_item'] chưa?
                //Nếu đã tồn tại:
                if(in_array($row[0]['ma'], array_keys($_SESSION['soSanh_item']))){
                    foreach ($_SESSION['soSanh_item'] as $k => $v){
                        if($row[0]['ma'] == $k){
                            if(empty($_SESSION['soSanh_item'][$k]['quantity'])){
                                $_SESSION['soSanh_item'][$k]['quantity']= 0;
                            }
                        }
                    }
                } else if(count($_SESSION['soSanh_item'])<3){
                    $_SESSION['soSanh_item'] = array_merge($_SESSION['soSanh_item'], $itemArray);
                }
            }else{
                $_SESSION['soSanh_item'] = $itemArray;
            }
            echo "BẢNG SO SÁNH (".count($_SESSION['soSanh_item']).")";
        }
    }

    public function deleteToSoSanh(){
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
        if($id!=""){
            unset($_SESSION['soSanh_item'][$id]);        
        }
        $this->view->render('index/soSanh');

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
        <div class="p-watch">
            <a href="#"><p class="left-post" style="text-transform: uppercase;">Tìm kiếm: <?php echo $ten; ?></p></a>
        </div>                     
        <div class="row"> 
            <?php  
                if($dongho2 = $stmt->fetch(PDO::FETCH_ASSOC) != ""){
                ?>
                <?php
                $stmt->execute();
                while ($dongho2 = $stmt->fetch(PDO::FETCH_ASSOC)) {                              
                ?>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <figure class="sale-watch">
                        <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho2['dongho_id'];?>&th=<?php echo $dongho2['thuonghieu_id'];?>"><img src="<?php echo URL_BASE;?><?php echo $dongho2['anh']; ?>" class="img-sale-watch"/></a>
                        <p class="p-sale-watch"><b><?php echo $dongho2['ten']; ?></b><br><?php echo $dongho2['day']; ?>
                        <p class="gia-sale">$<?php echo $dongho2['giaMoi']; ?> <span class="span-sale-watch">$<?php echo $dongho2['giaCu']; ?></span></p>
                        <a href="#" onclick="liveSoSanh('<?php echo $dongho2['ma'];?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                        <a href="#" onclick="livesale('<?php echo $dongho2['ma'];?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                    </figure>
                </div> 
                <?php  
                }}else{
                    echo "<div class='col-xs-12 col-sm-12 col-md-12'>";
                    echo "<div class='alert alert-danger'>Không tìm thấy đồng hồ có tên như bạn vừa nhập</div>";
                    echo "</div>";
                }                  
            ?>
        </div>  
    <?php 
    }
    public function searchXS(){
        $ten = isset($_REQUEST['tenXS']) ? $_REQUEST['tenXS'] : "";
            if ($ten != "") {
                $con = new PDO("mysql:host=localhost;dbname=watch;charset=UTF8","root","");
                $query = "SELECT * FROM dongho WHERE ten LIKE '%".$ten."%'";
                $stmt = $con->prepare($query);
                $stmt->execute();
                //Biểu diễn dữ liệu
            }
        ?>       
        <div class="p-watch">
            <a href="#"><p class="left-post" style="text-transform: uppercase;">Tìm kiếm: <?php echo $ten; ?></p></a>
        </div>                     
        <div class="row"> 
            <?php  
                if($dongho2 = $stmt->fetch(PDO::FETCH_ASSOC) != ""){
                ?>
                <?php
                $stmt->execute();
                while ($dongho2 = $stmt->fetch(PDO::FETCH_ASSOC)) {                              
                ?>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <figure class="sale-watch">
                        <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho2['dongho_id'];?>&th=<?php echo $dongho2['thuonghieu_id'];?>"><img src="<?php echo URL_BASE;?><?php echo $dongho2['anh']; ?>" class="img-sale-watch"/></a>
                        <p class="p-sale-watch"><b><?php echo $dongho2['ten']; ?></b><br><?php echo $dongho2['day']; ?>
                        <p class="gia-sale">$<?php echo $dongho2['giaMoi']; ?> <span class="span-sale-watch">$<?php echo $dongho2['giaCu']; ?></span></p>
                        <a href="#" onclick="liveSoSanh('<?php echo $dongho2['ma'];?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                        <a href="#" onclick="livesale('<?php echo $dongho2['ma'];?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                    </figure>
                </div> 
                <?php  
                }}else{
                    echo "<div class='col-xs-12 col-sm-12 col-md-12'>";
                    echo "<div class='alert alert-danger'>Không tìm thấy đồng hồ có tên như bạn vừa nhập</div>";
                    echo "</div>";
                }                  
            ?>
        </div>  
    <?php 
    }

    public function locTheoGia(){
        $mucGia = isset($_REQUEST['mucGia']) ? $_REQUEST['mucGia'] : "";
        if ($mucGia == '0') {
            echo "<div class='alert alert-danger'>Hãy chọn mức giá trong ô lọc</div>";
        }

        if($mucGia == '400'){
            $conn = new PDO("mysql:host=localhost;dbname=watch;charset=UTF8", "root", "");
            $query = "SELECT * FROM dongho WHERE giaMoi BETWEEN 0 AND 400";
            $stmt = $conn->prepare($query);
            $stmt->execute();            
            ?>
            <div class="p-watch">
                <a href="#"><p class="left-post" style="text-transform: uppercase;">Lọc theo giá từ $0 -> $400</p></a>
            </div>                     
            <div class="row"> 
                <?php
                    $stmt->execute();
                    while ($dongho2 = $stmt->fetch(PDO::FETCH_ASSOC)) {                              
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <figure class="sale-watch">
                            <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho2['dongho_id'];?>&th=<?php echo $dongho2['thuonghieu_id'];?>"><img src="<?php echo URL_BASE;?><?php echo $dongho2['anh']; ?>" class="img-sale-watch"/></a>
                            <p class="p-sale-watch"><b><?php echo $dongho2['ten']; ?></b><br><?php echo $dongho2['day']; ?>
                            <p class="gia-sale">$<?php echo $dongho2['giaMoi']; ?> <span class="span-sale-watch">$<?php echo $dongho2['giaCu']; ?></span></p>
                            <a href="#" onclick="liveSoSanh('<?php echo $dongho2['ma'];?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                            <a href="#" onclick="livesale('<?php echo $dongho2['ma'];?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                        </figure>
                    </div> 
                    <?php  
                    }               
                ?>
            </div>
        <?php } ?> 
        
        <?php 
        if($mucGia == '700'){
            $conn = new PDO("mysql:host=localhost;dbname=watch;charset=UTF8", "root", "");
            $query = "SELECT * FROM dongho WHERE giaMoi BETWEEN 401 AND 700";
            $stmt = $conn->prepare($query);
            $stmt->execute();            
            ?>
            <div class="p-watch">
                <a href="#"><p class="left-post" style="text-transform: uppercase;">Lọc theo giá từ $400 -> $700</p></a>
            </div>                     
            <div class="row"> 
                <?php
                    $stmt->execute();
                    while ($dongho2 = $stmt->fetch(PDO::FETCH_ASSOC)) {                              
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <figure class="sale-watch">
                            <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho2['dongho_id'];?>&th=<?php echo $dongho2['thuonghieu_id'];?>"><img src="<?php echo URL_BASE;?><?php echo $dongho2['anh']; ?>" class="img-sale-watch"/></a>
                            <p class="p-sale-watch"><b><?php echo $dongho2['ten']; ?></b><br><?php echo $dongho2['day']; ?>
                            <p class="gia-sale">$<?php echo $dongho2['giaMoi']; ?> <span class="span-sale-watch">$<?php echo $dongho2['giaCu']; ?></span></p>
                            <a href="#" onclick="liveSoSanh('<?php echo $dongho2['ma'];?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                            <a href="#" onclick="livesale('<?php echo $dongho2['ma'];?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                        </figure>
                    </div> 
                    <?php  
                    }               
                ?>
            </div>
        <?php } ?> 
        
        <?php 
        if($mucGia == '1000'){
            $conn = new PDO("mysql:host=localhost;dbname=watch;charset=UTF8", "root", "");
            $query = "SELECT * FROM dongho WHERE giaMoi BETWEEN 701 AND 1000";
            $stmt = $conn->prepare($query);
            $stmt->execute();            
            ?>
            <div class="p-watch">
                <a href="#"><p class="left-post" style="text-transform: uppercase;">Lọc theo giá từ $700 -> $1000</p></a>
            </div>                     
            <div class="row"> 
                <?php
                    $stmt->execute();
                    while ($dongho2 = $stmt->fetch(PDO::FETCH_ASSOC)) {                              
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <figure class="sale-watch">
                            <a href="<?php echo URL_BASE;?>index/detail?id=<?php echo $dongho2['dongho_id'];?>&th=<?php echo $dongho2['thuonghieu_id'];?>"><img src="<?php echo URL_BASE;?><?php echo $dongho2['anh']; ?>" class="img-sale-watch"/></a>
                            <p class="p-sale-watch"><b><?php echo $dongho2['ten']; ?></b><br><?php echo $dongho2['day']; ?>
                            <p class="gia-sale">$<?php echo $dongho2['giaMoi']; ?> <span class="span-sale-watch">$<?php echo $dongho2['giaCu']; ?></span></p>
                            <a href="#" onclick="liveSoSanh('<?php echo $dongho2['ma'];?>');"class="btn btn-default btn-sm" style="margin-top: 5px;">So sánh</a>
                            <a href="#" onclick="livesale('<?php echo $dongho2['ma'];?>');" class="btn btn-danger btn-sm" style="margin-top: 5px;">Mua ngay</a>
                        </figure>
                    </div> 
                    <?php  
                    }               
                ?>
            </div>
        <?php } ?>
        <?php  
    }
}
?>
