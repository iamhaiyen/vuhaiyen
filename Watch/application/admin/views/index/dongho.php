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
        <h2 class="page-header">Danh sách đồng hồ</h2>
        <div class="row">
            <div class="col-md-10 col-xs-9">
                <div class="row">
                    <div class="col-md-9 col-xs-7" style="padding-right: 0px">
                        <input class="form-control" id="txtSearch" type="search" placeholder="Nhập tên đồng hồ cần tìm kiếm">
                    </div>
                    <div class="col-md-3 col-xs-5" style="padding-left: 0">
                        <button class="btn btn-sm btn-danger" onclick="showData()">Tìm kiếm</button>
                    </div>
                </div>                
            </div>
            <div class="col-md-2 col-xs-3" style="padding-left: 1px">
                <a href="<?php echo URL_BASE;?>admin/add" class="btn btn-success" style="margin-bottom: 15px;float: right;">Thêm mới</a>
            </div>
        </div>
        <table id="result" class="table table-bordered table-responsive table-hover text-center">
            <thead>
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
            while ($row = $this->objDongHo->fetch(PDO::FETCH_ASSOC)) {
                extract($row);                       
            ?>
            <tr>
                <td><?php echo $dongho_id;?></td>
                <td><?php echo $ten;?></td>
                <td><?php echo $xuatXu;?></td>
                <td>
                    <?php         
                        $database = new Libs_Model();
                        $db = $database->getConnection();               
                        $thuonghieu = new Admin_Models_ThuongHieu($db);
                        $thuonghieu->thuonghieu_id = $thuonghieu_id;
                        //Lấy tất cả dữ liệu từ bảng 'categories'
                        $data = $thuonghieu->getThuongHieuById();
                        echo $data['ten'];
                    ?> 
                </td>
                <td><?php echo $day;?></td>
                <td><?php echo $giaCu;?></td>
                <td><?php echo $giaMoi;?></td>
                <td><?php echo $baoHanh;?></td>
                <td>
                    <a href="<?php echo URL_BASE;?>admin/detail?id=<?php echo $dongho_id;?>&th=<?php echo $thuonghieu_id;?>" class="btn btn-xs  btn-info">Xem</a>
                    <a href="<?php echo URL_BASE;?>admin/update?id=<?php echo $dongho_id;?>" class="btn btn-xs  btn-primary">Sửa</a>
                    <?php  
                    echo "<a href='#' onclick='delete_dongho($dongho_id);' class='btn btn-xs btn-danger'>Xoá</a>";
                    ?>
                </td>
            </tr>
        	<?php } ?>
        </table>
    <script>
        function delete_dongho(id) {
            var response = confirm("Bạn có chắc muốn xoá SP?");
            if (response==true) {
                window.location = "<?php echo URL_BASE;?>admin/delete?id="+id;
            }
        }
    </script>
</div>	<!--/.main-->
<?php } ?>