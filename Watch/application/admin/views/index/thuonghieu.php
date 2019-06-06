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
        <h2 class="page-header">Danh sách thương hiệu</h2>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <a href="<?php echo URL_BASE;?>admin/addTH" class="btn btn-success" style="margin-bottom: 15px;float: right;">Thêm mới</a>
            </div>
        </div>
        <table class="table table-bordered table-responsive table-hover text-center">
            <thead>
                <th class="text-center">ID</th>
                <th class="text-center">Tên</th>
                <th class="text-center">Chức năng</th>
            </thead>
            <?php  
            while ($row = $this->objThuongHieu->fetch(PDO::FETCH_ASSOC)) {
                extract($row);                       
            ?>
            <tr>
                <td><?php echo $thuonghieu_id;?></td>
                <td><?php echo $ten;?></td>
                <td>                    
                    <a href="<?php echo URL_BASE;?>admin/updateTH?id=<?php echo $thuonghieu_id;?>" class="btn btn-xs  btn-primary">Sửa</a>
                    <?php  
                    echo "<a href='#' onclick='delete_thuonghieu($thuonghieu_id);' class='btn btn-xs btn-danger'>Xoá</a>";
                    ?>
                </td>
            </tr>
        	<?php } ?>
        </table>
    <script>
        function delete_thuonghieu(id) {
            var response = confirm("Bạn có chắc muốn xoá thương hiệu?");
            if (response==true) {
                window.location = "<?php echo URL_BASE;?>admin/deleteTH?id="+id;
            }
        }
    </script>
</div>	<!--/.main-->
<?php } ?>