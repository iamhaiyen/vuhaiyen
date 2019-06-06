<?php
if (!isset($_SESSION['emailAdmin'])) {
    ?>
    <script>
        window.location = "<?php echo URL_BASE;?>admin/login";
    </script>
    <?php
} else {

    ?>

    <?php
    $database = new Libs_Model();
    $db = $database->getConnection();
    ?>
<h2>Doanh thu Ngày hôm nay</h2>

    <h2>Doanh thu 1 tháng gần đây</h2>

    <h2>Doanh thu năm nay</h2>

<?php } ?>