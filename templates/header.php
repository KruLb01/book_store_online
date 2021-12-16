<!-- Header -->
<?php
    session_start();
?>
<header id="header">
    <div class="inner">

        <!-- Logo -->
        <a href="index.php" class="logo">
            <span class="fa fa-book"></span> <span class="title">Đọc sách đi</span>
        </a>

        <!-- Nav -->
        <nav>
            <ul>
                <li><a href="#menu">Danh mục</a></li>
            </ul>
        </nav>

    </div>
</header>

<!-- Menu -->
<nav id="menu">
    <h2>Menu</h2>
    <ul>
        <li><a href="index.php" class="active">Trang chủ</a></li>

        <li><a href="products.php">Sản phẩm</a></li>

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
        <?php
            if (isset($_SESSION["customer"])) {
                echo "<li>
                    <a href='#' class='dropdown-toggle'><i class='fas fa-user' style='padding-right: 0.2rem'></i> {$_SESSION['customer']['User']}</a>
                            <ul>
                        <li><a href='profile.php'><i class='fas fa-id-badge' style='padding-right: 0.6rem'></i> Hồ sơ</a></li>
                        <li><a href='change_password.php'><i class='fas fa-key' style='padding-right: 0.2rem'></i> Đổi mật khẩu</a></li>
                        <li><a href='blog.html'><i class='fas fa-shopping-cart' style='padding-right: 0.25rem'></i> Giỏ hàng</a></li>
                        <li><a href='testimonials.html'><i class='fas fa-receipt' style='padding-right: 0.7rem'></i> Đơn hàng</a></li>
                        <li><a href='../handle/handle_account.php?logout=logout'><i class='fas fa-sign-out-alt' style='padding-right: 0.35rem'></i> Đăng xuất</a></li>
                    </ul>
                </li>";
            } else {
                echo '<li><a href="login.php">Giỏ hàng</a></li>
                    <li><a href="login.php">Đăng nhập</a></li>';
            }
        ?>
    </ul>
</nav>