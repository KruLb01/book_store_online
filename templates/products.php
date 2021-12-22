<?php
    session_start();
    include_once '../class/category.php';
    $categoriesModel = new category();
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
                .container {
                    display:flex;
                    flex-wrap: wrap;
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
									<span class="fa fa-book"></span> <span class="title">Book Online Store Website</span>
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
						<li><a href="index.php">Home</a></li>

						<li><a href="products.php" class="active">Products</a></li>

						<li><a href="checkout.html">Checkout</a></li>

						<li>
							<a href="#" class="dropdown-toggle">About</a>

							<ul>
								<li><a href="about.html">About Us</a></li>
								<li><a href="blog.html">Blog</a></li>
								<li><a href="testimonials.html">Testimonials</a></li>
								<li><a href="terms.html">Terms</a></li>
							</ul>
						</li>

						<li><a href="contact.html">Contact Us</a></li>
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
                                                        <div class="container">
                                                            <form>
                                                        <span>Category Name:</span>
                                                        <?php
                                                            $result = $categorymd->getAll();
                                                            if($result)
                                                            {
                                                                while($row = mysqli_fetch_array($result))
                                                                {
                                                                    $isChecked = "";
                                                                    if(isset($_GET['cateids']) && $_GET['cateids'])
                                                                    {
                                                                        if(in_array($row['CategoryID'],$_GET['cateids']))
                                                                        {
                                                                            $isChecked = "checked";
                                                                        }
                                                                    }
                                                                    echo "<div class='form-check'>
                                                                            <label class='form-check-label'>
                                                                            <input type='checkbox' name='cateids[]' class='form-check-input' value='$row[0]' $isChecked>$row[1]
                                                                          </div>";
                                                                }
                                                                echo "<div class='form-group'>
                                                                        <button class='btn btn-info'>Filter</button>
                                                                      </div>";
                                                            }
                                                        ?>
                                                    </form>
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

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/main.js"></script>
	</body>
</html>