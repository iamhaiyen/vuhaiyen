<?php  
    if (!isset($_SESSION['emailAdmin'])) {
        ?>
        <script>
            window.location = "<?php echo URL_BASE;?>admin/login";
        </script>
    <?php
    }else{
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
    <h2 class="page-header">Cập nhật thông tin khách hàng</h2>
    <?php  
        $id = isset($_GET['id']) ? $_GET['id'] : die("ID không tồn tại");
        $database = new Libs_Model();
        $db = $database->getConnection();
        $objKhachHang = new Admin_Models_Khachhang($db);

        if ($_POST) {
            $objKhachHang->email = $_POST['txtEmail'];
            $objKhachHang->password = $_POST['txtPassword'];            
            $objKhachHang->ten = $_POST['txtTen'];
            $objKhachHang->soDienThoai = $_POST['txtSoDienThoai'];
            $objKhachHang->diaChi = $_POST['txtDiaChi'];
            $objKhachHang->gopY = $_POST['txtGopY'];
            $objKhachHang->khachhang_id = $id;

            if ($objKhachHang->updateKhachHang()) {
                echo "<div class='alert alert-success'>Cập nhật thông tin khách hàng thành công.</div>";
            }else{
                echo "<div class='alert alert-danger'>Cập nhật thông tin khách hàng thất bại.</div>";
            }
        }
    ?>
    <?php  
        $objKhachHang->khachhang_id = $id;
        $row = $objKhachHang->getKhachHangById();
    ?>
    <form action="<?php ($_SERVER['PHP_SELF']."?id={$id}");?>" method="post" enctype="">
        <table class="table table-bordered table-hover table-responsive">
            <tr>
                <th>Tên</th>
                <td><input name="txtTen" type="text" value="<?php echo $row['ten'];?>" class="form-control"/></td>
            </tr>                
            <tr>
                <th>Email</th>
                <td><input name="txtEmail" type="text" value="<?php echo $row['email'];?>" class="form-control"/></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input name="txtPassword" type="text" value="<?php echo $row['password'];?>" class="form-control"/></td>
            </tr>
            <tr>
                <th>SĐT</th>
                <td><input name="txtSoDienThoai" type="text" value="<?php echo $row['soDienThoai'];?>" class="form-control"/></td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td>
                    <input type="text" name="txtDiaChi" value="<?php echo $row['diaChi'];?>" class="form-control"/>
                </td>
            </tr>            
            <tr>
                <th>Ý kiến góp ý</th>
                <td><textarea id="txtGopY" name="txtGopY" class="form-control"><?php echo $row['gopY'];?></textarea></td>
                <script>
                    CKEDITOR.replace('txtGopY');
                </script>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" class="btn btn-success" value="Cập nhật"/>
                    <a href="<?php echo URL_BASE;?>admin/khachhang" class="btn btn-danger">Quay lại trang quản lý khách hàng</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php } ?>