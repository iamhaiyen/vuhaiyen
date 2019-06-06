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
    <h2 class="page-header">Đã xóa thương hiệu thành công</h2>
    <?php  
        $id = isset($_GET['id']) ? $_GET['id'] : die("Không tồn tại ID");
        $database = new Libs_Model();
        $db = $database->getConnection();
        $thuonghieu = new Admin_Models_Thuonghieu($db);   
        $thuonghieu->thuonghieu_id = $id;
        if ($thuonghieu->deleteThuongHieuById()) {
            ?>
            <script>
                window.location = "<?php echo URL_BASE;?>admin/thuonghieu";
            </script>
            <?php
        }else{
            die("Xóa thương hiệu không thành công");
        }
    ?>
</div>  <!--/.main-->
<?php } ?>
