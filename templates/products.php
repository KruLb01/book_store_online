<?php
    session_start();
    include_once '../class/category.php';
    include_once '../class/book.php';
    include_once '../class/author.php';
    include_once '../class/book_image.php';
    $categoriesModel = new category();
    $authorModel = new author();
    $bookModel = new book();
    $prod_imageModel = new book_image();
?>
<!DOCTYPE HTML>
<html>
	<head>
            <title>ReadBok | Danh mục sách</title>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
            <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="../assets/css/main.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <link rel="icon" type="image/png" sizes="16x16" href="../admin/static/plugins/images/favicon.png">
            <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
            <style>
                .container-content{
                    display:flex;
                    font-size:11pt;
                }
                form{
                    width:25%;
                }
                .form-group {
                    display: flex;
                    justify-content: center;
                }
                form > div {
                    padding-top: 5px;
                    padding-bottom: 5px;
                }
                .vertical-line {
                    margin: 0;
                    margin-left: 10px;
                    margin-top:10px;
                    margin-right: 10px;
                    background: black;
                    height:auto;
                    width:1px;
                }
                .wrapper-product-items {
                    width:75%;
                }
                .product-items {
                    width:100%;
                    display:flex;
                    flex-wrap: wrap;
                    justify-content: space-around
                }
                .product-item {
                    width:30%;
                }
                .prod-image {
                    width:100%;
                    height:auto;
                    display:flex;
                    justify-content: center;
                }
                .prod-image img {
                    width: 100%;
                }
                .pagination {
                    display: flex;
                    justify-content: flex-end;
                    padding-right:15px;
                }
                .pagination .page{
                    padding:6px 14px 6px 14px;
                    border:1px solid black;
                    margin-left: 5px;
                    margin-right: 5px;
                }
                .pagination .page.active{
                    background: black;
                    color:white;
                }
                .pagination a.page:hover {
                    background: black;
                    color:white !important;
                }
                .pagination .page.active:hover{
                    background: orange;
                }
                p.bookprice {
                    color:red;
                    font-weight: bold;
                    font-size:14pt;
                    margin: 0;
                }
                a.product-link {
                    border-bottom: none;
                }
                a.product-link: hover ~ .product-item {
                    border: 1px;
                }
                .product-item {
                    text-align:  center;
                }
            </style>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
				<header id="header">
					<div class="inner">

						<!-- Logo -->
							<a href="index.php" class="logo">
									<span class="fa fa-book"></span> <span class="title">ReadBok</span>
								</a>

						<!-- Nav -->
							<nav>
								<ul>
									<li><a href="#menu">Menu</a></li>
								</ul>
							</nav>

					</div>
				</header>

			<!-- Menu -->
                            <nav id="menu">
				<h2>Menu</h2>
						<ul>
							<li><a href='index.php'>Trang chủ</a></li>

							<li><a href='products.php' class='active'>Xem danh mục sản phẩm</a></li>

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
					<div id="main">
						<div class="inner">
							<h1>Danh mục sản phẩm</h1>
							<div class="image main">
								<img src="../images/banner-image-6-1920x500.jpg" class="img-fluid" alt="" />
							</div>

							<!-- Products -->
                                                        <div class="container-content">
                                                            <form>
                                                                <h3>Danh mục sách:</h3>
                                                                <?php
                                                                    $categories = $categoriesModel ->getCategories();
                                                                    if($categories)
                                                                    {
                                                                        foreach($categories as $category)
                                                                        {
                                                                            $isChecked = "";
                                                                            $categoryID = $category['id_danh_muc'];
                                                                            $categoryName = $category['ten_danh_muc']; 
                                                                            if(isset($_GET['id_danh_muc']) && $_GET['id_danh_muc'])
                                                                            {
                                                                                if(in_array($categoryID,$_GET['id_danh_muc']))
                                                                                {
                                                                                    $isChecked = "checked";
                                                                                }
                                                                            }
                                                                            echo "<div class='form-check'>
                                                                                    <input id='$categoryID' type='checkbox' name='id_danh_muc[]' class='form-check-input' value='$categoryID' $isChecked />
                                                                                        <label for='$categoryID' class='form-check-label'>$categoryName</label>
                                                                                  </div>";
                                                                        }
                                                                        echo "<div class='form-group'>
                                                                            <button class='primary'>Lọc</button>
                                                                        </div>";
                                                                    }
                                                                ?>
                                                        </form>
                                                        <hr class="vertical-line"/>
                                                        <div class="wrapper-product-items">
                                                            <div class="product-items">
                                                                <?php
                                                                    if(isset($_GET['product']))
                                                                    {
                                                                        $productKey = $_GET['product'];
                                                                        $books = $bookModel -> findBooks($productKey);
                                                                        if($books)
                                                                        {
                                                                            foreach($books as $book)
                                                                            {
                                                                                $nameBook = $book['ten_san_pham'];
                                                                                $identityBook = $book['id_san_pham'];
                                                                                $bookDescription = $book['mo_ta_sach'];
                                                                                $authorDetail = $authorModel -> getAuthor($book['id_tac_gia']);
                                                                                $prodImageDetail = $prod_imageModel -> getFirstImageBook($book['id_san_pham']);
                                                                                $nameAuthor = $authorDetail['ten_tac_gia'];
                                                                                $bookPrice = number_format($book['gia_sach_giay'],0, '', '.');
                                                                                $linkImage = $prodImageDetail['link_hinh_anh'];
                                                                                echo "<div class='product-item'>
                                                                                        <a class='product-link' href='product-details.php?id_san_pham=$identityBook'>
                                                                                            <div class='prod-image'>
                                                                                                <img src='../images/$linkImage' alt=''/>
                                                                                            </div>
                                                                                            <div>
                                                                                                <strong>$nameBook</strong><br/>
                                                                                                <p class='bookprice'>$bookPrice<sup>đ</sup></p>
                                                                                                <p><b>Tác giả:</b> $nameAuthor</p>
                                                                                            </div>
                                                                                        </a>
                                                                                </div>";
                                                                            }
                                                                            echo '</div>';
                                                                        }
                                                                        else {
                                                                            echo '<div><strong>Không tìm thấy sản phẩm tương ứng với yêu cầu của bạn<strong></div>';
                                                                        }
                                                                        echo '</div>';
                                                                    }
                                                                    else if(isset($_GET['id_danh_muc']))
                                                                    {
                                                                        $id_danh_muc = $_GET['id_danh_muc'];
                                                                        $pageIndex = (isset($_GET['page']) && $_GET['page'])?$_GET['page']:1;
                                                                        $books = $bookModel -> findByCategories($id_danh_muc);
                                                                        if($books)
                                                                        {
                                                                            $booksCounter = count($books);
                                                                            $booksInPage = 9;
                                                                            $numPages = $booksCounter / $booksInPage;
                                                                            $from = ($pageIndex-1)*$booksInPage;
                                                                            $books = $bookModel ->findByCategoriesFrom($id_danh_muc, $from, $booksInPage);
                                                                            foreach($books as $book)
                                                                            {
                                                                                $nameBook = $book['ten_san_pham'];
                                                                                $identityBook = $book['id_san_pham'];
                                                                                $bookDescription = $book['mo_ta_sach'];
                                                                                $authorDetail = $authorModel -> getAuthor($book['id_tac_gia']);
                                                                                $prodImageDetail = $prod_imageModel -> getFirstImageBook($book['id_san_pham']);
                                                                                $nameAuthor = $authorDetail['ten_tac_gia'];
                                                                                $bookPrice = number_format($book['gia_sach_giay'],0, '', '.');
                                                                                $linkImage = $prodImageDetail['link_hinh_anh'];
                                                                                echo "<div class='product-item'>
                                                                                        <a class='product-link' href='product-details.php?id_san_pham=$identityBook'>
                                                                                            <div class='prod-image'>
                                                                                                <img src='../images/$linkImage' alt=''/>
                                                                                            </div>
                                                                                            <div>
                                                                                                <strong>$nameBook</strong><br/>
                                                                                                <p class='bookprice'>$bookPrice<sup>đ</sup></p>
                                                                                                <p><b>Tác giả:</b> $nameAuthor</p>
                                                                                            </div>
                                                                                        </a>
                                                                                </div>";
                                                                            }
                                                                            echo "</div>"
                                                                            . "<div class='pagination'>";
                                                                            $data = array(
                                                                                "id_danh_muc" => $id_danh_muc
                                                                            );
                                                                            $urlEncodeArrayFormatted = http_build_query($data);
                                                                            if(round($numPages) > 1)
                                                                            {
                                                                                for($i = 0; $i < round($numPages); $i++)
                                                                                {
                                                                                    $active = "";
                                                                                    if($i+1 == $pageIndex)
                                                                                    {
                                                                                        $active = "active";
                                                                                    }
                                                                                    echo "<a class='page $active' href='products.php?$urlEncodeArrayFormatted&page=".($i+1)."'>".($i+1)."</a>";
                                                                                }
                                                                            }
                                                                            echo "</div></div>";
                                                                        }
                                                                    }
                                                                    else {
                                                                        $pageIndex = (isset($_GET['page']) && $_GET['page'])?$_GET['page']:1;
                                                                        $books = $bookModel ->getAllBooks();
                                                                        if($books)
                                                                        {
                                                                            $booksCounter = count($books);
                                                                            $booksInPage = 9;
                                                                            $numPages = $booksCounter / $booksInPage;
                                                                            $from = ($pageIndex-1)*$booksInPage;
                                                                            $books = $bookModel ->getLimitRangeListBook($from, $booksInPage);
                                                                            foreach($books as $book)
                                                                            {
                                                                                $nameBook = $book['ten_san_pham'];
                                                                                $identityBook = $book['id_san_pham'];
                                                                                $bookDescription = $book['mo_ta_sach'];
                                                                                $authorDetail = $authorModel -> getAuthor($book['id_tac_gia']);
                                                                                $prodImageDetail = $prod_imageModel -> getFirstImageBook($book['id_san_pham']);
                                                                                $nameAuthor = $authorDetail['ten_tac_gia'];
                                                                                $bookPrice = number_format($book['gia_sach_giay'],0, '', '.');
                                                                                $linkImage = $prodImageDetail['link_hinh_anh'];
                                                                                echo "<div class='product-item'>
                                                                                        <a class='product-link' href='product-details.php?id_san_pham=$identityBook'>
                                                                                            <div class='prod-image'>
                                                                                                <img src='../images/$linkImage' alt=''/>
                                                                                            </div>
                                                                                            <div>
                                                                                                <strong>$nameBook</strong><br/>
                                                                                                <p class='bookprice'>$bookPrice<sup>đ</sup></p>
                                                                                                <p><b>Tác giả:</b> $nameAuthor</p>
                                                                                            </div>
                                                                                        </a>
                                                                                </div>";
                                                                            }
                                                                            echo "</div>"
                                                                            . "<div class='pagination'>";
                                                                            if(round($numPages) > 1)
                                                                            {
                                                                                for($i = 0; $i < round($numPages); $i++)
                                                                                {
                                                                                    $active = "";
                                                                                    if($i+1 == $pageIndex)
                                                                                    {
                                                                                        $active = "active";
                                                                                    }
                                                                                    echo "<a class='page $active' href='products.php?page=".($i+1)."'>".($i+1)."</a>";
                                                                                }
                                                                                echo "</div></div>";
                                                                            }
                                                                        }
                                                                    }
                                                            ?>
                                                    </div>
                                                </div>
                                            </div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<ul class="icons">
									<li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon style2 fa-linkedin"><span class="label">LinkedIn</span></a></li>
								</ul>

								&nbsp;
							</section>

							<ul class="copyright">
								<li>Copyright © 2020 Company Name </li>
								<li>Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></li>
							</ul>
						</div>
					</footer>
			</div>
                </div>
		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/main.js"></script>
	</body>
</html>