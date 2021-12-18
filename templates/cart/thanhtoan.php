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
            .wrap-img
            {
                width:130px;
                height:140px;
            }
            .wrap-img img{
                width:100%;
                height:100%;
            }
            table {
                overflow-x: scroll;
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
                <div class="container-cart-checkout shadow p-3 mb-5 bg-white rounded">
                    <div class="notification-box border border-danger">
                        <p>Vui lòng khách hàng kiểm tra kĩ các thông tin trước khi thanh toán và điền vào các ô trống. Nếu muốn
                            thay đổi thông tin thì nhấp vào <a href="../customer/profile.php">đây</a></p> 
                    </div>
                    <div class="container-user-cart-infos">
                        <div class="container-user-info">
                            <div class="header-title">
                                <h2>Thông tin của bạn</h2>
                            </div>
                            <div class="row">
                                <div class="col-title"><strong>Họ tên</strong></div>
                                <div class="col-content"><div><?php echo $_SESSION['customer']['Name']?></div></div>
                            </div>
                            <div class="row">
                                <div class="col-title"><strong>Địa chỉ</strong></div>
                                <div class="col-content"><div><?php echo $_SESSION['customer']['Address']?></div></div>
                            </div>
                            <div class="row">
                                <div class="col-title"><strong>Số điện thoại</strong></div>
                                <div class="col-content"><div><?php echo $_SESSION['customer']['Phone']?></div></div>
                            </div>
                        </div>
                        <div class="container-cart-info">
                            <div class="header-title">
                                <h2>Giỏ hàng của bạn</h2>
                            </div>
                            <?php
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
                                    $total = 0;
                                    foreach($_SESSION['cart'] as $prodID => $value)
                                    {
                                        foreach($value as $booktype => $value1)
                                        {
                                            echo '<tr>
                                                    <td>'.$value1['tensach'].'</td>
                                                    <td><div class="wrap-img"><img src="../../images/'.$value1['hinhanh'].'"/></div></td>
                                                    <td>'.$booktype.'</td>
                                                    <td>'.$value1['giatien'].'</td>
                                                    <td>'.$value1['soluong'].'</td>'
                                                 .'</tr>';
                                            $total += $value1['giatien'];
                                        }
                                    }
                                    echo '<tbody>'
                                    . '</table>';
                                }
                                else {
                                    echo "<div><span>Giỏ hàng của bạn đang trống</span></div>";
                                }
                            ?>
                        </div>
                    </div>
                    <form method="POST">
                        <div class="container-message-fill-in">
                            <span><font color='red'>(*)</font> Điền vào các mục này</span>
                        </div>
                        <div class="radiobox-container">
                            <div class="radiobox-title">
                                <span>Chọn phương thức giao hàng</span>
                            </div>
                            <?php 
                                $shipMethods = $shipment_methodModel ->getAllShipmentMethod();
                                echo '<select name="ship_method">';
                                if($shipMethods != array())
                                {
                                    foreach($shipMethods as $shipMethod){
                                        echo '<option value="'.$shipMethod['id_hinh_thuc'].'">'.$shipMethod['ten_hinh_thuc'].'</option>';
                                    }
                                }
                                else{
                                    echo '<option value="-1">Không tìm thấy phương thức giao hàng</option>';
                                }
                                echo '</select>';
                            ?>
                        </div>
                        <div class="container-sale-input">
                            <div class="row">
                                <div class="col">
                                    <span>Nhập mã sale để được giảm giá</span>
                                </div>
                                <div class="col">
                                    <input type="text" name="sale-code" id="input-sale-code" value=""/>
                                    <div class="show-error-sale-code">
                                        <span></span>
                                    </div>
                                    <div class="new-update-total">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function(){
                                    $("#input-sale-code").keyup(function(){
                                        if($(this).val()==="")
                                        {
                                            $(".container-sale-input .show-error-sale-code span").text("");
                                            $(".container-sale-input .show-error-sale-code span").removeClass("active-text");
                                            $(".container-sale-input .show-error-sale-code span").removeClass("error-text");
                                            $(".container-sale-input .new-update-total span").html("");
                                        }
                                        else{
                                            $.ajax({
                                                type:"POST",
                                                url:"xulymasale.php",
                                                data:{
                                                    act:"check",
                                                    code:$(this).val(),
                                                    total:<?php echo $total;?>
                                                },
                                                success:function(data)
                                                {
                                                    var getData = JSON.parse(data);
                                                    if(!getData.isValid)
                                                    {
                                                        $(".container-sale-input .show-error-sale-code span").text("Mã sale không hợp lệ");
                                                        $(".container-sale-input .show-error-sale-code span").removeClass("active-text");
                                                        $(".container-sale-input .show-error-sale-code span").addClass("error-text");
                                                        $(".container-sale-input .new-update-total span").html("");
                                                    }
                                                    else{
                                                        $(".container-sale-input .show-error-sale-code span").text("Mã sale khớp ["+getData.tensale+"]");
                                                        $(".container-sale-input .show-error-sale-code span").removeClass("error-text");
                                                        $(".container-sale-input .show-error-sale-code span").addClass("active-text");
                                                        $(".container-sale-input .new-update-total span").html(getData.new_total);
                                                    }
                                                }
                                            });
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <div class="submit-checkout">
                            <input type="submit" class="primary" value="Thanh toán"/>
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
        </div>
        <script>
        </script>
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/jquery.scrolly.min.js"></script>
        <script src="../../assets/js/jquery.scrollex.min.js"></script>
        <script src="../../assets/js/main.js"></script>
        <script type='text/javascript'>
            $(document).ready(function(){
                $("input[type='radio']").click(function(){
                    if($("input[type='radio']").is(":checked")){
                        $("input[type='radio']").prop("checked",false);
                        $(this).prop("checked",true);
                    }
                    else $(this).prop("checked",true);
                    });
                     $("input[type='submit']").click(function(e){
                        e.preventDefault();
                        
                        else{
                            if(!$("input[type='radio']").is(":checked"))
                            {
                                alert("Vui lòng chọn phương thức giao hàng");
                                return;
                            }
                            if($(".container-sale-input .show-error-sale-code span").hasClass("error-text"))
                            {
                                $("html,body").animate({scrollTop: $(".container-sale-input .show-error-sale-code span").offset().top},500);
                            }
                            else{
                                $.ajax({
                                    url:"xulyhoadon.php",
                                    type:"POST",
                                    data: "act=add&"+$("form").serialize()+"&total="+'<?php echo $total;?>',
                                    success:function(data)
                                    {
                                        var getData = JSON.parse(data);
                                                    alert(getData.msg);
                                                    if(getData.success===1)
                                                    {
                                                        $(".container-list-product-incart table .row-product-item").remove();
                                                        $(".container-sale-input .show-error-sale-code span").removeClass("error-text");
                                                        $(".container-sale-input .show-error-sale-code span").removeClass("active-text");
                                                        $(".container-sale-input .show-error-sale-code span").text("");
                                                        $(".total-price-all-products span").html("0<sup>đ</sup>");
                                                        $("#input-sale-code").val("");
                                                        $(".new-update-total span").html("");
                                                    }    
                                                }
                                            });
                                        }
                                    }
                                else{
                                    alert("Giỏ hàng của bạn đang trống");
                                }
                            });
                        });
                    </script>
    </body>
</html>