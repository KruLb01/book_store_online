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
            font-size: 1rem;
            font-weight: 500;
        }
    </style>
</head>

<body onload="addField()">
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
        <div class="page-wrapper" style="min-height: 250px;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Nhập hàng</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="#" class="fw-normal">Quay lại trang chính</a></li>
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
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">Phiếu nhập</h3>
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label"><code>Nhà cung cấp</code></label>
                                    <select class="form-select" id="ncc">
                                        <option selected>Chọn nhà cung cấp</option>
                                        <?php
                                            include_once("../class/nxb.php");
                                            $nxbModel = new nxb();

                                            $roles = $nxbModel->getNXB();
                                            foreach ($roles as $key=>$val) {
                                                echo "<option value='{$val['Id']}'>{$val['Name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><code>Tổng giá nhập</code></label>
                                    <input type="text" class="form-control" name="total" id="total-header" disabled>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12" id="container-notes">
                        <form id="import-form">
                            <div id="form-group-btn" class="white-box row g-3">
                                <div class="error">Error print here</div>
                                <div class="col-auto">
                                    <button id="add-btn" type="submit" class="btn btn-success mb-3">Thêm sản phẩm</button>
                                </div>
                                <div class="col-auto" style="display: flex; align-items: center"><code style="transform: translateY(-50%);">Tổng giá nhập</code></div>
                                <div class="col-auto">
                                    <input type="text" class="form-control" id="total-footer" disabled>
                                </div>
                                <div class="col-auto">
                                    <button id="save-btn" type="submit" class="btn btn-primary mb-3">Lưu phiếu</button>
                                </div>
                            </div>
                        </form>
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
    let total = 0;
    function addField() {
        var render = `
                            <div class="white-box row g-3 data">
                                <div class="col-md-9">
                                    <label class="form-label">Sách</label>
                                    <select class="form-select" name='code'>
                                        <option selected>Chọn sách</option>
                                        <?php
                                            include_once("../class/books.php");
                                            $bookModel = new books();

                                            $roles = $bookModel->getBooks();
                                            foreach ($roles as $key=>$val) {
                                                echo "<option value='{$val['Id']}'>{$val['Name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Số lượng</label>
                                    <input type="number" class="form-control get-data" name="amount" onkeyup="var amount = $(this).val(); var parent = $(this).parent().parent();var price = parent.find('input[name=price]').val(); var total = (amount*price).toLocaleString(); $(this).parent().parent().find('input[name=total]').val(total + ' đồng'); getTotal()">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Đơn giá</label>
                                    <input type="number" class="form-control get-data" name="price" onkeyup="var price = $(this).val(); var parent = $(this).parent().parent();var amount = parent.find('input[name=amount]').val(); var total = (amount*price).toLocaleString(); $(this).parent().parent().find('input[name=total]').val(total + ' đồng'); getTotal()">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Thành tiền</label>
                                    <input type="text" class="form-control" name="total" disabled>
                                </div>
                            </div>
        `;
        $("#form-group-btn").before(render);
    }
    function getTotal() {
        var total = 0;
        var elements = $("#container-notes input[name=total]");
        var amount_elements = elements.length;

        for (var i = 0; i < amount_elements; i ++) {
            var element = elements.eq(i);
            total += parseInt(element.val().split(" ")[0].replace(/,/g, ""));
        }
        total = total.toLocaleString() + " đồng";
        $("#total-header").val(total);
        $("#total-footer").val(total);
    }
    $("#import-form").click(function (e) {
        e.preventDefault()
        var form = $(this);
        var data = [];
        if (e.target == $("#add-btn")[0]) {
            addField();
        }

        if (e.target == $("#save-btn")[0]) {
            // Get nha cung cap va ngay nhap
            var date = new Date().toISOString().replace('-', '/').split('T')[0].replace('-', '/');
            var ncc = $("#ncc").val();
            if (ncc.trim() == "Chọn nhà cung cấp") {
                $("#form-group-btn .error").css("display", "unset");
                $("#form-group-btn .error").text("Vui lòng chọn nhà cung cấp !");
                return;
            }

            var notes = form.find(".data ");
            var amount_notes = notes.length;
            for (var i = 0; i < amount_notes; i ++) {
                var note = notes.eq(i);
                var code = note.find("select[name=code]").val();
                if (code.trim() == "Chọn sách") {
                    $("#form-group-btn .error").css("display", "unset");
                    $("#form-group-btn .error").text("Vui lòng chọn đầy đủ sách !");
                    return;
                }
                var amount = note.find("input[name=amount]").val();
                var price = note.find("input[name=price]").val();

                data.push({
                    Code: code,
                    Amount: amount,
                    Price: price
                })
            }
            if (confirm("Đồng ý tạo phiếu nhập ?!")) {
                $.ajax({
                    method:"post",
                    url:"../handle/handle_import.php",
                    data: {
                        data: data,
                        Ncc: ncc,
                        Date: date,
                        create: "create"
                    },
                    success: function (res) {
                        if (res.trim() == "success") {
                            window.location = "import_book.php";
                        } else alert("Thao tác thất bại !");
                    }
                })
            }
        }
    })
</script>
</html>