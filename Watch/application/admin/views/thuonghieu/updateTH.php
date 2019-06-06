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
    <h2 class="page-header">Cập nhật tên thương hiệu</h2>
    <?php  
        $id = isset($_GET['id']) ? $_GET['id'] : die("ID không tồn tại");
        $database = new Libs_Model();
        $db = $database->getConnection();
        $objThuongHieu = new Admin_Models_Thuonghieu($db);

        if ($_POST) {
            $objThuongHieu->ten = $_POST['txtTen'];
            $objThuongHieu->thuonghieu_id = $id;

            if ($objThuongHieu->updateThuongHieu()) {
                echo "<div class='alert alert-success'>Cập nhật tên thương hiệu thành công.</div>";
            }else{
                echo "<div class='alert alert-danger'>Cập nhật tên thương hiệu thất bại.</div>";
            }
        }
    ?>
    <?php  
        $objThuongHieu->thuonghieu_id = $id;
        $row = $objThuongHieu->getThuongHieuById();
    ?>
    <form action="<?php ($_SERVER['PHP_SELF']."?id={$id}");?>" method="post" enctype="">
        <table class="table table-bordered table-hover table-responsive">
            <tr>
                <th>Tên thương hiệu</th>
                <td><input name="txtTen" type="text" value="<?php echo $row['ten'];?>" class="form-control"/></td>
            </tr>      
            <tr>
                <td></td>
                <td>
                    <input type="submit" class="btn btn-success" value="Cập nhật"/>
                    <a href="<?php echo URL_BASE;?>admin/thuonghieu" class="btn btn-danger">Quay lại trang quản lý thương hiệu</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php } ?>