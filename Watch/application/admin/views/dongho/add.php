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
    $objThuonghieu = new Admin_Models_ThuongHieu($db);
    $thuonghieu = $objThuonghieu->getAllThuongHieu(); 
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
    <h2 class="page-header">Thêm mới đồng hồ</h2>
    <?php
    //Tiến hành lấy dữ liệu trên form
    if($_POST){         
        $fileName = $_FILES['txtAnh']['name'];
        $fileSize = $_FILES['txtAnh']['size'];
        $fileTmp = $_FILES['txtAnh']['tmp_name'];
        $fileType = $_FILES['txtAnh']['type'];
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
                $objDongho = new Admin_Models_Dongho($db);
                //Truyền giá trị lấy được từ Form cho các thuộc tính của Product
                $objDongho->ma = $_POST['txtMa'];
                $objDongho->ten = $_POST['txtTen'];
                $objDongho->xuatXu = $_POST['txtXuatXu'];
                $objDongho->thuonghieu_id = $_POST['cbThuongHieu'];
                $objDongho->anh = "templates/admin/uploads/".$fileName;

                $countfiles = count($_FILES['file']['name']);

                 // Looping all files
                for($i=0;$i<$countfiles;$i++){
                    $filenamePhu = $_FILES['file']['name'][$i];
                    for ($i = 0; $i < $countfiles; $i++) {
                        $filenamePhu = $_FILES['file']['name'][$i];

                        // Upload file
                        move_uploaded_file($_FILES['file']['tmp_name'][$i], "templates/admin/uploads/DetailWatch/" . $filenamePhu);
                        }
                    //Hiển thị chuỗi tên file
                    $image = implode(";", $_FILES['file']['name']);
                }    
                
                
                $objDongho->anhPhu = $image;                    
                $objDongho->kieuMay = $_POST['txtKieuMay'];
                $objDongho->kichCo = $_POST['txtKichCo'];
                $objDongho->chatLieuVo = $_POST['txtChatLieuVo'];
                $objDongho->day = $_POST['txtDay'];
                $objDongho->chatLieuKinh = $_POST['txtChatLieuKinh'];
                $objDongho->doChiuNuoc = $_POST['txtDoChiuNuoc'];
                $objDongho->giaCu = $_POST['txtGiaCu'];
                $objDongho->giaMoi = $_POST['txtGiaMoi'];
                $objDongho->baoHanh = $_POST['txtBaoHanh'];
                $objDongho->moTa = $_POST['txtMoTa'];
                $objDongho->baiViet = $_POST['txtBaiViet'];
                //Gọi phương thức addProduct
                if($objDongho->addDongHo()){
                    echo "<div class='alert alert-success'>
                Thêm sản phẩm thành công.</div>";
                }else{
                    echo "<div class='alert alert-danger'>
                Thêm sản phẩm thất bại.</div>";
                }
            }
        }else{
            echo $fileStatus;
        }
    }
    ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <table class="table table-bordered table-responsive table-hover">
            <tr>
                <th>Mã ĐH</th>
                <td>
                    <input type="text" name="txtMa" value="DH***" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Tên</th>
                <td>
                    <input type="text" name="txtTen" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Xuất xứ</th>
                <td>
                    <input type="text" name="txtXuatXu" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Thương hiệu</th>
                <td>
                    <select name="cbThuongHieu" class="form-control">
                    <?php
                    while($rows = $thuonghieu->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <option value="<?php echo $rows['thuonghieu_id'];?>">
                            <?php echo $rows['ten'];?>
                        </option>
                    <?php
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Ảnh chính</th>
                <td>
                    <input type="file" name="txtAnh" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Ảnh phụ</th>
                <td>
                    <input type="file" name="file[]" id="file" multiple>
                </td>
            </tr>
            <tr>
                <th>Kiểu máy</th>
                <td>
                    <input type="text" name="txtKieuMay" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Kích cỡ</th>
                <td>
                    <input type="text" name="txtKichCo" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Chất liệu vỏ</th>
                <td>
                    <input type="text" name="txtChatLieuVo" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Dây</th>
                <td>
                    <input type="text" name="txtDay" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Chất liệu kính</th>
                <td>
                    <input type="text" name="txtChatLieuKinh" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Độ chịu nước</th>
                <td>
                    <input type="text" name="txtDoChiuNuoc" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Giá cũ</th>
                <td>
                    <input type="text" name="txtGiaCu" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Giá mới</th>
                <td>
                    <input type="text" name="txtGiaMoi" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Bảo hành</th>
                <td>
                    <input type="text" name="txtBaoHanh" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Mô tả</th>
                <td>
                    <input type="text" name="txtMoTa" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Bài viết chi tiết</th>
                <td>
                    <textarea name="txtBaiViet"></textarea>
                </td>    
            </tr>
            <script>
                    CKEDITOR.replace('txtBaiViet');
            </script>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Lưu" class="btn btn-primary"/>
                    &nbsp;
                    <a href="<?php echo URL_BASE;?>admin/dongho" class="btn btn-danger">Quay về trang sản phẩm</a>
                </td>
            </tr>
        </table>
    </form>
</div> 
<?php } ?>