<content class="soSanhWatch container-fluid">
    <div class="container" id="result2" style="margin-top: 90px;">
        <div class="row">
            <div class="col-md-12 col-xs-12">                   
                <div class="p-watch1">
                    <a href="#"><p class="left-post">GIỎ HÀNG</p></a>
                </div>                                                  
            </div>
        </div>
        <?php 
            $count = count($_SESSION['cart_item']);
            if ($count>0) {
        ?>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-responsive">
                    <style type="text/css">
                        th{
                            text-align: center;
                        }
                    </style>
                    <tr>
                        <th class="col-md-2">Tên SP</th>
                        <th class="col-md-2">Ảnh SP</th>
                        <th class="col-md-2">Số lượng</th>
                        <th class="col-md-2">Đơn giá</th>
                        <th class="col-md-2">Thành tiền</th>
                        <th class="col-md-2">Xóa sản phẩm</th>
                    </tr>
                    <?php  
                        $total=0;
                        foreach ($_SESSION['cart_item'] as $key => $value){
                    ?>
                    <tr>
                        <td class="col-md-2"><?php echo $value['ten']; ?></td>
                        <td class="col-md-2"><img src="<?php echo URL_BASE;?><?php echo $value['anh'];?>" style="width: 40px;"></td>
                        <td class="col-md-2">                       
                            <?php  
                            if (isset($_POST['updateSL_'.$key])) {
                                $_SESSION['cart_item'][$key]["quantity"] = $_POST['sl_'.$key];
                                ?>
                                <script>
                                    window.location = "<?php echo URL_BASE;?>index/cart";
                                </script>
                                <?php
                            }
                            ?> 
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                                <input type="number" name="sl_<?php echo $key; ?>" value="<?php echo $value['quantity']; ?>" min="1" style="border: 1px solid black;text-align: center; color: red;width: 50%; border-radius: 5px;margin-top:0">
                                <button class="btn btn-xs btn-danger" type="submit" name="updateSL_<?php echo $key; ?>" 
                                >Cập nhật</button>
                            </form>        
                        </td>
                        <td class="col-md-2"><?php echo $value['giaMoi'] ?></td>
                        <td class="col-md-2"><b><?php echo ($value['giaMoi']*$value['quantity']); ?></b></td>
                        <td class="col-md-2">                               
                            <a href="<?php echo URL_BASE.'index/deleteToCart/?id='. $value['ma']; ?>" class="btn btn-sm btn-danger">Xóa</a>   
                        </td>
                    </tr>  
                    <?php
                    $total+=$value['giaMoi']*$value['quantity'];
                    }
                ?>                     
                </table>       
                <p style="font-size: 18px"><b>Tổng số tiền: </b><span><i><b>$<?php echo $total; ?></b></i></span></p>
                <br>
                <div style="float: left;">
                    <a href="<?php echo URL_BASE;?>" class="btn btn-primary">Tiếp tục mua hàng</a>
                    <a href="<?php echo URL_BASE;?>index/thanhToan" class="btn btn-danger">Thanh toán</a>   
                </div>                  
            </div>
        </div>
        <?php }else{ echo "<div class='alert alert-danger'>Giỏ hàng trống!</div>"; } ?>
    </div>
</content>