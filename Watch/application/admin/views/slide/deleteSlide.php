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
    <h2 class="page-header">Đã xóa Slide thành công</h2>
    <?php  
        $id = isset($_GET['id']) ? $_GET['id'] : die("Không tồn tại ID");
        $database = new Libs_Model();
        $db = $database->getConnection();
        $slide = new Admin_Models_Slide($db);   
        $slide->slide_id = $id;
        if ($slide->deleteSlideById()) {
            ?>
            <script>
                window.location = "<?php echo URL_BASE;?>admin/slide";
            </script>
            <?php
        }else{
            die("Xóa Slide thất bại!");
        }
    ?>
</div>  <!--/.main-->
<?php } ?>

