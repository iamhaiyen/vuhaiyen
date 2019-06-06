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
    <h2 class="page-header">Đã xóa thành công</h2>
    <?php  
        $id = isset($_GET['id']) ? $_GET['id'] : die("Không tồn tại ID");
        $database = new Libs_Model();
        $db = $database->getConnection();
        $dongho = new Admin_Models_DongHo($db);   
        $dongho->dongho_id = $id;
        if ($dongho->deleteDongHoById()) {
            ?>
            <script>
                window.location = "<?php echo URL_BASE;?>admin/dongho";
            </script>
            <?php
        }else{
            die("Xóa sản phẩm không thành công");
        }
    ?>
</div>  <!--/.main-->
<?php } ?>

