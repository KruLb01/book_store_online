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
            font-size: 13px;
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
                        <h4 class="page-title">Quản lý hóa đơn</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="index.php" class="fw-normal">Quay lại trang chính</a></li>
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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Hóa đơn</h3>
                            <div class="row">
                                <p class="text-muted col-sm-10"><code>Tất cả hóa đơn</code></p>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-secondary">Xuất Excel</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Mã hóa đơn</th>
                                            <th class="border-top-0">Tên khách hàng</th>
                                            <th class="border-top-0">Ngày mua</th>
                                            <th class="border-top-0">Hình thức giao hàng</th>
                                            <th class="border-top-0">Tổng giá</th>
                                            <th class="border-top-0">Trạng thái đơn hàng</th>
                                            <th class="border-top-0">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        include_once("../class/invoice.php");
                                        $invoiceModel = new invoice();

                                        $data = $invoiceModel->getInvoices();
                                        $count = 1;
                                        foreach ($data as $key=>$val) {
                                            $actionBtn = "<button f='details' type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#exampleModal'>Chi tiết</button>
                                                           <button f='edit' type='button' class='btn btn-info'><i class='fas fa-pencil-alt'></i></button>
                                                           <button f='delete' type='button' class='btn btn-danger'><i class='fas fa-trash'></i></button>";
                                            $status = "Chờ xử lý";
                                            if ($val["Status"] == 1) $status = "Đang giao hàng";
                                            else if ($val["Status"] == 2) $status = "Đã giao hàng";
                                            $render =  "<tr>
                                                    <td>$count</td>
                                                    <td>".$val["Id"]."</td>
                                                    <td>".$val["Customer"]."</td>
                                                    <td>".$val["Date"]."</td>
                                                    <td>".$val["Shipping"]."</td>
                                                    <td>".number_format($val["Total"])."</td>
                                                    <td>".$status."</td>
                                                    <td>".$actionBtn."</td>
                                                </tr>";
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
            <!-- Pop up add accounts -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chi tiết hóa đơn</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="create-form">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Mã hóa đơn</label>
                                    <input type="text" class="form-control" id="code" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="customer" class="form-label">Khách hàng</label>
                                    <input type="text" class="form-control" id="customer" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="total" class="form-label">Tổng giá</label>
                                    <input type="text" class="form-control" id="total" disabled>
                                </div>
                                <div class="error">Error print here</div>
                            </form>
                        </div>
                        <div class="container-fluid">
                            <!-- ============================================================== -->
                            <!-- Start Page Content -->
                            <!-- ============================================================== -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="white-box">
                                        <div class="table-responsive">
                                            <table class="table text-nowrap">
                                                <thead>
                                                <tr>
                                                    <th class="border-top-0">#</th>
                                                    <th class="border-top-0">Mã sản phẩm</th>
                                                    <th class="border-top-0">Tên sản phẩm</th>
                                                    <th class="border-top-0">Loại</th>
                                                    <th class="border-top-0">Số lượng</th>
                                                    <th class="border-top-0">Đơn giá</th>
                                                    <th class="border-top-0">Thành tiền</th>
                                                </tr>
                                                </thead>
                                                <tbody id="details-table">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="submit-create-form" type="button" class="btn btn-primary">In</button>
                        </div>
                    </div>
                </div>
            </div>
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
    $(document).on("click", "tbody tr", function (e) {
        var code = $(this).find("td").eq(1).text();
        var customer = $(this).find("td").eq(2).text();
        var total = $(this).find("td").eq(5).text();
        if (e.target == $(this).find("button")[2] && e.target.getAttribute("f") == "delete" && confirm(`Đồng ý xóa hóa đơn "${code}" ?!`)) {
            $.ajax({
                method:"post",
                url:"../handle/handle_invoice.php",
                data: {code: code, delete: "delete"},
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_invoice.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }

        if (e.target == $(this).find("button")[0] && e.target.getAttribute("f") == "details") {
            $("#code").val(code);
            $("#customer").val(customer);
            $("#total").val(total + " đồng");
            $("#details-table").empty();
            $.ajax({
                method: "post",
                url: "../handle/handle_invoice.php",
                data: {code: code, get: "get"},
                success: function(res) {
                    var data = JSON.parse(res);
                    var count = 1;
                    for (row in data) {
                        var render = `
                        <tr>
                            <td>${count++}</td>
                            <td>${data[row]['Code']}</td>
                            <td>${data[row]['Name']}</td>
                            <td>${data[row]['Type']}</td>
                            <td>${data[row]['Amount']}</td>
                            <td>${data[row]['Price']}</td>
                            <td>${data[row]['Total']}</td>
                        </tr>`;
                        $("#details-table").append(render);
                    }
                }
            })
        }
    })

    $("#submit-create-form").click(function () {
        return; // Unavailable now ~
        var code = document.getElementById("code").value;
        var name = document.getElementById("name").value;
        var description = document.getElementById("description").value;

        if (code.length < 5 || name.length < 5) {
            $("#create-form div.error").css("display", "unset");
            $("#create-form div.error").text("Fill out all inputs");
        } else {
            $.ajax({
                method:"post",
                url:"../handle/handle_nxb.php",
                data: {
                    code: code,
                    name: name,
                    description: description,
                    create: "create"
                },
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_nxb.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })
</script>

</html>