<?php  
    if (!isset($_SESSION['emailAdmin'])) {
        ?>
        <script>
            window.location = "<?php echo URL_BASE;?>admin/login";
        </script>
    <?php
    }else{ //Mở else
        $database = new Libs_Model();
        $db = $database->getConnection(); 
        $objEmp = new Admin_Models_Employee($db);
        $objEmp->emailAdmin = $_SESSION['emailAdmin'];
    ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<p class='welcome'>Xin chào Admin<br><?php echo $emp['name']; ?></p>
</div>
<?php } ?>