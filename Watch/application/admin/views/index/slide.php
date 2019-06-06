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
        <h2 class="page-header">Danh sách Slide</h2>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <a href="<?php echo URL_BASE;?>admin/addSlide" class="btn btn-success" style="margin-bottom: 15px;float: right;">Thêm mới</a>
            </div>
        </div>
        <table class="table table-bordered table-responsive table-hover text-center">
            <thead>
                <th class="text-center">ID</th>
                <th class="text-center">Ảnh</th>
                <th class="text-center">Xóa</th>
            </thead>
            <?php  
            while ($row = $this->objSlide->fetch(PDO::FETCH_ASSOC)) {
                extract($row);                       
            ?>
            <tr>
                <td><?php echo $slide_id;?></td>
                <td>
                    <img src="<?php echo URL_BASE;?><?php echo $anh; ?>" style="width: 100%">
                </td>
                <td>  
                    <?php  
                    echo "<a href='#' onclick='delete_slide($slide_id);' class='btn btn-xs btn-danger'>Xoá</a>";
                    ?>
                </td>
            </tr>
        	<?php } ?>
        </table>
    <script>
        function delete_slide(id) {
            var response = confirm("Bạn có chắc muốn xoá slide?");
            if (response==true) {
                window.location = "<?php echo URL_BASE;?>admin/deleteSlide?id="+id;
            }
        }
    </script>
</div>	<!--/.main-->
<?php } ?>