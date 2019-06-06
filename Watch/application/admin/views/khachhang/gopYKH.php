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
    
    <?php 
    $dataKhachHang = $this->result; 
    ?>
    <h2 class="page-header"><b><?php echo $dataDongHo['ten'];?></b></h2>
    <table class="table table-bordered table-responsive table-hover">
        <tr>
            <th>Tên</th>
            <td><?php echo $dataKhachHang['ten'];?></td>
        </tr>
        <tr>
            <th>Góp ý</th>
            <td><?php echo $dataKhachHang['gopY'];?></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="<?php echo URL_BASE;?>admin/khachhang" class="btn btn-danger">Quay về trang quản lý khách hàng</a>
            </td>
        </tr>
    </table>
</div>	<!--/.main-->
<?php } ?>