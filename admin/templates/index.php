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
    <title>Trang chính</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../static/plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../static/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../static/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="../static/css/style.min.css" rel="stylesheet">
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
                    <h4 class="page-title">Trang chính</h4>
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
            <!-- Three charts -->
            <!-- ============================================================== -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Số lượng khách hàng</h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                                <div id="sparklinedash"><canvas width="67" height="30"
                                                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                </div>
                            </li>
                            <li class="ms-auto"><span class="counter text-success">
                                    <?php
                                        include_once("../class/report.php");
                                        $reportModel = new report();

                                        $data = $reportModel->getTotal_Customers_Invoice_Product();
                                        echo $data["Customer"];
                                    ?>
                                </span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Tổng sản phẩm đã bán ra</h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                                <div id="sparklinedash2"><canvas width="67" height="30"
                                                                 style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                </div>
                            </li>
                            <li class="ms-auto"><span class="counter text-purple"><?= $data["Sold"]?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Số lượng sản phẩm</h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                                <div id="sparklinedash3"><canvas width="67" height="30"
                                                                 style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                </div>
                            </li>
                            <li class="ms-auto"><span class="counter text-info"><?= $data["Product"]?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- PRODUCTS YEARLY SALES -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">Products Yearly Sales</h3>
                        <div class="d-md-flex">
                            <ul class="list-inline d-flex ms-auto">
                                <li class="ps-3">
                                    <h5><i class="fa fa-circle me-1 text-info"></i>Mac</h5>
                                </li>
                                <li class="ps-3">
                                    <h5><i class="fa fa-circle me-1 text-inverse"></i>Windows</h5>
                                </li>
                            </ul>
                        </div>
                        <div id="ct-visits" style="height: 405px;">
                            <div class="chartist-tooltip" style="top: -17px; left: -12px;"><span
                                        class="chartist-tooltip-value">6</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- RECENT SALES -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
                        <div class="d-md-flex mb-3">
                            <h3 class="box-title mb-0">Sách được mua nhiều nhất</h3>
                            <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                                <select class="form-select shadow-none row border-top">
                                    <option>Tháng 12, 2021</option>
                                    <option>Tháng 11, 2021</option>
                                    <option>Tháng 10, 2021</option>
                                    <option>Tháng 9, 2021</option>
                                    <option>Tháng 8, 2021</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap">
                                <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Mã sản phẩm</th>
                                    <th class="border-top-0">Tên sản phẩm</th>
                                    <th class="border-top-0">Tác giả</th>
                                    <th class="border-top-0">Số lượng được mua</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include_once("../class/books.php");
                                $bookModel = new books();

                                $data = $bookModel->getMostBoughtBook();
                                $count = 1;
                                foreach ($data as $key=>$val) {
                                    $render =  "
                                        <tr>
                                            <td>{$count}</td>
                                            <td>{$val['Id']}</td>
                                            <td>{$val['Name']}</td>
                                            <td>{$val['Author']}</td>
                                            <td>{$val['Total']}</td>
                                        </tr>
                                        ";
                                    echo $render;
                                    $count++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Recent Comments -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- .col -->
                <div class="col-md-12 col-lg-8 col-sm-12">
                    <div class="card white-box p-0">
                        <div class="card-body">
                            <h3 class="box-title mb-0">Khách hàng tích cực</h3>
                        </div>
                        <div class="comment-widgets">
                            <?php
                            include_once("../class/account.php");
                            $accountModel = new account();

                            $data = $accountModel->getMostValueCustomer();
                            foreach ($data as $key=>$val) {
                                $render =  "
                                         <div class='d-flex flex-row comment-row p-3'>
                                            <div class='p-2'><img src='../static/plugins/images/users/ritesh.jpg' alt='user' width='50' class='rounded-circle'></div>
                                            <div class='comment-text ps-2 ps-md-3 w-100'>
                                                <h5 class='font-medium'>{$val['Name']} - {$val['Email']}</h5>
                                                <span class='mb-3 d-block'>Tổng số tiền đã thanh toán: {$val['Total']} đồng</span>
                                                <div class='comment-footer d-md-flex align-items-center'>
            
                                                    <span class='badge rounded bg-primary'>{$val['Phone']}</span>
            
                                                    <div class='text-muted fs-2 ms-auto mt-2 mt-md-0'>Số hóa đơn đã thanh toán: {$val['Amount Invoice']}</div>
                                                </div>
                                            </div>
                                        </div>
                                        ";
                                echo $render;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card white-box p-0">
                        <div class="card-heading">
                            <h3 class="box-title mb-0">Khách hàng mới</h3>
                        </div>
                        <div class="card-body">
                            <ul class="chatonline">
                                <?php
                                    include_once("../class/account.php");
                                    $accountModel = new account();

                                    $data = $accountModel->getNewCustomer();
                                    foreach ($data as $key=>$val) {
                                        $render =  "
                                              <li>
                                                <div class='call-chat'>
                                                    <button class='btn btn-info btn-circle btn' type='button' onclick='window.location = `mailto:{$val['Email']}`'>
                                                        <i class='far fa-comments text-white'></i>
                                                    </button>
                                                </div>
                                                <a href='javascript:void(0)' class='d-flex align-items-center'><img
                                                            src='../static/plugins/images/users/govinda.jpg' alt='user-img' class='img-circle'>
                                                    <div class='ms-2'>
                                                            <span class='text-dark'>{$val['Name']}<small
                                                                        class='d-block text-success d-block'>{$val['Phone']}</small></span>
                                                    </div>
                                                </a>
                                            </li>
                                        ";
                                        echo $render;
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
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
<script src="../static/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<!--Wave Effects -->
<script src="../static/js/waves.js"></script>
<!--Menu sidebar -->
<script src="../static/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="../static/js/custom.js"></script>
<!--This page JavaScript -->
<!--chartis chart-->
<script src="../static/plugins/bower_components/chartist/dist/chartist.min.js"></script>
<script src="../static/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="../static/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>