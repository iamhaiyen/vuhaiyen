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
        <h2 class="page-header">Danh sách đơn hàng đặt mua</h2>
        <table id="result" class="table table-bordered table-responsive table-hover text-center">
            <thead>
                <th class="text-center">ID</th>
                <th class="text-center">Tên KH</th>
                <th class="text-center">Email</th>
                <th class="text-center">SĐT</th>
                <th class="text-center">Địa chỉ</th>
                <th class="text-center">Tên ĐH</th>
                <th class="text-center">SL</th>
                <th class="text-center">Thành tiền</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Xóa</th>
            </thead>
            <?php  
            while ($row = $this->objDonHang->fetch(PDO::FETCH_ASSOC)) {
                extract($row);                       
            ?>
            <tr>
                <td><?php echo $donhang_id;?></td>
                <td>
                    <?php  
                    $database = new Libs_Model();
                    $db = $database->getConnection();
                    $khachhang = new Admin_Models_Khachhang($db);
                    $khachhang->khachhang_id = $khachhang_id;
                    $RowKH = $khachhang->getKhachHangById();
                    ?>
                    <?php echo $RowKH['ten']; ?>
                </td>   
                <td><?php echo $RowKH['email']; ?></td>             
                <td><?php echo $RowKH['soDienThoai']; ?></td>
                <td><?php echo $RowKH['diaChi']; ?></td>
                <td>
                    <?php  
                    $database = new Libs_Model();
                    $db = $database->getConnection();
                    $dongho = new Admin_Models_Dongho($db);
                    $dongho->dongho_id = $dongho_id;
                    $RowDH = $dongho->getDongHoById();
                    ?>
                    <?php echo $RowDH['ten']; ?>
                </td>                
                <td><?php echo $soLuong;?></td>
                <td><?php echo $thanhTien;?></td>
                <td>
                    <?php  
                    if($trangThai == "" || $trangThai == "Chưa giao"){
                    ?>
                    <a href="<?php echo URL_BASE;?>admin/trangThaiDonHang?id=<?php echo $donhang_id;?>" class="btn btn-xs btn-default">Chưa giao</a>
                    <?php }else{echo $trangThai;} ?></td>
                <td>
                    <?php  
                    echo "<a href='#' onclick='delete_donhang($donhang_id);' class='btn btn-xs btn-danger'>Xoá</a>";
                    ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    <script>
        function delete_donhang(id) {
            var response = confirm("Bạn có chắc muốn xoá đơn hàng này khi đã giao hàng xong?");
            if (response==true) {
                window.location = "<?php echo URL_BASE;?>admin/deleteDonHang?id="+id;
            }
        }
    </script>
</div>  <!--/.main-->
<?php } ?>