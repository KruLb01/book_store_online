<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/main.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="icon" type="image/png" sizes="16x16" href="../../admin/static/plugins/images/favicon.png">
        <script src='../../assets/js/post_method.js'></script>
        <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
        <title>Giỏ hàng</title>
        <style>
            table thead th:not(:nth-child(2)){
                text-align: center;
            }
            table tbody td:not(:nth-child(2))
            {
                text-align: center;
            }
            td > img {
                width:100px;
            }
            .btns{
                display:flex;
                justify-content: center;
            }
            .btns > button {
                margin-left: 10px;
                margin-right: 10px;
            }
            .cart-header {
                padding:0 20px 0 5px;
                display:flex;
                justify-content: space-between;
            }
            .fa-trash {
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <script type="text/javascript">
            if(<?php if(isset($_SESSION['customer']) && $_SESSION['customer']){echo 1;}else{echo 0;} ?>){
                //do nothing
            }
            else post_to_url("../customer/login.php",{next:window.location.href});
        </script>
        <div id="wrapper">
            <?php include_once 'header.php'; ?>
            <div class="cart" style="padding:20px;">
                <div class="cart-header">
                    <h3>Giỏ hàng của bạn</h3>
                    <i class="fas fa-trash delete-products"></i>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Tên sách</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Loại sách</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng mua</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $total=0;
                        $amount=0;
                        if(isset($_SESSION['cart']) && $_SESSION['cart'] !== array()){
                            $stt = 0;
                            foreach($_SESSION['cart'] as $prodID => $value)
                            {
                                foreach($value as $booktype => $value1)
                                {
                                    echo '<tr>
                                            <td>
                                                <input type="checkbox" id="'.$stt.'" class="delete" value="'.$prodID.'" />
                                                <label for="'.$stt.'"></label>
                                            </td>
                                            <td>'.$value1['tensach'].'</td>
                                            <td><img src="../../images/'.$value1['hinhanh'].'"/></td>
                                            <td>'.$booktype.'</td>
                                            <td>'.number_format($value1['giatien'],0, '', '.').'<sup>đ</sup></td>
                                            <td>'.$value1['soluong'].'</td>'
                                         .'</tr>';
                                    $amount += $value1['soluong'];
                                    $total += $value1['giatien'] * $value1['soluong'];
                                    $stt++;
                                }
                            }
                            echo '<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>Tổng tiền:</b> '.number_format($total,0, '', '.')."<sup>đ</sup>".'</td>
                                    <td><b>Số lượng:</b> '.$amount.'</td>
                                 </tr>';
                        }
                    ?>
                    </tbody>
                </table>
                <div class="btns">
                    <button class="primary" onclick="location.href='thanhtoan.php'">Đi đến trang thanh toán</button>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/js/jquery.scrolly.min.js"></script>
	<script src="../../assets/js/jquery.scrollex.min.js"></script>
	<script src="../../assets/js/main.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".delete-products").click(function(e){
                    e.preventDefault();
                    var delProds = [];
                    $("input[type='checkbox']").each(function(index){
                        if($(this).is(":checked")){
                            delProds.push(index);
                        }
                    });
                    $.ajax({
                        url: "../../handle/handle_cart.php",
                        type: "POST",
                        data: {
                            action:"delete",
                            delProds: delProds
                        },
                        success: function(reps)
                        {
                            var getData = JSON.parse(reps);
                            alert(getData.message);
                            if(getData.success)
                            {
                                window.location.reload();
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>