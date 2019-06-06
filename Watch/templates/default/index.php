<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">   
    <link rel="stylesheet" href="<?php echo URL_BASE;?>templates/default/css/animate.css" media="screen">
    <link rel="stylesheet" href="<?php echo URL_BASE;?>templates/default/css/style.css">    
    <link rel="stylesheet" href="<?php echo URL_BASE;?>templates/default/css/style1.css">
    <link rel="stylesheet" href="<?php echo URL_BASE;?>templates/default/css/style3.css">
    <link rel="stylesheet" href="<?php echo URL_BASE;?>templates/default/css/style4.css">
    <link rel="stylesheet" href="<?php echo URL_BASE;?>templates/default/css/style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE;?>templates/default/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE;?>templates/default/dist/assets/owl.theme.default.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="icon" href="<?php echo URL_BASE;?>templates/default/img/icon.png">
    <script src="<?php echo URL_BASE;?>templates/default/dist/owl.carousel.js"></script>
    <script src="<?php echo URL_BASE;?>templates/default/js/dung.js"></script>
    <script src="<?php echo URL_BASE;?>templates/default/js/sang.js"></script>
    <script src="<?php echo URL_BASE;?>templates/default/js/quantity.js"></script>
    <title>Watch</title>
    <script type="text/javascript">

        function showproduct(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("cart").innerHTML = "<?php echo count($_SESSION['cart_item']);?>";
                }
            };

            xmlhttp.open("GET", "<?php echo URL_BASE;?>show", true);
            xmlhttp.send();
        }

        function livesale(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("cart").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "<?php echo URL_BASE;?>addtocart/?id="+id+"&quantity=1", true);
            xmlhttp.send();
            //alert(id);
        }

        function showSoSanh(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("soSanh").innerHTML = "<?php echo count($_SESSION['soSanh_item']);?>";
                    document.getElementById("soSanh1").innerHTML = "<?php echo count($_SESSION['soSanh_item']);?>";
                }
            };

            xmlhttp.open("GET", "<?php echo URL_BASE;?>soSanh", true);
            xmlhttp.send();
        }

        function liveSoSanh(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("soSanh").innerHTML = this.responseText;
                    document.getElementById("soSanh1").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "<?php echo URL_BASE;?>addSoSanh/?id="+id+"&quantity=1", true);
            xmlhttp.send();
            //alert(id);
        }

        function showSearch(){
            var search = document.getElementById("txtSearch1").value;
            if (search.length == 0) {
                document.getElementById("result2").innerHTML = "<div class='alert alert-danger'>Chưa nhập sản phẩm cần tìm kiếm</div>";
            }else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("result2").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","<?php echo URL_BASE;?>search/?ten="+search,true);
                xmlhttp.send();
            }
        }
        function showSearchXS(){
            var search = document.getElementById("txtSearchXS").value;
            if (search.length == 0) {
                document.getElementById("result2").innerHTML = "<div class='alert alert-danger'>Chưa nhập sản phẩm cần cần tìm kiếm</div>";
            }else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("result2").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","<?php echo URL_BASE;?>searchXS/?tenXS="+search,true);
                xmlhttp.send();
            }
        }

        function locTheoGia(mucGia) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("locTheoGia").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("GET","<?php echo URL_BASE;?>locTheoGia/?mucGia="+mucGia,true);
            xmlhttp.send();
        }
    </script>
</head>
<body onload="showproduct();">
    <?php require 'templates/default/top.php';?>
    <?php require TEMPLATE;?>
    <?php require 'templates/default/bottom.php';?>