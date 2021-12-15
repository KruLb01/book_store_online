<?php
    $inactive = 1800; 
    ini_set('session.gc_maxlifetime', $inactive);
    session_start();
    if (isset($_SESSION['last_accessed']) && (time() - $_SESSION['last_accessed'] > $inactive)) {
        session_unset();
        session_destroy();
    }
    $_SESSION['testing'] = time();
?>
<html lang="vi">
    <head>
        <meta charset="UTF-8" />
        <title>Trang chủ</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <link rel="stylesheet" type="text/css" href="../static/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="../static/css/index.css" />
        <link rel="stylesheet" type="text/css" href="../static/css/all.css" />
        <script type="text/javascript" src="../static/js/bootstrap.js"></script>
    </head>
    <body>
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"><img src="../images/logo.jpg" width="70px" height="60px"/></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="..">Trang chủ <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="danhmucsach">Xem danh mục sách</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Chương trình khuyến mãi</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                            <?php 
                            if(!isset($_SESSION["account"]) || !$_SESSION["account"]){
                                echo '
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="signup.php">Đăng kí thành viên</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="login.php">Đăng nhập</a>
                                </li>';
                            }
                                else{
                                echo '<li class="nav-item">
                                         <a class="nav-link disabled" href="#"></a>
                                      </li>';
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
        <div class='wrap'>
            <div class="body-content">
                <h3 class="text-center">Chào mừng bạn đến với thế giới sách</h3>
                <div class="images-content justify-content-center">
                    <div>
                        <img class='d-block w-75' src='../images/image1.png' height="400px"/>
                    </div>
                    <div>
                        <img class='d-block w-75' src='../images/image2.jpg' height="400px"/>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div>
                    <ul>
                        <li>
                            <span id="phone-number">Số điện thoại: 0123456789</span>
                        </li>
                    </ul>
                </div>
                <div>
                    
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(window).on("load",function(){
               $("h3").fadeIn("slow");
            });
        </script>
    </body>
</html>