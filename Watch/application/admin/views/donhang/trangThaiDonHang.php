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
    <h2 class="page-header">Trạng thái đơn hàng</h2>
	<?php  
        $id = isset($_GET['id']) ? $_GET['id'] : die("ID không tồn tại");
        $database = new Libs_Model();
	    $db = $database->getConnection();
        $objDonHang = new Admin_Models_Donhang($db);

        if (isset($_POST['btnTrangThai'])) {
            $objDonHang->trangThai = $_POST['txtTrangThai'];
            $objDonHang->donhang_id = $id;

            if ($objDonHang->updateTrangThaiDonHang()) {
                echo "<div class='alert alert-success'>Đơn hàng đã được giao.</div>";
            }else{
                echo "<div class='alert alert-danger'>Có lỗi, vui lòng kiểm tra lại.</div>";
            }
        }
    ?>
    <?php  
        $objDonHang->donhang_id = $id;
        $row = $objDonHang->getDonHangById();
    ?>
    <form action="<?php ($_SERVER['PHP_SELF']."?id={$id}");?>" method="post" enctype="">
        <table class="table table-bordered table-hover table-responsive">
            <tr>
                <th>Tên KH</th>
                <?php  
                    $database = new Libs_Model();
                    $db = $database->getConnection();
                    $khachhang = new Admin_Models_Khachhang($db);
                    $khachhang->khachhang_id = $row['khachhang_id'];
                    $RowKH = $khachhang->getKhachHangById();
                ?>                
                <td><input disabled type="text" value="<?php echo $RowKH['ten']; ?>" class="form-control"/></td>
            </tr>                
            <tr>
                <th>Tên ĐH</th>
                <?php  
                    $database = new Libs_Model();
                    $db = $database->getConnection();
                    $dongho = new Admin_Models_Dongho($db);
                    $dongho->dongho_id = $row['dongho_id'];
                    $RowDH = $dongho->getDongHoById();
                ?>
                <td><input disabled type="text" value="<?php echo $RowDH['ten']; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <th>Số lượng</th>
                <td><input disabled type="text" value="<?php echo $row['soLuong'];?>" class="form-control"/></td>
            </tr>
            <tr>
                <th>Thành tiền</th>
                <td>
                    <input disabled type="text" value="<?php echo $row['thanhTien'];?>" class="form-control"/>
                </td>
            </tr> 
            <tr>
                <th>Trạng thái</th>
                <td>
                    <input name="txtTrangThai" type="text" value="<?php echo $row['trangThai'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" name="btnTrangThai" value="Giao hàng" class="btn btn-primary">
                    <a href="<?php echo URL_BASE;?>admin/donhang" class="btn btn-danger">Quay lại trang quản lý khách hàng</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php } ?>