<?php
    include_once '../class/book.php';
    include_once '../class/author.php';
    include_once '../class/book_image.php';
    include_once '../class/publisher.php';
    $bookQuery = new book();
    $authorQuery = new author();
    $prod_imageQuery = new book_image();
    $publisherQuery = new publisher();
?>
<!DOCTYPE HTML>
<html>
	<head>
            <title>ReadBok | Chi tiết sách</title>
            <meta charset='utf-8' />
            <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no' />
            <link rel='stylesheet' href='../assets/bootstrap/css/bootstrap.min.css' />
            <link rel='stylesheet' href='../assets/css/main.css' />
            <noscript><link rel='stylesheet' href='../assets/css/noscript.css' /></noscript>
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
						</ul>
					</nav>

				<!-- Main -->
					<div id='main'>
                                            <?php
                                                $idsanpham = isset($_GET['id_san_pham'])?$_GET['id_san_pham']:'';
                                                $book = $bookQuery -> findBook($idsanpham);
                                                if($book != array())
                                                {
                                                    $nameBook = $book['ten_san_pham'];
                                                    $authorDetail = $authorQuery -> getAuthor($book['id_tac_gia']);
                                                    $prodImageLink = $prod_imageQuery ->getBookImages($book['id_san_pham']);
                                                    $publisherDetail = $publisherQuery -> getPublisher($book['id_nha_xuat_ban']);
                                                    $publisherName = $publisherDetail['ten_nha_xuat_ban'];
                                                    $nameAuthor = $authorDetail['ten_tac_gia'];
                                                    $yearPublish = $book['nam_xuat_ban'];
                                                    $bookDescription = $book['mo_ta_sach'];
                                                    $bookLanguage = $book['ngon_ngu'];
                                                    echo "<div class='inner'>
                                                            <h1>$nameBook</h1>
                                                            <div class='container-fluid'>
                                                                    <div class='row'>
                                                                            <div class='col-md-5'>
                                                                                <img src='../images/$prodImageLink[0]' class='img-fluid' alt=''>
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
                                                                                        <select>
                                                                                            <option value='0'>Sách in</option>
                                                                                            <option value='1'>Sách Ebook</option>
                                                                                        </select>
                                                                                    </div>
                                                                            </div>
                                                                            <div class='col-sm-8'>
                                                                                    <label class='control-label'>Số lượng mua</label>
                                                                                    <div class='row'>
                                                                                        <div class='col-sm-6'>
                                                                                            <div class='form-group'>
                                                                                                    <input type='text' name='name' id='name'>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class='col-sm-6'>
                                                                                            <input type='submit' class='primary' value='Thêm vào giỏ hàng'>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                            </div>
                                                                    </div>
                                                            </div>

                                                            <br>
                                                            <br>

                                                            <div class='container-fluid'>
                                                                    <h2 class='h2'>Các sách tương tự</h2>

                                                                    <!-- Products -->
                                                                    <section class='tiles'>
                                                                            <article class='style1'>
                                                                                    <span class='image'>
                                                                                            <img src='../images/product-1-720x480.jpg' alt='' />
                                                                                    </span>
                                                                                    <a href='product-details.php'>
                                                                                            <h2>Lorem ipsum dolor sit amet, consectetur</h2>

                                                                                            <p><del>$19.00</del> <strong>$19.00</strong></p>

                                                                                            <p>Vestibulum id est eu felis vulputate hendrerit uspendisse dapibus turpis in </p>
                                                                                    </a>
                                                                            </article>

                                                                            <article class='style2'>
                                                                                    <span class='image'>
                                                                                            <img src='../images/product-2-720x480.jpg' alt='' />
                                                                                    </span>
                                                                                    <a href='product-details.php'>
                                                                                            <h2>Lorem ipsum dolor sit amet, consectetur</h2>

                                                                                            <p><del>$19.00</del> <strong>$19.00</strong></p>

                                                                                            <p>Vestibulum id est eu felis vulputate hendrerit uspendisse dapibus turpis in </p>
                                                                                    </a>
                                                                            </article>

                                                                            <article class='style3'>
                                                                                    <span class='image'>
                                                                                            <img src='../images/product-6-720x480.jpg' alt='' />
                                                                                    </span>
                                                                                    <a href='product-details.php'>
                                                                                            <h2>Lorem ipsum dolor sit amet, consectetur</h2>

                                                                                            <p><del>$19.00</del> <strong>$19.00</strong></p>

                                                                                            <p>Vestibulum id est eu felis vulputate hendrerit uspendisse dapibus turpis in </p>
                                                                                    </a>
                                                                            </article>
                                                                    </section>
                                                            </div>
                                                    </div>";
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

	</body>
</html>