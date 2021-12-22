<?php 
    session_start();
    include_once '../../class/shipment_method.php';
    $shipment_methodModel = new shipment_method();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset='UTF-8' />
        <title>ReadBok | Thanh toán giỏ hàng </title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/main.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="icon" type="image/png" sizes="16x16" href="../../admin/static/plugins/images/favicon.png">
        <script src='../../assets/js/post_method.js'></script>
        <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
        <style>
            .mid{
                padding: 10px;
            }
            .header-content {
                padding-left: 20px;
            }
            hr {
                border: 1px black solid;
            }
            table thead th:not(:first-child){
                text-align: center;
            }
            table tbody td:not(:first-child)
            {
                text-align: center;
            }
            td > img {
                width:100px;
            }
            .submit-checkout{
                display:flex;
                justify-content: center;
            }
            .total-after-sale span {
                font-weight: bold;
                
            }
            .total div {
                display:flex;
                flex-wrap: wrap;
                justify-content: space-between;
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
        <div id='wrapper'>
            <header id='header'>
                <div class='inner'>
                <!-- Logo -->
                    <a href='../index.php' class='logo'>
                        <span class='fa fa-book'></span><span class='title'>ReadBok</span>
                    </a>
                <!-- Nav -->
                    <nav>
                        <ul>
                            <li><a href='#menu'>Menu</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <!-- Menu -->
            <nav id='menu'>
                <h2>Menu</h2>
                    <ul>
                        <li><a href='../index.php'>Trang chủ</a></li>
                        <li><a href='products.php'>Sản phẩm</a></li>
                        <li>
                            <a href='#' class='dropdown-toggle'>Giới thiệu</a>
                                <ul>
                                    <li><a href='about.html'>Về chúng tôi</a></li>
                                    <li><a href='blog.html'>Blog</a></li>
                                    <li><a href='testimonials.html'>Các bài viết đánh giá</a></li>
                                    <li><a href='terms.html'>Terms</a></li>
                                </ul>
                            </li>
                        <li><a href='contact.html'>Liên hệ chúng tôi</a></li>
                        <?php
                            if (isset($_SESSION["customer"])) {
                                echo "<li>
                                         <a href='#' class='dropdown-toggle'><i class='fas fa-user' style='padding-right: 0.2rem'></i> {$_SESSION['customer']['User']}</a>
                                      <ul>
                                      <li><a href='./customer/profile.php'><i class='fas fa-id-badge' style='padding-right: 0.6rem'></i> Hồ sơ</a></li>
                                      <li><a href='./customer/change_password.php'><i class='fas fa-key' style='padding-right: 0.2rem'></i> Đổi mật khẩu</a></li>
                                      <li><a href='./index.php' class='active'><i class='fas fa-shopping-cart' style='padding-right: 0.25rem'></i> Giỏ hàng</a></li>
                                      <li><a href='testimonials.html'><i class='fas fa-receipt' style='padding-right: 0.7rem'></i> Đơn hàng</a></li>
                                      <li><a href='../../handle/handle_account.php?logout=logout'><i class='fas fa-sign-out-alt' style='padding-right: 0.35rem'></i> Đăng xuất</a></li>
                                      </ul>
                                      </li>";
                            } else {
                                echo '<li><a href="./customer/login.php">Đăng nhập</a></li>';
                        }
                    ?>
                </ul>
            </nav>
            <div class="mid">
                <div style="display:flex;flex-wrap: wrap;justify-content: space-between">
                    <h2 class="header-content">Thanh toán</h2>
                    <div style="padding-right:10px; text-align: center;">
                        <strong>Địa chỉ nhận hàng</strong><br/>
                        <span><?php echo $_SESSION['customer']["Name"]." | ".$_SESSION['customer']['Phone']; ?></span><br/>
                        <span><?php echo $_SESSION['customer']["Address"] ?></span><br/>
                    </div>
                </div>
                <hr/>
                    <div class="container-user-cart-infos">
                        <div class="container-cart-info">
                            <?php
                                $total = 0;
                                if(isset($_SESSION['cart']) && $_SESSION['cart'])
                                {
                                    echo '<table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tên sách</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Loại sách</th>
                                                <th scope="col">Đơn giá</th>
                                                <th scope="col">Số lượng mua</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                    foreach($_SESSION['cart'] as $prodID => $value)
                                    {
                                        foreach($value as $booktype => $value1)
                                        {
                                            echo '<tr>
                                                    <td>'.$value1['tensach'].'</td>
                                                    <td><img src="../../images/'.$value1['hinhanh'].'"/></td>
                                                    <td>'.$booktype.'</td>
                                                    <td>'.$value1['giatien'].'</td>
                                                    <td>'.$value1['soluong'].'</td>'
                                                 .'</tr>';
                                            $total += $value1['giatien'] * $value1['soluong'];
                                        }
                                    }
                                    echo '<tbody>'
                                    . '</table>';
                                }
                                else {
                                    echo "<div><strong>Giỏ hàng của bạn đang trống</strong></div>";
                                }
                            ?>
                        </div>
                    </div>
                    <hr/>
                    <form>
                        <div class="radiobox-container">
                            <div class="radiobox-title">
                                <span>Chọn phương thức giao hàng</span>
                            </div>
                            <?php 
                                $shipMethods = $shipment_methodModel ->getAllShipmentMethods();
                                echo '<select id="ship_method" name="ship_method">'
                                      . '<option hidden></option>';
                                if($shipMethods != array())
                                {
                                    foreach($shipMethods as $shipMethod){
                                        echo '<option value="'.$shipMethod['id_hinh_thuc'].'">'.$shipMethod['ten_hinh_thuc'].'</option>';
                                    }
                                }
                                else{
                                    echo '<option value="">Không tìm thấy phương thức giao hàng</option>';
                                }
                                echo '</select>';
                            ?>
                            <span class="no-choice-opt"></span>
                        </div>
                        <div class="container-sale-input">
                            <div class="">
                                <div class="">
                                    <span>Nhập mã sale để được giảm giá</span>
                                </div>
                                <div class="">
                                    <input type="text" name="sale-code" id="sale-code" value=""/>
                                    <div class="message-error-code-sale">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class='total'>
                            <div class='total-before-sale'>Tổng tiền: <span align="center"><?php echo number_format($total,0,"",".")."<sup>đ</sup>"; ?></span></div>
                            <div class='sale-discount'>Áp dụng khuyến mãi: <span align="center" class='discount-val'>0<sup>đ</sup></span></div>
                            <div class='total-after-sale'><strong>Số tiền sau khi giảm:</strong> <span align="center"><?php echo number_format($total,0,"",".")."<sup>đ</sup>"; ?></span></div>
                        </div>
                        <div class="submit-checkout">
                            <input class='thanhtoan primary' type="submit" class="primary" value="Đặt hàng"/>
                        </div>
                    </form>
                </div>
            </div>
            <footer id="footer">
		<div class="inner">
                    <section>
			<h2>Liên hệ chúng tôi</h2>
                        <form method="post" action="#">
                            <div class="fields">
				<div class="field half">
                                    <input type="text" name="name" id="name" placeholder="Name" />
                            </div>
                            <div class="field half">
				<input type="text" name="email" id="email" placeholder="Email" />
                            </div>
                            <div class="field">
				<input type="text" name="subject" id="subject" placeholder="Subject" />
                            </div>
                            <div class="field">
				<textarea name="message" id="message" rows="3" placeholder="Notes"></textarea>
                            </div>
                            <div class="field text-right">
				<label>&nbsp;</label>
                                <ul class="actions">
                                    <li><input type="submit" value="Gửi tin nhắn" class="primary" /></li>
				</ul>
                            </div>
                        </div>
                    </form>
		</section>
		<section>
                    <h2>Thông tin liên hệ</h2>
                    <ul class="alt">
                        <li><span class="fa fa-envelope-o"></span> <a href="#">readbok@company.com</a></li>
                        <li><span class="fa fa-phone"></span> 0123456789 </li>
                        <li><span class="fa fa-map-pin"></span> Somewhere on planets</li>
                    </ul>
                    <h2>Follow Us</h2>
                    <ul class="icons">
                        <li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon style2 fa-linkedin"><span class="label">LinkedIn</span></a></li>
                    </ul>
                    </section>
                    <ul class="copyright">
			<li>Copyright © 2020 Company Name </li>
			<li>Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></li>
                    </ul>
		</div>
            </footer>
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/jquery.scrolly.min.js"></script>
        <script src="../../assets/js/jquery.scrollex.min.js"></script>
        <script src="../../assets/js/main.js"></script>
        <script type='text/javascript'>
            $(document).ready(function(){
                $("#sale-code").on("keyup",function(){
                    $.ajax({
                        url: "../../handle/handle_sale.php",
                        type: "POST",
                        data:{
                            action: "find",
                            id_sale: $(this).val()
                        },
                        success: function(reps)
                        {
                            var getData = JSON.parse(reps);
                            var total = <?php echo $total; ?>;
                            if(getData.valid)
                            {
                                $("div.message-error-code-sale").css("color","green");
                                var discount_value_str = (getData.discount_value - 0).toLocaleString("de-DE");
                                $(".discount-val").html(discount_value_str+"<sup>đ</sup>");
                                var newTotal = (total - getData.discount_value).toLocaleString("de-DE");
                                $(".total-after-sale span").html(newTotal+"<sup>đ</sup>");
                                $("div.message-error-code-sale").text(getData.message);
                            }
                            else {
                                $("div.message-error-code-sale").css("color","red");
                                $(".discount-val").html("0<sup>đ</sup>");
                                $("div.message-error-code-sale").text(getData.message);
                            }
                        }
                    });
                });
                $(".thanhtoan").click(function(e){
                    e.preventDefault();
                    var isNotEmptyCart = <?php if(isset($_SESSION['cart']) && $_SESSION['cart']) {echo 1;} else echo 0; ?>;
                    if(isNotEmptyCart === 0){ //Empty cart found
                        return;
                    }
                    if($("#ship_method").val() === "")
                    {
                        $(".no-choice-opt").text("(*) Vui lòng chọn phương thức giao hàng");
                        $(".no-choice-opt").css("color","red");
                        return;
                    }
                    if($("#input-sale-code").css("color") === "red")
                    {
                        return;
                    }
                    else {
                        $.ajax({
                            url: "../../handle/handle_invoice.php",
                            type: "POST",
                            data: {
                                action: "add",
                                ship_method: $("#ship_method").val(),
                                id_sale: $("#sale-code").val()
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
                    }
                });
            });
        </script>
    </body>
</html>