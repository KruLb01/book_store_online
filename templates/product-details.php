<?php
    include_once '../class/book.php';
    include_once '../class/author.php';
    include_once '../class/book_image.php';
    include_once '../class/publisher.php';
    $bookQuery = new book();
    $authorQuery = new author();
    $prod_imageQuery = new book_image();
    $publisherQuery = new publisher();
    session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
            <title>ReadBok | Chi tiết sách</title>
            <meta charset='utf-8' />
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
            <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="../assets/css/main.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <link rel="icon" type="image/png" sizes="16x16" href="../admin/static/plugins/images/favicon.png">
            <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
            <style>
                div.col-md-5 > img{
                    height:350px;
                }
                .product-not-found {
                    width:500px;
                    margin: auto;
                    text-align: center;
                }
                .product-not-found img{
                    width:500px;
                    display:block;
                }
                .error-code{
                    color: red;
                }
                .logo-container{
                    display:flex;
                }
                .prod-image img{
                    width: 55%;
                    height: 180px;
                }
            </style>
	</head>
	<body class='is-preload'>
		<!-- Wrapper -->
			<div id='wrapper'>

				<!-- Header -->
					<header id='header'>
						<div class='inner'>

							<!-- Logo -->
								<a href='index.php' class='logo'>
									<span class='fa fa-book'></span> <span class='title'>ReadBok</span>
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
							<li><a href='index.php'>Trang chủ</a></li>

							<li><a href='products.php' class='active'>Sản phẩm</a></li>

							<li><a href='checkout.html'>Thanh toán</a></li>

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
                                                                        <li><a href='./cart/index.php'><i class='fas fa-shopping-cart' style='padding-right: 0.25rem'></i> Giỏ hàng</a></li>
                                                                        <li><a href='testimonials.html'><i class='fas fa-receipt' style='padding-right: 0.7rem'></i> Đơn hàng</a></li>
                                                                        <li><a href='../handle/handle_account.php?logout=logout'><i class='fas fa-sign-out-alt' style='padding-right: 0.35rem'></i> Đăng xuất</a></li>
                                                                    </ul>
                                                                </li>";
                                                            } else {
                                                                echo '<li><a href="./customer/login.php">Đăng nhập</a></li>';
                                                            }
                                                        ?>
						</ul>
					</nav>

				<!-- Main -->
					<div id='main'>
                                            <?php
                                                $idsanpham = isset($_GET['id_san_pham'])?$_GET['id_san_pham']:'';
                                                $book = $bookQuery -> findBook($idsanpham);
                                                if($book != array())
                                                {
                                                    $bookIdentity = $book['id_san_pham'];
                                                    $nameBook = $book['ten_san_pham'];
                                                    $authorDetail = $authorQuery -> getAuthor($book['id_tac_gia']);
                                                    $prodImagesLink = $prod_imageQuery ->getBookImages($book['id_san_pham']);
                                                    $publisherDetail = $publisherQuery -> getPublisher($book['id_nha_xuat_ban']);
                                                    $publisherName = $publisherDetail['ten_nha_xuat_ban'];
                                                    $nameAuthor = $authorDetail['ten_tac_gia'];
                                                    $yearPublish = $book['nam_xuat_ban'];
                                                    $bookDescription = $book['mo_ta_sach'];
                                                    $bookLanguage = $book['ngon_ngu'];
                                                    $firstImageLink = $prodImagesLink[0][2];
                                                    echo "<div class='inner'>
                                                            <h1>$nameBook</h1>
                                                            <div class='container-fluid'>
                                                                    <div class='row'>
                                                                            <div class='col-md-5'>
                                                                                <img src='../images/$firstImageLink' class='img-fluid' alt=''>
                                                                            </div>
                                                                            <div class='col-md-7'>
                                                                                <div id='book-author'><span><b>Tác giả:</b> $nameAuthor</span></div>
                                                                                <div id='book-year-publish'><span><b>Năm xuất bản:</b> $yearPublish</span></div>
                                                                                <div id='book-publisher'><span><b>Nhà xuất bản:</b> $publisherName</span></div>
                                                                                <div id='book-language'><span><b>Ngôn ngữ:</b> $bookLanguage</span></div>
                                                                                <div id='book-description'><p><b>Mô tả:</b><br/> $bookDescription</p></div>
                                                                                <div class='row'>
                                                                            <div class='col-sm-4'>
                                                                                <label class='control-label'>Loại sách</label>
                                                                                    <div class='form-group'>
                                                                                        <select name='loai_sach' id='book-type'>
                                                                                            <option value='Book'>Sách in</option>
                                                                                            <option value='EBook'>Sách Ebook</option>
                                                                                        </select>
                                                                                    </div>
                                                                            </div>
                                                                            <div class='col-sm-8'>
                                                                                    <label class='control-label'>Số lượng mua</label>
                                                                                    <div class='row'>
                                                                                        <div class='col-sm-6'>
                                                                                            <div class='form-group'>
                                                                                                <input type='text' class='soluong' name='soluong' value='1' id='quantity' required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class='col-sm-6'>
                                                                                            <input type='submit' class='primary add-to-cart' value='Thêm vào giỏ hàng'>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                            <div class='error-code'>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <div class='container-fluid'>
                                                                    <h2 class='h2'>Một số sách tương tự</h2>
                                                                    <!-- Products --> ";
                                                            $lsBook = $bookQuery ->findSimilarBook($idsanpham);
                                                            if($lsBook != array())
                                                            {
                                                                echo '<section class="tiles">';
                                                                foreach($lsBook as $value)
                                                                {
                                                                    $nameBook = $value['ten_san_pham'];
                                                                    $identityBook = $value['id_san_pham'];
                                                                    $bookDescription = $value['mo_ta_sach'];
                                                                    $authorDetail = $authorQuery -> getAuthor($value['id_tac_gia']);
                                                                    $prodImageDetail = $prod_imageQuery -> getFirstImageBook($value['id_san_pham']);
                                                                    $nameAuthor = $authorDetail['ten_tac_gia'];
                                                                    $linkImage = $prodImageDetail['link_hinh_anh'];
                                                                    echo "<article>
                                                                              <a href='product-details.php?id_san_pham=$identityBook'>
                                                                                  <div class='prod-image'>
                                                                                      <img src='../images/$linkImage' alt='' />
                                                                                  </div>
                                                                                  <div>
                                                                                     <h2>$nameBook</h2>
                                                                                     <span><b>Mã sách:</b> $identityBook</span><br/>
                                                                                     <p><b>Tác giả:</b> $nameAuthor</p>
                                                                                  </div>
                                                                              </a>
                                                                         </article>";
                                                                }
                                                                echo '</section>'
                                                                . '</div>';
                                                            }
                                                            else {
                                                                echo "<p>Không tìm thấy sách tương tự</p>"
                                                                . "</div>";
                                                            }
                                                    }else{
                                                        echo '<div class="product-not-found">'
                                                                . '<img src="../images/404-not-found-bunny.jpg" alt="image-from-alamy"/>'
                                                                . '<h2>Không tìm thấy sản phẩm mà bạn đang tìm </h2>'
                                                                . '<a href="index.php">Quay về trang chủ</a>'
                                                             .'</div>'
                                                        ;
                                                    }
                                            ?>
					</div>

				<!-- Footer -->
					<footer id='footer'>
						<div class='inner'>
							<section>
								<ul class='icons'>
									<li><a href='#' class='icon style2 fa-twitter'><span class='label'>Twitter</span></a></li>
									<li><a href='#' class='icon style2 fa-facebook'><span class='label'>Facebook</span></a></li>
									<li><a href='#' class='icon style2 fa-instagram'><span class='label'>Instagram</span></a></li>
									<li><a href='#' class='icon style2 fa-linkedin'><span class='label'>LinkedIn</span></a></li>
								</ul>

								&nbsp;
							</section>

							<ul class='copyright'>
								<li>Copyright © 2020 Company Name </li>
								<li>Template by: <a href='https://www.phpjabbers.com/'>PHPJabbers.com</a></li>
							</ul>
						</div>
					</footer>
			</div>

		<!-- Scripts -->
		<script src='../assets/js/jquery.min.js'></script>
		<script src='../assets/bootstrap/js/bootstrap.bundle.min.js'></script>
		<script src='../assets/js/jquery.scrolly.min.js'></script>
		<script src='../assets/js/jquery.scrollex.min.js'></script>
		<script src='../assets/js/main.js'></script>
                <script src='../assets/js/post_method.js'></script>
                <script type='text/javascript'>
                    $(document).ready(function(){
                        function isNumber(number){
                            return parseInt(number);
                        }
                        $(".add-to-cart").click( (e) => {
                            e.preventDefault();
                            var isLogin = <?php if(isset($_SESSION['customer'])){echo 1;}else{echo 0;}?>;
                            if(isLogin === 0)
                            {
                                post_to_url("./customer/login.php",{next:window.location.href});
                                return;
                            }
                            var quantityValue = $("#quantity").val();
                            if(!isNumber(quantityValue)){
                                $(".error-code").text("(*) Quantity must be an integer");
                            }
                            else {
                                var idsp = '<?php echo $_GET['id_san_pham'] ?>';
                                $.ajax({
                                    url: "../handle/xulygiohang.php",
                                    type: "POST",
                                    data: {id_san_pham: idsp, loai_sach: $("#book-type").val(), soluong: $("#quantity").val()},
                                    success: function(response)
                                    {
                                        var getData = JSON.parse(response);
                                        if(getData.success)
                                        {
                                            alert("Thêm vào giỏ hàng thành công");
                                        }
                                        else{
                                            alert(getData.message);
                                        }
                                    }    
                                });
                            }
                        });
                    });
                </script>
	</body>
</html>