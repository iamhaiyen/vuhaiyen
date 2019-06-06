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
        <h2 class="page-header">Danh sách khách hàng</h2>
        <div class="row">
            <div class="col-md-10 col-xs-9">
                <div class="row">
                    <div class="col-md-9 col-xs-7" style="padding-right: 0px">
                        <input class="form-control" id="txtSearchKH" type="search" placeholder="Nhập tên khách hàng cần tìm kiếm">
                    </div>
                    <div class="col-md-3 col-xs-5" style="padding-left: 0">
                        <button class="btn btn-sm btn-danger" onclick="showDataKH()">Tìm kiếm</button>
                    </div>
                </div>                
            </div>
            <div class="col-md-2 col-xs-3" style="padding-left: 1px">
                <a href="<?php echo URL_BASE;?>admin/addKH" class="btn btn-success" style="margin-bottom: 15px;float: right;">Thêm mới</a>
            </div>
        </div>
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
            while ($row = $this->objKhachHang->fetch(PDO::FETCH_ASSOC)) {
                extract($row);                       
            ?>
            <tr>
                <td><?php echo $khachhang_id;?></td>
                <td><?php echo $email;?></td>
                <td><?php echo $password;?></td>                
                <td><?php echo $ten;?></td>
                <td><?php echo $soDienThoai;?></td>
                <td><?php echo $diaChi;?></td>
                <td>
                    <?php  
                    if($gopY != ""){
                    ?>
                    <a href="<?php echo URL_BASE;?>admin/gopYKH?id=<?php echo $khachhang_id;?>" class="btn btn-xs btn-default"> 1 góp ý</a>
                    <?php }else{echo "0";} ?>
                </td>
                <td>
                    <a href="<?php echo URL_BASE;?>admin/updateKH?id=<?php echo $khachhang_id;?>" class="btn btn-xs  btn-primary">Sửa</a>
                    <?php  
                    echo "<a href='#' onclick='delete_khachhang($khachhang_id);' class='btn btn-xs btn-danger'>Xoá</a>";
                    ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    <script>
        function delete_khachhang(id) {
            var response = confirm("Bạn có chắc muốn xoá khách hàng này?");
            if (response==true) {
                window.location = "<?php echo URL_BASE;?>admin/deleteKH?id="+id;
            }
        }
    </script>
</div>  <!--/.main-->
<?php } ?>