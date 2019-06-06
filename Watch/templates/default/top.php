<?php
//Hàm khởi động SESSION (Do websever sinh ra)
session_start();
?>
<?php
if (isset($_SESSION['email'])) {
    $database = new Libs_Model();
    $db = $database->getConnection();
    $objKhachHang = new Default_Models_KhachHang($db);
    $objKhachHang->email = $_SESSION['email'];
    $khachHang = $objKhachHang->getKhachHangByInfo();
    ?>
    <div class="headerA">
        <div class="header1">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-xs-8">
                            <a href="<?php echo URL_BASE; ?>"><img
                                        src="<?php echo URL_BASE; ?>templates/default/img/logo.png" id="logo1"
                                        alt="Logo" style="width: 180px"></a>
                        </div>
                        <div class="col-md-6 hidden-xs">
                            <div class="container-fluid">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nhập từ khoá tìm kiếm"
                                           id="txtSearch1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" onclick="showSearch()">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                            <a href="<?php echo URL_BASE; ?>index/cart" style="color: black;"
                               class="animated swing glyphicon glyphicon-shopping-cart cart"><span id="cart"
                                                                                                   class="badge"
                                                                                                   style="background-color: #F02828;margin-left: 3px;"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="nav1">
                <div class="container">
                    <div class="row">
                        <div class="search-nav hidden-lg hidden-md hidden-sm">

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" id="txtSearchXS">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger" onclick="showSearchXS()">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="navbar-header" style="width: 20%;float: right;">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php"><span
                                            class="glyphicon glyphicon-home return-home1 animated"
                                            style="font-size: 16px"></span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle dropdown-menu-right" data-toggle="dropdown">THƯƠNG
                                    HIỆU<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php
                                    $database = new Libs_Model();
                                    $db = $database->getConnection();
                                    $thuonghieu = new Default_Models_ThuongHieu($db);
                                    $objThuongHieu = $thuonghieu->getAllThuongHieu();
                                    while ($rowThuongHieu = $objThuongHieu->fetch(PDO::FETCH_ASSOC)) {
                                        extract($rowThuongHieu);
                                        ?>
                                        <li>
                                            <a href="<?php echo URL_BASE; ?>index/category?th=<?php echo $thuonghieu_id; ?>"
                                               style="color: black;"><?php echo $ten; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a id="soSanh" href="<?php echo URL_BASE; ?>index/soSanh">BẢNG SO SÁNH</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo "<li class='dropdown'>
                                            <a href='#' class='dropdown-toggle dropdown-menu-right' data-toggle='dropdown'>" . $khachHang['email'] . "<b class='caret'></b></a>
                                            <ul class='dropdown-menu'>
                                                <li><a href='profile' style='color: black;'>Quản lý tài khoản</a></li>
                                                <li><a href='logout' style='color: black;' style='color: black;'>Đăng xuất</a></li>
                                            </ul>
                                        </li>";
                            }
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle dropdown-menu-right" data-toggle="dropdown">LIÊN HỆ -
                                    HỎI ĐÁP <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo URL_BASE; ?>index/thongTinLienHe" style="color: black;">Thông
                                            tin liên hệ</a></li>
                                    <li><a href="<?php echo URL_BASE; ?>index/thacMacGopY" style="color: black;"
                                           style="color: black;">Thắc mắc - Góp ý</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div> <!-- End Header -->
    <?php
} else {
    ?>
    <div class="headerA">
        <div class="header1">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-xs-8">
                            <a href="<?php echo URL_BASE; ?>"><img
                                        src="<?php echo URL_BASE; ?>templates/default/img/logo.png" id="logo1"
                                        alt="Logo" style="width: 180px"></a>
                        </div>
                        <div class="col-xs-6  col-md-6 hidden-xs">
                            <div class="container-fluid">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nhập từ khoá tìm kiếm"
                                           id="txtSearch1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" onclick="showSearch()">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-4">
                            <a href="<?php echo URL_BASE; ?>index/cart" style="color: black;"
                               class=" animated swing glyphicon glyphicon-shopping-cart cart"><span id="cart"
                                                                                                    class="badge"
                                                                                                    style="background-color: #F02828;margin-left: 3px;"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="nav1">
                <div class="container">
                    <div class="row">
                        <div class="search-nav hidden-lg hidden-md hidden-sm">

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" id="txtSearchXS">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger" onclick="showSearchXS()">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="navbar-header" style="width: 20%;float: right;">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?php echo URL_BASE; ?>"><span
                                            class="glyphicon glyphicon-home return-home1 animated"
                                            style="font-size: 16px"></span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle dropdown-menu-right" data-toggle="dropdown">THƯƠNG
                                    HIỆU<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php
                                    $database = new Libs_Model();
                                    $db = $database->getConnection();
                                    $thuonghieu = new Default_Models_ThuongHieu($db);
                                    $objThuongHieu = $thuonghieu->getAllThuongHieu();
                                    while ($rowThuongHieu = $objThuongHieu->fetch(PDO::FETCH_ASSOC)) {
                                        extract($rowThuongHieu);
                                        ?>
                                        <li>
                                            <a href="<?php echo URL_BASE; ?>index/category?th=<?php echo $thuonghieu_id; ?>"
                                               style="color: black;"><?php echo $ten; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li><a id="soSanh" href="<?php echo URL_BASE; ?>index/soSanh">BẢNG SO SÁNH</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href='#' data-toggle='modal' data-target='#login-modal'>ĐĂNG NHẬP</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle dropdown-menu-right" data-toggle="dropdown">LIÊN HỆ -
                                    HỎI ĐÁP <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo URL_BASE; ?>index/thongTinLienHe" style="color: black;">Thông
                                            tin liên hệ</a></li>
                                    <li><a href="<?php echo URL_BASE; ?>index/thacMacGopY" style="color: black;"
                                           style="color: black;">Thắc mắc - Góp ý</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div> <!-- End Header -->
    <!-- BEGIN # MODAL LOGIN -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <img id="img_logo" src="<?php echo URL_BASE; ?>templates/default/img/logo.png" style="width: 300%">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </div>

                <!-- Begin # DIV Form -->
                <div id="div-forms">
                    <!-- Begin # Login Form -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="login-form">
                        <div class="modal-body">

                            <?php
                            if (isset($_POST['login'])) {
                                $database = new Libs_Model();
                                $db = $database->getConnection();
                                $objKhachHang = new Default_Models_KhachHang($db);

                                $objKhachHang->email = $_POST['txtEmail'];
                                $objKhachHang->password = $_POST['txtPassword'];
                                if ($objKhachHang->checkKhachHang()) {
                                    $_SESSION['email'] = $objKhachHang->email;
                                    //Điều hướng tới 'index'
                                    ?>
                                    <script>
                                        alert("<?php echo "Đăng nhập thành công!" ?>");
                                        window.location = "<?php echo URL_BASE;?>";
                                    </script>
                                <?php
                                }else{
                                //echo "<div class='alert alert-danger'>Tài khoản không tồn tại!</div>";
                                ?>
                                    <script>
                                        confirm("Tài khoản không tồn tại!");
                                    </script>
                                    <?php
                                }
                            }
                            ?>
                            <div id="div-login-msg">
                                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"
                                     style="top: 0px;"></div>
                                <span id="text-login-msg">Nhập tên đăng nhập và mật khẩu.</span>
                            </div>
                            <input id="login_username" class="form-control" name="txtEmail" type="text"
                                   placeholder="Tên đăng nhập" required>
                            <input id="login_password" class="form-control" name="txtPassword" type="password"
                                   placeholder="Mật khẩu" required>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox">Ghi nhớ tài khoản
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" name="login" class="btn btn-danger btn-lg btn-block">Đăng nhập
                                </button>
                            </div>
                            <div>
                                <button id="login_lost_btn" type="button" class="btn btn-link" style="float: left;">Quên
                                    mật khẩu?
                                </button>
                                <button id="login_register_btn" type="button" class="btn btn-link">Đăng ký</button>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn btn-primary btn-alt btn-facebook">Đăng nhập bằng
                                <i class="fa fa-facebook s20 ml5 mr0"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-alt  btn-google">Đăng nhập bằng
                                <i class="fa fa-google-plus s20 ml5 mr0"></i>
                            </a>
                        </div>
                    </form>
                    <!-- End # Login Form -->

                    <!-- Begin | Lost Password Form -->
                    <form id="lost-form" style="display:none;">
                        <div class="modal-body">
                            <div id="div-lost-msg">
                                <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"
                                     style="top: 0px;"></div>
                                <span id="text-lost-msg">Nhập e-mail khôi phục mật khẩu.</span>
                            </div>
                            <input id="lost_email" class="form-control" type="text" placeholder="E-Mail" required>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-danger btn-lg btn-block">Gửi</button>
                            </div>
                            <div>
                                <button id="lost_login_btn" type="button" class="btn btn-link" style="float: left;">Đăng
                                    nhập
                                </button>
                                <button id="lost_register_btn" type="button" class="btn btn-link">Đăng ký</button>
                            </div>
                        </div>
                    </form>
                    <!-- End | Lost Password Form -->

                    <!-- Begin | Register Form -->
                    <?php
                    if (isset($_POST['register'])) {
                        $database = new Libs_Model();
                        $db = $database->getConnection();
                        $objKhachHang1 = new Default_Models_KhachHang($db);

                        $objKhachHang1->email = $_POST['txtEmailRegister'];
                        $objKhachHang1->password = $_POST['txtPasswordRegister'];
                        $objKhachHang1->ten = $_POST['txtTen'];

                        //check email and send mail
                        if ($objKhachHang1->checkEmail() == 0) {
                            if ($objKhachHang1->addKhachHang()) {
                                $objKhachHang1->sendMail($objKhachHang1->email);
                                ?>
                                <script>
                                    alert("<?php echo "Đăng ký tài khoản thành công!" ?>");
                                    window.location = "<?php echo URL_BASE;?>";
                                </script>
                                <?php
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Đăng ký thất bại.</div>";
                        }
                    }
                    ?>
                    <form id="register-form" style="display:none;" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="modal-body">
                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"
                                     style="top: 0px;"></div>
                                <span id="text-register-msg">Đăng ký tài khoản mới.</span>
                            </div>
                            <p style="margin-top: 5px; margin-bottom: 0px;">Email: </p>
                            <input class="form-control" type="email" name="txtEmailRegister" placeholder="E-Mail"
                                   required>
                            <p style="margin-top: 0px; margin-bottom: 0px;">Mật khẩu: </p>
                            <input class="form-control" type="password" name="txtPasswordRegister"
                                   placeholder="Mật khẩu" required>
                            <p style="margin-top: 0px; margin-bottom: 0px;">Họ và tên: </p>
                            <input class="form-control" type="text" name="txtTen" placeholder="Họ và tên" required>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" name="register" class="btn btn-danger btn-lg btn-block">Đăng ký
                                </button>
                            </div>
                            <div>
                                <button id="register_login_btn" type="button" class="btn btn-link" style="float: left;">
                                    Đăng nhập
                                </button>
                                <button id="register_lost_btn" type="button" class="btn btn-link">Quên mật khẩu?
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- End | Register Form -->
                </div>
                <!-- End # DIV Form -->
            </div>
        </div>
    </div>
    <!-- End Sign -->
<?php } ?>

