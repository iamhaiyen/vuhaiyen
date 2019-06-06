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
    <h2 class="page-header">Thêm mới Slide</h2>
    <?php
    //Tiến hành lấy dữ liệu trên form
    if($_POST){         
        $fileName = $_FILES['Anh']['name'];
        $fileSize = $_FILES['Anh']['size'];
        $fileTmp = $_FILES['Anh']['tmp_name'];
        $fileType = $_FILES['Anh']['type'];
        $fileStatus = "";
        //Kiểm tra tính xác thực của file upload
        if($fileSize>=2048000){
            $fileStatus = "<div class='alert alert-danger'>
                Không được phép upload file quá 2MB</div>";
        }
        
        //Kiểm tra trạng thái của file upload
        if(empty($fileStatus)){
            if(move_uploaded_file($fileTmp,"templates/admin/uploads/".$fileName)){
                //Khởi tạo đối tượng Product  
                $objSlide = new Admin_Models_Slide($db);
                //Truyền giá trị lấy được từ Form cho các thuộc tính của Product
                $objSlide->anh = "templates/admin/uploads/".$fileName;
                //Gọi phương thức addProduct
                if($objSlide->addSlide()){
                    echo "<div class='alert alert-success'>
                Thêm mới Slide thành công.</div>";
                }else{
                    echo "<div class='alert alert-danger'>
                Thêm mới Slide thất bại.</div>";
                }
            }
        }else{
            echo $fileStatus;
        }
    }
    ?>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        <table class="table table-bordered table-responsive table-hover">
            <tr>
                <th>Slide</th>
                <td>
                    <input type="file" name="Anh" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Lưu" class="btn btn-primary"/>
                    &nbsp;
                    <a href="<?php echo URL_BASE;?>admin/slide" class="btn btn-danger">Quay về trang quản lý Slide</a>
                </td>
            </tr>
        </table>
    </form>
</div>  <!--/.main-->
<?php } ?>