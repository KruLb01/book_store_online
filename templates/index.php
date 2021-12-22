<?php
    include_once '../class/book.php';
    include_once '../class/author.php';
    include_once '../class/book_image.php';
    $bookQuery = new book();
    $authorQuery = new author();
    $prod_imageQuery = new book_image();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>ReadBok</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="icon" type="image/png" sizes="16x16" href="../admin/static/plugins/images/favicon.png">
        <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
        <style>
            .logo-container{
                display:flex;
            }
            .logo-container > div input{
                padding-top:20px;
            }
            a.product-link {
                border-bottom: none;
            }
            .product-items{
                display:flex;
                width:100%;
                flex-wrap:wrap;
                text-align: center;
                justify-content: space-around;
            }
            .product-items .product-item{
                width:30%;
                height:auto;
                -moz-transition: -moz-transform 0.5s ease, opacity 0.5s ease;
                -webkit-transition: -webkit-transform 0.5s ease, opacity 0.5s ease;
                -ms-transition: -ms-transform 0.5s ease, opacity 0.5s ease;
                transition: transform 0.5s ease, opacity 0.5s ease;
            }
            .product-link {
                -moz-transform: scale(1.1);
		webkit-transform: scale(1.1);
                -ms-transform: scale(1.1);
		transform: scale(1.1);
            }
            .prod-image {
                height:300px;
            }
            .prod-image img{
                width:100%;
                padding:10px;
                height:100%;
            }
        </style>
    </head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

                <?php
                    include_once("header.php");
                ?>

				<!-- Main -->
					<div id="main">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						  <ol class="carousel-indicators">
						    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						  </ol>
						  <div class="carousel-inner">
						    <div class="carousel-item active">
						      <img class="d-block w-100" src="../images/slider-image-1-1920x700.jpg" alt="First slide">
						    </div>
						    <div class="carousel-item">
						      <img class="d-block w-100" src="../images/slider-image-2-1920x700.jpg" alt="Second slide">
						    </div>
						    <div class="carousel-item">
						      <img class="d-block w-100" src="../images/slider-image-3-1920x700.jpg" alt="Third slide">
						    </div>
						  </div>
						  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>

						<br>
						<br>

						<div class="inner">
							<!-- About Us -->
							<header id="inner">
								<h1 align="center">Chào mừng bạn đến với ReadBok!</h1>
							</header>

							<br>

							<h2 class="h2">Sách nổi bật</h2>

							<!-- Products -->
							<section class="tiles">
                                                            <?php
                                                                $result = $bookQuery -> getRangeListBook(1, 6);
                                                                if($result)
                                                                {
                                                                    while($row = mysqli_fetch_array($result))
                                                                    {
                                                                        $nameBook = $row['ten_san_pham'];
                                                                        $identityBook = $row['id_san_pham'];
                                                                        $bookDescription = $row['mo_ta_sach'];
                                                                        $authorDetail = $authorQuery -> getAuthor($row['id_tac_gia']);
                                                                        $prodImageDetail = $prod_imageQuery -> getFirstImageBook($row['id_san_pham']);
                                                                        $nameAuthor = $authorDetail['ten_tac_gia'];
                                                                        $linkImage = $prodImageDetail['link_hinh_anh'];
                                                                        echo "<article>
                                                                                <a class='product-link' href='product-details.php?id_san_pham=$identityBook'>
                                                                                    <div class='prod-image'>
                                                                                        <img src='../images/$linkImage' alt=''/>
                                                                                    </div>
                                                                                    <div>
                                                                                        <h2>$nameBook</h2>
                                                                                        <span><b>Mã sách:</b> $identityBook</span><br/>
                                                                                        <p><b>Tác giả:</b> $nameAuthor</p>
                                                                                    </div>
                                                                                </a>
                                                                             </article>";
                                                                    }
                                                                }
                                                            ?>
							</section>
							<p class="text-center"><a href="products.php">Xem nhiều sách hơn &nbsp;<i class="fa fa-long-arrow-right"></i></a></p>
							<br>
							<h2 class="h2">Các bài viết đánh giá</h2>
							<div class="row">
								<div class="col-sm-6 text-center">
									<p class="m-n"><em>"Việc đọc sách e-book trên trang web là điều hết sức phi lý.
                                                                                            Tuy nhiên tại ReadBok bạn còn làm những điều hơn thế"</em></p>

									<p><strong> - Chúa hề Deadline</strong></p>
								</div>

								<div class="col-sm-6 text-center">
									<p class="m-n"><em>"ReadBok mang đến cho tôi những cuốn sách toẹt vời mà những trang web khác không có
                                                                                . Tôi không thể nói nhiều hơn ngoài việc ngắn gọn 3 từ <b>I Love ReadBok <3</b>"</em></p>

									<p><strong>- Chúa hề</strong> </p>
								</div>
							</div>

							<p class="text-center"><a href="testimonials.html">Đọc các bài viết đánh giá khác &nbsp;<i class="fa fa-long-arrow-right"></i></a></p>

							<br>

							<h2 class="h2">Blog</h2>
							
							<div class="row">
								<div class="col-sm-4 text-center">
									<img src="../images/blog-1-720x480.jpg" class="img-fluid" alt="" />

									<h2 class="m-n"><a href="#">Những điều thú vị khi đọc sách</a></h2>

									<p> Darkieeee &nbsp;|&nbsp; 17/12/2021 10:30</p>
								</div>

								<div class="col-sm-4 text-center">
									<img src="../images/blog-2-720x480.jpg" class="img-fluid" alt="" />

									<h2 class="m-n"><a href="#">Chọn lựa nơi tốt để đọc sách</a></h2>

									<p> Darkieeee &nbsp;|&nbsp; 17/12/2021 10:30</p>
								</div>

								<div class="col-sm-4 text-center">
									<img src="../images/blog-3-720x480.jpg" class="img-fluid" alt="" />

									<h2 class="m-n"><a href="#">Làm thế nào để lựa chọn sách phù hợp để đọc?</a></h2>

									<p> Darkieeee &nbsp;|&nbsp; 17/12/2021 10:30</p>
								</div>
							</div>

							<p class="text-center"><a href="blog.html">Đọc nhiều hơn &nbsp;<i class="fa fa-long-arrow-right"></i></a></p>

							
						</div>
					</div>
				<!-- Footer -->
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

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>