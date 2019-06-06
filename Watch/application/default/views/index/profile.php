<?php  
    //Hàm khởi động SESSION (Do websever sinh ra)
    session_start();
?>
<?php          
    if (!isset($_SESSION['email'])) {
        ?>
        <script>
            window.location = "<?php echo URL_BASE;?>";
        </script>
    <?php
    }else{
        $database = new Libs_Model();
        $db = $database->getConnection(); 
        $objKhachHang = new Default_Models_KhachHang($db);
        $objKhachHang->email = $_SESSION['email'];
        $khachHang = $objKhachHang->getKhachHangByInfo();
        $donhang = new Default_Models_Donhang($db);
        $donhang->khachhang_id = $khachHang['khachhang_id'];
        $objDonHang = $donhang->getDonHangByKhachHangId();
        ?>
<content class="container-fluid">
    <div class="container bootstrap snippet" id="result2" style="margin-top: 90px;">
        <div class="row">
            <div class="col-sm-3"><!--left col-->     
                <div class="p-watch">
                    <a href="#"><p class="left-post">THÔNG TIN CÁ NHÂN</p></a>
                </div></hr>                   
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-envelope fa-1x"></i> <b>Email</b></div>
                    <div class="panel-body"><p><?php echo $khachHang['email']; ?></p></div>
                    <div class="panel-heading"><i class="fa fa-id-badge fa-1x"></i> <b>Họ và tên</b></div>
                    <div class="panel-body"><p><?php echo $khachHang['ten']; ?></p></div>
                    <div class="panel-heading"><i class="fa fa-phone fa-1x"></i> <b>Điện thoại</b></div>
                    <div class="panel-body"><p><?php echo $khachHang['soDienThoai']; ?></p></div>
                    <div class="panel-heading"><i class="fa fa-home fa-1x"></i> <b>Địa chỉ</b></div>
                    <div class="panel-body"><p><?php echo $khachHang['diaChi']; ?></p></div>
                </div> 
            </div><!--/col-3-->

            <div class="col-sm-9">
                <ul class="nav nav-tabs nav-pills">
                    <li class="active"><a data-toggle="tab" href="#donHang" class="tab-Profile">Đơn hàng</a></li>
                    <li><a data-toggle="tab" href="#updateProfile" class="tab-Profile">Sửa thông tin</a></li>
                    <li><a data-toggle="tab" href="#rePassword" class="tab-Profile">Đổi MK</a></li>
                </ul>
                <div class="tab-content">
                    <br>
                    <div class="tab-pane active" id="donHang"> 
                    <?php if ($objDonHang != NULL) { ?> 
                        <table id="result" class="table table-bordered table-responsive table-hover text-center">
                            <thead>
                                <th class="text-center">Đồng hồ</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Đơn giá</th>
                                <th class="text-center">Thành tiền</th>
                                <th class="text-center">Trạng thái</th>
                            </thead>
                        <?php 
                            $total=0;
                            while ($row = $objDonHang->fetch(PDO::FETCH_ASSOC)) {
                                extract($row);                       
                            ?>
                            <tr>
                                <td><?php  
                                    $database = new Libs_Model();
                                    $db = $database->getConnection();
                                    $dongho = new Default_Models_Dongho($db);
                                    $dongho->dongho_id = $dongho_id;
                                    $RowDH = $dongho->getDongHoById();
                                    ?>
                                    <?php echo $RowDH['ten']; ?>
                                </td>                
                                <td><?php echo $soLuong;?></td>
                                <td><?php echo $thanhTien/$soLuong;?></td>
                                <td><?php echo $thanhTien;?></td>
                                <td>
                                    <?php  
                                    if ($trangThai != "") {
                                        echo $trangThai;
                                    }else{
                                        echo "Chưa giao";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php 
                                $total+=$thanhTien;
                            } 
                            ?>
                        </table> 
                        <p style="font-size: 18px;float: right;"><b>Tổng tiền: <i>$<?php echo $total; ?></b></i></span></p>
                    <?php }
                        else{echo "<div class='alert alert-danger'>Bạn chưa có đơn hàng!</div>";} 
                    ?>
                    </div><!--/tab-pane-->

                    <div class="tab-pane" id="updateProfile">
                        <?php  
                            if (isset($_POST['updateProfile'])) {                             
                                $objKhachHang->ten = $_POST['txtTen'];
                                $objKhachHang->soDienThoai = $_POST['txtSoDienThoai'];
                                $objKhachHang->diaChi = $_POST['txtDiaChi'];
                                if ($objKhachHang->updateProfileKhachHang()) {
                                    // echo "<div class='alert alert-success'>Cập nhật thông tin thành công.</div>";
                                    ?>
                                    <script>
                                        alert("Cập nhật thông tin thành công!");
                                        window.location = "<?php echo URL_BASE;?>profile";
                                    </script>
                                    <?php
                                }else{
                                    echo "<div class='alert alert-danger'>Cập nhật thông tin thất bại.</div>";
                                }
                            }
                        ?>
                        <form class="form" action="<?php ($_SERVER['PHP_SELF']);?>" method="post" id="registrationForm">                    
                            <div class="col-xs-6">
                                <label><h4>Họ và tên:</h4></label>
                                <input type="text" class="form-control" name="txtTen" id="first_name" placeholder="Nhập họ và tên" value="<?php echo $khachHang['ten'];?>">
                            </div>                               
                                                      
                            <div class="col-xs-6">
                                <label><h4>Số điện thoại:</h4></label>
                                <input type="text" class="form-control" name="txtSoDienThoai" id="phone" placeholder="Nhập số điện thoại" value="<?php echo $khachHang['soDienThoai'];?>">
                            </div>                               
                                                     
                            <div class="col-xs-12">
                                <label><h4>Địa chỉ</h4></label>
                                <input type="text" class="form-control" name="txtDiaChi" id="diaChi" placeholder="Nhập địa chỉ" value="<?php echo $khachHang['diaChi'];?>">
                            </div>
                            
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-md btn-danger" name="updateProfile" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
                                    <button class="btn btn-md" type="reset"><i class="glyphicon glyphicon-repeat"></i> Hủy</button>
                                </div>
                            </div>
                        </form>                  
                        <hr>                  
                    </div><!--/tab-pane-->
                        
                    <div class="tab-pane" id="rePassword">  
                        <?php  
                        if (isset($_POST['changePassword'])) {      
                            $objKhachHang->password = $_POST['txtPassword'];
                            if ($objKhachHang->checkPasswordKhachHang()) {   
                                if ($_POST['txtRePassword'] == $_POST['txtSSPassword']) {
                                    $objKhachHang->password = $_POST['txtRePassword'];
                                    if ($objKhachHang->updatePasswordKhachHang()) {
                                        ?>
                                        <script>
                                            alert("<?php echo "Đổi mật khẩu thành công!" ?>");
                                            window.location = "<?php echo URL_BASE;?>profile";
                                        </script>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <script>
                                        alert("<?php echo "Mật khẩu mới nhập không trùng nhau!"?>");
                                    </script>
                                    <?php
                                }    
                            }else{
                                ?>
                                <script>
                                    alert("<?php echo "Nhập sai mật khẩu cũ!"?>");
                                </script>
                                <?php
                            }                                                                   
                        }
                        ?>
                        <form class="form" action="<?php ($_SERVER['PHP_SELF']);?>" method="post" id="registrationForm">                    
                            <div class="col-xs-12">
                                <label><h4>Mật khẩu cũ</h4></label>
                                <input type="password" class="form-control" name="txtPassword" id="phone" placeholder="Nhập mật khẩu cũ">
                            </div>                               
                                                     
                            <div class="col-xs-12">
                                <label><h4>Mật khẩu mới</h4></label>
                                <input type="password" class="form-control" name="txtRePassword" id="diaChi" placeholder="Nhập mật khẩu mới">
                            </div>

                            <div class="col-xs-12">
                                <label><h4>Nhập lại mật khẩu mới</h4></label>
                                <input type="password" class="form-control" name="txtSSPassword" id="diaChi" placeholder="Nhập lại mật khẩu mới">
                            </div>                            
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-md btn-danger" name="changePassword" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Đổi mật khẩu</button>
                                    <button class="btn btn-md" type="reset"><i class="glyphicon glyphicon-repeat"></i> Hủy</button>
                                </div>
                            </div>
                        </form>                  
                        <hr>                  
                    </div><!--/tab-pane-->

                </div><!--/tab-pane-->
            </div><!--/tab-content-->
        </div><!--/col-9-->
    </div><!--/row-->
</content>   
<style type="text/css">
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    color: #fff;
    background-color: #C9302C;
}
</style>
<?php } ?>