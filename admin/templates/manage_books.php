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
    <title>Quản lý sách</title>
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
                        <h4 class="page-title">Quản lý sách</h4>
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
                            <h3 class="box-title">Sách</h3>
                            <div class="row">
                                <p class="text-muted col-sm-9"><code>Tất cả sách trong hệ thống</code></p>
                                <div class="col-md-3">
                                    <button id="create-btn" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm</button>
                                    <button type="button" class="btn btn-secondary" onclick="window.location = '../handle/handle_book.php?export=book'">Xuất Excel</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Mã sách</th>
                                            <th class="border-top-0">Tên sách</th>
                                            <th class="border-top-0">Số lượng</th>
                                            <th class="border-top-0">Giá sách giấy (đồng)</th>
                                            <th class="border-top-0">Giá sách Ebook</th>
                                            <th class="border-top-0">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        include_once("../class/books.php");
                                        $bookModel = new books();

                                        $data = $bookModel->getBooks();
                                        $count = 1;
                                        foreach ($data as $key=>$val) {
                                            $actionBtn = "<button f='edit' type='button' class='btn btn-info'><i class='fas fa-pencil-alt'></i></button>
                                                           <button f='delete' type='button' class='btn btn-danger'><i class='fas fa-trash'></i></button>";
                                            $render =  "<tr>
                                                    <td>$count</td>
                                                    <td>".$val["Id"]."</td>
                                                    <td>".$val["Name"]."</td>
                                                    <td>".$val["Amount"]."</td>
                                                    <td>".number_format($val["PriceBook"])."</td>
                                                    <td>".number_format($val["PriceEbook"])."</td>
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
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tạo sách mới</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="create-form">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Mã sách</label>
                                    <input type="text" class="form-control" id="code">
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Thể loại</label>
                                    <select class="form-select" id="category">
                                        <option selected>Chọn danh mục</option>
                                        <?php
                                        include_once("../class/category.php");
                                        $categoryModel = new category();

                                        $roles = $categoryModel->getCategory();
                                        foreach ($roles as $key=>$val) {
                                            echo "<option value='{$val['Id']}'>{$val['Name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên sách</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Tác giả</label>
                                    <select class="form-select" id="author">
                                        <option selected>Chọn tác giả</option>
                                        <?php
                                        include_once("../class/author.php");
                                        $authorModel = new author();

                                        $roles = $authorModel->getAuthors();
                                        foreach ($roles as $key=>$val) {
                                            echo "<option value='{$val['Id']}'>{$val['Name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nxb" class="form-label">Nhà xuất bản</label>
                                    <select class="form-select" id="nxb">
                                        <option selected>Chọn nhà xuất bản</option>
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
                                <div class="mb-3">
                                    <label for="released" class="form-label">Năm ra mắt</label>
                                    <input type="number" class="form-control" id="released" value="2021">
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Số lượng</label>
                                    <input type="number" class="form-control" id="amount" value="1">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả sách</label>
                                    <textarea type="text" class="form-control" id="description" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="language" class="form-label">Ngôn ngữ</label>
                                    <input type="text" class="form-control" id="language" value="Tiếng Việt">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá sách giấy</label>
                                    <input type="number" class="form-control" id="price">
                                </div>
                                <div class="mb-3">
                                    <label for="ebook" class="form-label">Giá sách ebook</label>
                                    <input type="number" class="form-control" id="ebook">
                                </div>
                                <div class="error">Error print here</div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="submit-create-form" type="button" class="btn btn-primary">Thêm</button>
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
        if (e.target == $(this).find("button")[1] && e.target.getAttribute("f") == "delete" && confirm(`Đồng ý xóa sản phẩm "${code}" ?!`)) {
            $.ajax({
                method:"post",
                url:"../handle/handle_book.php",
                data: {code: code, delete: "delete"},
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_books.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })

    $("#submit-create-form").click(function () {
        var code = document.getElementById("code").value;
        var category = document.getElementById("category").value;
        var name = document.getElementById("name").value;
        var author = document.getElementById("author").value;
        var nxb = document.getElementById("nxb").value;
        var released = document.getElementById("released").value;
        var amount = document.getElementById("amount").value;
        var description = document.getElementById("description").value;
        var language = document.getElementById("language").value;
        var price = document.getElementById("price").value;
        var ebook = document.getElementById("ebook").value;

        if (code.length < 5 || category.trim() == "Chọn danh mục" || name.length < 5 || author.trim() == "Chọn tác giả" ||
            nxb.trim() == "Chọn nhà xuất bản" || released.length < 3 || amount.length == 0 ||
            language.length < 5 || price.length < 3 || ebook.length < 3 ) {
            $("#create-form div.error").css("display", "unset");
            $("#create-form div.error").text("Vui lòng điền đầy đủ thông tin");
        } else {
            $.ajax({
                method:"post",
                url:"../handle/handle_book.php",
                data: {
                    code: code,
                    category: category,
                    name: name,
                    author: author,
                    nxb: nxb,
                    released: released,
                    amount: amount,
                    description: description,
                    language: language,
                    price: price,
                    ebook: ebook,
                    create: "create"
                },
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_books.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })
</script>

</html>