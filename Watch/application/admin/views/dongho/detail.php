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
    $dataDongHo = $this->result; 
    $dataThuongHieu = $this->result1;
    ?>
    <h2 class="page-header"><b><?php echo $dataDongHo['ten'];?></b></h2>
    <table class="table table-bordered table-responsive table-hover">
        <tr>
            <th>ID</th>
            <td><?php echo $dataDongHo['dongho_id'];?></td>
        </tr>
        <tr>
            <th>Mã ĐH</th>
            <td><?php echo $dataDongHo['ma'];?></td>
        </tr>
        <tr>
            <th>Tên</th>
            <td><?php echo $dataDongHo['ten'];?></td>
        </tr>
        <tr>
            <th>Xuất xứ</th>
            <td><?php echo $dataDongHo['xuatXu'];?></td>
        </tr>
        <tr>
            <th>Thương hiệu</th>
            <td><?php echo $dataThuongHieu['ten'];?></td>
        </tr>
        <tr>
            <th>Hình ảnh</th>
            <td>
                <img src="<?php echo URL_BASE;?><?php echo $dataDongHo['anh']; ?>" style="width: 15%">
            </td>
        </tr>
        <tr>
            <th>Ảnh phụ</th>
            <td>
                <?php
                $imgArr = explode(";", $dataDongHo['anhPhu']); 
                for($i=0; $i<count($imgArr); $i++){ ?>
                    <img src="<?php echo URL_BASE;?>templates/admin/uploads/DetailWatch/<?php echo $imgArr[$i]; ?>" width='100px' height='100'>
                <?php 
                } 
                ?>                
            </td>
        </tr>
        <tr>
            <th>Kiểu máy</th>
            <td><?php echo $dataDongHo['kieuMay'];?></td>
        </tr>
        <tr>
            <th>Kích cỡ</th>
            <td><?php echo $dataDongHo['kichCo'];?></td>
        </tr>
        <tr>
            <th>Chất liệu vỏ</th>
            <td><?php echo $dataDongHo['chatLieuVo'];?></td>
        </tr>
        <tr>
            <th>Dây</th>
            <td><?php echo $dataDongHo['day'];?></td>
        </tr>
        <tr>
            <th>Chất liệu kính</th>
            <td><?php echo $dataDongHo['chatLieuKinh'];?></td>
        </tr>
        <tr>
            <th>Độ chịu nước</th>
            <td><?php echo $dataDongHo['doChiuNuoc'];?></td>
        </tr>
        <tr>
            <th>Giá cũ</th>
            <td><?php echo $dataDongHo['giaCu'];?></td>
        </tr>
        <tr>
            <th>Giá mới</th>
            <td><?php echo $dataDongHo['giaMoi'];?></td>
        </tr>
        <tr>
            <th>Bảo hành</th>
            <td><?php echo $dataDongHo['baoHanh'];?></td>
        </tr>
        <tr>
            <th>Mô tả</th>
            <td><?php echo $dataDongHo['moTa'];?></td>
        </tr>
        <tr>
            <th>Bài viết chi tiết</th>
            <td><?php echo $dataDongHo['baiViet'];?></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="<?php echo URL_BASE;?>admin/dongho" class="btn btn-danger">Quay về trang danh sách</a>
            </td>
        </tr>
    </table>
</div>	<!--/.main-->
<?php } ?>