<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Ample Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../static/plugins/images/favicon.png">
    <!-- Custom CSS -->
   <link href="../static/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        .error {
            display: none;
            color: red;
            font-size: 16px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php
        include_once("header.php");
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php
        include_once("sidebarnav.php");
        ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="index.php" class="fw-normal">Back to Dashboard</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="../static/plugins/images/large/img1.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="../static/plugins/images/users/genu.jpg"
                                                class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?php echo $_SESSION['user']['Name'] ?></h4>
                                        <h5 class="text-white mt-2"><?php echo $_SESSION['user']['Email'] ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                                <div class="col-md-4 col-sm-4 text-center">
<!--                                    // Add any info-->
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
<!--                                    // Add any info-->
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
<!--                                    // Add any info-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" id="form-profile">
                                    <div class="form-group mb-4">
                                        <label for="name" class="col-md-12 p-0">Name</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $_SESSION['user']['Name'] ?>"
                                                class="form-control p-0 border-0" id="name"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" value="<?php echo $_SESSION['user']['Email'] ?>"
                                                class="form-control p-0 border-0"
                                                id="email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password" class="col-md-12 p-0">Password</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" value="<?php echo $_SESSION['user']['Password']?>" class="form-control p-0 border-0" id="password">
                                            <input type="hidden" id="root-password" value="<?php echo $_SESSION['user']['Password']?>">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="phone" class="col-md-12 p-0">Phone</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $_SESSION['user']['Phone'] ?>"
                                                class="form-control p-0 border-0" id="phone">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="address" class="col-md-12 p-0">Address</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" value="<?php echo $_SESSION['user']['Address'] ?>"
                                                class="form-control p-0 border-0" id="address">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 error">Error print here</div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2021 © Ample Admin brought to you by <a
                    href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../static/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../static/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../static/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="../static/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../static/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../static/js/custom.js"></script>
</body>

<script>
    $(document).on("click", "#form-profile", function(e) {
        var form = $(this);
        if (form.find("button.btn")[0] == e.target)
        {
            e.preventDefault();
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var root_password = document.getElementById("root-password").value;
            var password = document.getElementById("password").value;
            var phone = document.getElementById("phone").value;
            var address = document.getElementById("address").value;

            if (name.length < 5 || email.length < 5 || password.length < 5 || phone.length != 10 || address.length < 5) {
                $("#form-profile div.error").css("display", "block");
                $("#form-profile div.error").text("Invalid input");
            } else if (prompt("Nhập mật khẩu hiện tại để lưu thay đổi") == root_password) {
                $.ajax({
                    method: "post",
                    url: "../handle/handle_account.php",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        phone: phone,
                        address: address,
                        update: "profile"
                    },
                    success: function (res) {
                        if (res.trim() == "success") {
                            window.location = "profile.php";
                        } else alert("Thao tác thất bại !");
                    }
                })
            }
        }
    })
</script>

</html>