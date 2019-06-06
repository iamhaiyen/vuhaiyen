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
    <h2 class="page-header">Cập nhật thông tin đồng hồ</h2>
	<?php  
        $id = isset($_GET['id']) ? $_GET['id'] : die("ID không tồn tại");
        $database = new Libs_Model();
	    $db = $database->getConnection();
	    $objThuonghieu = new Admin_Models_ThuongHieu($db);
        $objDongho = new Admin_Models_Dongho($db);

	    $thuonghieu = $objThuonghieu->getAllThuongHieu(); 

        if ($_POST) {
            $objDongho->ten = $_POST['txtTen'];
            $objDongho->xuatXu = $_POST['txtXuatXu'];
            $objDongho->thuonghieu_id = $_POST['cbThuongHieu'];
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
            $objDongho->dongho_id = $id;

            if ($objDongho->updateDongHo()) {
                echo "<div class='alert alert-success'>Cập nhật thông tin đồng hồ thành công.</div>";
            }else{
                echo "<div class='alert alert-danger'>Cập nhật thông tin đồng hồ thất bại.</div>";
            }
        }
    ?>
    <?php  
        $objDongho->dongho_id = $id;
        $row = $objDongho->getDongHoById();
        $thuonghieuStmt = $objThuonghieu->getAllThuongHieu();
    ?>
    <form action="<?php ($_SERVER['PHP_SELF']."?id={$id}");?>" method="post" enctype="">
        <table class="table table-bordered table-hover table-responsive">
            <tr>
                <th>Tên</th>
                <td><input name="txtTen" type="text" value="<?php echo $row['ten'];?>" class="form-control"/></td>
            </tr>                
            <tr>
                <th>Xuất xứ</th>
                <td><input name="txtXuatXu" type="text" value="<?php echo $row['xuatXu'];?>" class="form-control"/></td>
            </tr>
            <tr>
                <th>Thương hiệu</th>
                <td>
                    <select name="cbThuongHieu" id="" class="form-control">
                        <?php
                        while($thuonghieu = $thuonghieuStmt->fetch(PDO::FETCH_ASSOC))
                        {
                            if($thuonghieu['thuonghieu_id'] == $row['thuonghieu_id']){
                        ?>
                                <option value="<?php echo $thuonghieu['thuonghieu_id'];?>" selected="true"><?php echo $thuonghieu['ten'];?></option>
                        <?php
                            }else{
                                ?>
                                <option value="<?php echo $thuonghieu['thuonghieu_id'];?>"><?php echo $thuonghieu['ten'];?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Hình ảnh</th>         
                <td></td>       
            </tr>
            <tr>
                <th>Kiểu máy</th>
                <td><input name="txtKieuMay" type="text" value="<?php echo $row['kieuMay'];?>" class="form-control"/></td>
            </tr>
            <tr>
                <th>Kích cỡ</th>
                <td><input name="txtKichCo" type="text" value="<?php echo $row['kichCo'];?>" class="form-control"/></td>
            </tr>
            <tr>
                <th>Chất liệu vỏ</th>
                <td>
                    <input type="text" name="txtChatLieuVo" value="<?php echo $row['chatLieuVo'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Dây</th>
                <td>
                    <input type="text" name="txtDay" value="<?php echo $row['day'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Chất liệu kính</th>
                <td>
                    <input type="text" name="txtChatLieuKinh" value="<?php echo $row['chatLieuKinh'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Độ chịu nước</th>
                <td>
                    <input type="text" name="txtDoChiuNuoc" value="<?php echo $row['doChiuNuoc'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Giá cũ</th>
                <td>
                    <input type="text" name="txtGiaCu" value="<?php echo $row['giaCu'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Giá mới</th>
                <td>
                    <input type="text" name="txtGiaMoi" value="<?php echo $row['giaMoi'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Bảo hành</th>
                <td>
                    <input type="text" name="txtBaoHanh" value="<?php echo $row['baoHanh'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Mô tả</th>
                <td>
                    <input type="text" name="txtMoTa" value="<?php echo $row['moTa'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>Bài viết chi tiết</th>
                <td><textarea id="txtBaiViet" name="txtBaiViet" class="form-control"><?php echo $row['baiViet'];?></textarea></td>
                <script>
                    CKEDITOR.replace('txtBaiViet');
                </script>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" class="btn btn-success" value="Cập nhật"/>
                    <a href="<?php echo URL_BASE;?>admin/dongho" class="btn btn-danger">Quay lại danh sách</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php } ?>