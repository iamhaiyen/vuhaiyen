<?php  
    if (!isset($_SESSION['emailAdmin'])) {
        ?>
        <script>
            window.location = "<?php echo URL_BASE;?>admin/login";
        </script>
    <?php
    }else{
?>

<?php          
    $database = new Libs_Model();
    $db = $database->getConnection();
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
    <h2 class="page-header">Thêm mới thương hiệu</h2>
    <?php
    //Tiến hành lấy dữ liệu trên form
    if($_POST){         
        //Khởi tạo đối tượng Product  
        $objThuongHieu = new Admin_Models_Thuonghieu($db);
        //Truyền giá trị lấy được từ Form cho các thuộc tính của Product
        $objThuongHieu->ten = $_POST['txtTen'];
        //Gọi phương thức addProduct
        if($objThuongHieu->addThuongHieu()){
            echo "<div class='alert alert-success'>
        Thêm mới thương hiệu thành công.</div>";
        }else{
            echo "<div class='alert alert-danger'>
        Thêm mới thương hiệu thất bại.</div>";
        }
    }
    ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <table class="table table-bordered table-responsive table-hover">
            <tr>
                <th>Tên thương hiệu</th>
                <td>
                    <input type="text" name="txtTen" class="form-control"/>
                </td>
            </tr>       
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Lưu" class="btn btn-primary"/>
                    &nbsp;
                    <a href="<?php echo URL_BASE;?>admin/thuonghieu" class="btn btn-danger">Quay về trang quản lý Thương hiệu</a>
                </td>
            </tr>
        </table>
    </form>
</div>  <!--/.main-->
<?php } ?>