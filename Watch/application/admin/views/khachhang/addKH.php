<?php  
    if (!isset($_SESSION['emailAdmin'])) {
        ?>
        <script>
            window.location = "<?php echo URL_BASE;?>admin/login";
        </script>
    <?php
    }else{
?>

<?php          
    $database = new Libs_Model();
    $db = $database->getConnection();
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
    <h2 class="page-header">Thêm mới khách hàng</h2>
    <?php
    //Tiến hành lấy dữ liệu trên form
    if($_POST){         
        //Khởi tạo đối tượng Product  
        $objKhachHang = new Admin_Models_Khachhang($db);
        //Truyền giá trị lấy được từ Form cho các thuộc tính của Product
        $objKhachHang->email = $_POST['txtEmail'];
        $objKhachHang->password = $_POST['txtPassword'];        
        $objKhachHang->ten = $_POST['txtTen'];
        $objKhachHang->soDienThoai = $_POST['txtSoDienThoai'];
        $objKhachHang->diaChi = $_POST['txtDiaChi'];
        //Gọi phương thức addProduct
        if($objKhachHang->addKhachHang()){
            echo "<div class='alert alert-success'>
        Thêm sản phẩm thành công.</div>";
        }else{
            echo "<div class='alert alert-danger'>
        Thêm sản phẩm thất bại.</div>";
        }
    }
    ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <table class="table table-bordered table-responsive table-hover">
            <tr>
                <th>Email</th>
                <td>
                    <input type="email" name="txtEmail" class="form-control"/>
                </td>
            </tr>            
            <tr>
                <th>Password</th>
                <td>
                    <input type="text" name="txtPassword" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Tên</th>
                <td>
                    <input type="text" name="txtTen" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>SĐT</th>
                <td>
                    <input type="text" name="txtSoDienThoai" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td>
                    <input type="text" name="txtDiaChi" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Lưu" class="btn btn-primary"/>
                    &nbsp;
                    <a href="<?php echo URL_BASE;?>admin/khachhang" class="btn btn-danger">Quay về trang quản lý Khách hàng</a>
                </td>
            </tr>
        </table>
    </form>
</div>  <!--/.main-->
<?php } ?>