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
    <title>Quản lý nhân viên</title>
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
                        <h4 class="page-title">Quản lý nhân viên</h4>
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
                            <h3 class="box-title">Nhân viên</h3>
                            <div class="row">
                                <p class="text-muted col-sm-9"><code>Quản lý tài khoản nhân viên</code></p>
                                <div class="col-md-3">
                                    <button id="create-btn" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm</button>
                                    <button type="button" class="btn btn-secondary" onclick="window.location = '../handle/handle_account.php?export=employee'">Xuất Excel</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Tài khoản</th>
                                            <th class="border-top-0">Họ tên</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Số điện thoại</th>
                                            <th class="border-top-0">Địa chỉ</th>
                                            <th class="border-top-0">Quyền</th>
                                            <th class="border-top-0">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include_once("../class/account.php");
                                    $accountModel = new account();

                                    $data = $accountModel->employeeAccounts();
                                    $count = 1;
                                    foreach ($data as $key=>$val) {
                                        if ($val["Status"] == 0) {
                                            $render = "<tr cs='0' style='color:red'>";
                                            $actionBtn = "<button f='status' type='button' class='btn btn-success'>Mở khóa</button>
                                                            <button f='edit' type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#updateModal'><i class='fas fa-pencil-alt'></i></button>
                                                            <button f='delete' type='button' class='btn btn-danger' style='background: red'><i class='fas fa-trash'></i></button>
                                                            <button f='role' type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#exampleModal1'>Phân quyền</button>";
                                        } else {
                                            $render = "<tr cs='1'>";
                                            $actionBtn = "<button f='status' type='button' class='btn btn-secondary'>Khóa</button>
                                                            <button f='edit' type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#updateModal'><i class='fas fa-pencil-alt'></i></button>
                                                            <button f='delete' type='button' class='btn btn-danger' style='background: red'><i class='fas fa-trash'></i></button>
                                                            <button f='role' type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#exampleModal1'>Phân quyền</button>";
                                        }
                                        if ($val["User"] == "admin") {
                                            $actionBtn= "";
                                        }
                                        $render .=  "
                                                    <td>$count</td>
                                                    <td>".$val["User"]."</td>
                                                    <td>".$val["Name"]."</td>
                                                    <td>".$val["Email"]."</td>
                                                    <td>".$val["Phone"]."</td>
                                                    <td>".$val["Address"]."</td>
                                                    <td>".$val["Permission"]."</td>
                                                    <td>$actionBtn</td>
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
                            <h5 class="modal-title" id="exampleModalLabel">Tạo tài khoản nhân viên mới</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="create-form">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Tài khoản</label>
                                    <input type="text" class="form-control" id="username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address">
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Quyền</label>
                                    <select class="form-select" id="role">
                                        <option selected>Chọn quyền</option>
                                        <?php
                                            include_once("../class/role.php");
                                            $roleModel = new role();

                                            $roles = $roleModel->getRoles();
                                            foreach ($roles as $key=>$val) {
                                                echo "<option value='{$val['Role']}'>{$val['Name']}</option>";
                                            }
                                        ?>
                                    </select>
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

            <!-- Pop up add accounts -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Phân quyền cho tài khoản</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="role-form">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Tài khoản</label>
                                    <input type="text" class="form-control" id="role-username" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" id="role-name" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Quyền</label>
                                    <select class="form-select" id="role-role">
                                        <option selected>Chọn quyền</option>
                                        <?php
                                        include_once("../class/role.php");
                                        $roleModel = new role();

                                        $roles = $roleModel->getRoles();
                                        foreach ($roles as $key=>$val) {
                                            echo "<option value='{$val['Role']}'>{$val['Name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="error">Error print here</div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="submit-role-form" type="button" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->

            <!-- Pop up update accounts -->
            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Cập nhật thông tin nhân viên</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="update-form">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Tài khoản</label>
                                    <input type="text" class="form-control" id="username-edit" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" id="name-edit">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email-edit">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone-edit">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address-edit">
                                </div>
                                <div class="error">Error print here</div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="submit-update-form" type="button" class="btn btn-primary">Cập nhật</button>
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
        var user = $(this).find("td").eq(1).text();
        var name = $(this).find("td").eq(2).text();
        var email = $(this).find("td").eq(3).text();
        var phone = $(this).find("td").eq(4).text();
        var address = $(this).find("td").eq(5).text();
        var status = this.getAttribute("cs");
        var first_target = $(this);
        if (e.target == $(this).find("button")[0] && e.target.getAttribute("f") == "status" && confirm(`Đồng ý cập nhật trạng thái tài khoản "${user}" ?!`)) {
            $.ajax({
                method:"post",
                url:"../handle/handle_account.php",
                data: {user: user, status: status},
                success:function(res) {
                    if (res.trim() == "success") {
                        if (status == 0) {
                            $(first_target).attr("cs", 1);
                            $(first_target).css("color","#3e5569");
                            $(e.target).replaceWith("<button f='status' type='button' class='btn btn-secondary'>Khóa</button>");
                        } else {
                            $(first_target).attr("cs", 0);
                            $(first_target).css("color", "red");
                            $(e.target).replaceWith("<button f='status' type='button' class='btn btn-success'>Mở khóa</button>");
                        }
                    } else alert("Thao tác thất bại !");
                }
            })
        }

        if (e.target == $(this).find("button")[1] && e.target.getAttribute("f") == "edit") {
            $("#username-edit").val(user);
            $("#name-edit").val(name);
            $("#email-edit").val(email);
            $("#phone-edit").val(phone);
            $("#address-edit").val(address);
        }

        if (e.target == $(this).find("button")[2] && e.target.getAttribute("f") == "delete" && confirm(`Đồng ý xóa tài khoản "${user}" ?!`)) {
            $.ajax({
                method:"post",
                url:"../handle/handle_account.php",
                data: {user: user, delete: "delete"},
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_employees.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }

        if (e.target == $(this).find("button")[3] && e.target.getAttribute("f") == "role") {
            $("#role-form").find("#role-username").val(user);
            $("#role-form").find("#role-name").val(name);
        }
    })

    $("#submit-create-form").click(function () {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var role = document.getElementById("role").value;

        if (username.length < 5 || password.length < 5 || name.length < 5 || email.length < 5 || phone.length < 5 || address.length < 5 || role.trim() == "Chọn quyền" ) {
            $("#create-form div.error").css("display", "unset");
            $("#create-form div.error").text("Vui lòng điền đầy đủ thông tin");
        } else {
            $.ajax({
                method:"post",
                url:"../handle/handle_account.php",
                data: {
                    username: username,
                    password: password,
                    name: name,
                    email: email,
                    phone: phone,
                    address: address,
                    permission: role,
                    create: "employee"
                },
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_employees.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })

    $("#submit-update-form").click(function () {
        var username = document.getElementById("username-edit").value;
        // var password = document.getElementById("password-edit").value;
        var name = document.getElementById("name-edit").value;
        var email = document.getElementById("email-edit").value;
        var phone = document.getElementById("phone-edit").value;
        var address = document.getElementById("address-edit").value;

        if (username.length < 5 || password.length < 5 || name.length < 5 || email.length < 5 || phone.length < 5 || address.length < 5 ) {
            $("#update-form div.error").css("display", "unset");
            $("#update-form div.error").text("Vui lòng điền đầy đủ thông tin");
        } else if (confirm("Lưu cập nhật tài khoản nhân viên ?")) {
            $.ajax({
                method:"post",
                url:"../handle/handle_account.php",
                data: {
                    username: username,
                    // password: password,
                    name: name,
                    email: email,
                    phone: phone,
                    address: address,
                    update: "update"
                },
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_employees.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })

    $("#submit-role-form").click(function () {
        var username = document.getElementById("role-username").value;
        var role = document.getElementById("role-role").value;

        if (role.trim() == "Chọn quyền" ) {
            $("#create-form div.error").css("display", "unset");
            $("#create-form div.error").text("Vui lòng chọn quyền cho tài khoản");
        } else {
            $.ajax({
                method:"post",
                url:"../handle/handle_account.php",
                data: {
                    username: username,
                    role: role,
                    update: "role"
                },
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_employees.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })
</script>

</html>