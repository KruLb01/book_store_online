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
    <title>Quản lý phân quyền</title>
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
                        <h4 class="page-title">Quản lý phân quyền</h4>
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
                            <h3 class="box-title">Quyền</h3>
                            <div class="row">
                                <p class="text-muted col-sm-9"><code>Tất cả quyền trong hệ thống</code></p>
                                <div class="col-md-3">
                                    <button id="create-btn" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm</button>
                                    <button type="button" class="btn btn-secondary">Xuất Excel</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Mã quyền</th>
                                            <th class="border-top-0">Tên quyền</th>
                                            <th class="border-top-0">Mô tả</th>
                                            <th class="border-top-0">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-role">
                                    <?php
                                        include_once("../class/role.php");
                                        $roleModel = new role();

                                        $data = $roleModel->getAllRoles();
                                        $count = 1;
                                        foreach ($data as $key=>$val) {
                                            $roleBtn = $val["Role"] != 1 ? "<button f='role-func' type='button' class='btn btn-orange' data-bs-toggle='modal' data-bs-target='#popupRoleFunc'>Phân quyền</button>" : "";
                                            $actionBtn = " <button f='edit' type='button' class='btn btn-info'><i class='fas fa-pencil-alt'></i></button>
                                                           <button f='delete' type='button' class='btn btn-danger'><i class='fas fa-trash'></i></button>";
                                            if ($count <= 2) $actionBtn = "";
                                            if ($val["Role"] != 1) {
                                                $actionBtn = $roleBtn . $actionBtn;
                                            }
                                            $render =  "<tr>
                                                    <td>$count</td>
                                                    <td>".$val["Role"]."</td>
                                                    <td>".$val["Name"]."</td>
                                                    <td>".$val["Description"]."</td>
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
                            <h5 class="modal-title" id="exampleModalLabel">Thêm quyền mới</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="create-form">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên quyền</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả quyền</label>
                                    <textarea type="text" class="form-control" id="description" rows="4"></textarea>
                                </div>
                                <div class="error">Error print here</div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="submit-create-form-role" type="button" class="btn btn-primary">Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->

            <!-- Pop up role-func -->
            <div class="modal fade" id="popupRoleFunc" tabindex="-1" aria-labelledby="popupRoleFuncLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="popupRoleFuncLabel">Phân quyền</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-role-func">
                                <div class="mb-3">
                                    <label for="code-role-func" class="form-label">Mã quyền</label>
                                    <input type="text" class="form-control" id="code-role-func" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="name-role-func" class="form-label">Tên quyền</label>
                                    <input type="text" class="form-control" id="name-role-func" disabled>
                                </div>
                                <?php
                                    include_once("../class/role.php");
                                    $functionModel = new role();

                                    $data = $functionModel->getFunctions();
                                    foreach ($data as $key=>$val) {
                                        $render = "<div class='form-check form-switch'>
                                              <input class='form-check-input' type='checkbox' role='switch' func='{$val['Id']}' id='flexSwitch{$val['Id']}'>
                                              <label class='form-check-label' for='flexSwitch{$val['Id']}'>{$val['Name']}</label>
                                            </div>";
                                        echo $render;
                                    }
                                ?>
                                <div class="error">Error print here</div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="submit-form-role-func" type="button" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Container fluid for functions -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Chức năng</h3>
                            <div class="row">
                                <p class="text-muted col-sm-9"><code>Tất cả chức năng trong hệ thống</code></p>
                                <div class="col-md-3">
                                    <button id="create-btn1" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal1">Thêm</button>
                                    <button type="button" class="btn btn-secondary">Xuất Excel</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">#</th>
                                        <th class="border-top-0">Mã chức năng</th>
                                        <th class="border-top-0">Tên chưc năng</th>
                                        <th class="border-top-0">Mô tả</th>
                                        <th class="border-top-0">File liên kết</th>
                                        <th class="border-top-0">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-func">
                                    <?php
                                    include_once("../class/role.php");
                                    $roleModel = new role();

                                    $data = $roleModel->getFunctions();
                                    $count = 1;
                                    foreach ($data as $key=>$val) {
                                        $actionBtn = "<button f='edit' type='button' class='btn btn-info'><i class='fas fa-pencil-alt'></i></button>
                                                           <button f='delete' type='button' class='btn btn-danger'><i class='fas fa-trash'></i></button>";
                                        $render =  "<tr>
                                                    <td>$count</td>
                                                    <td>".$val["Id"]."</td>
                                                    <td><i class='{$val['Icon']}' aria-hidden='true'></i> ".$val["Name"]."</td>
                                                    <td>".$val["Description"]."</td>
                                                    <td>".$val["File"]."</td>
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
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Thêm chức năng mới</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="create-form-func">
                                <div class="mb-3">
                                    <label for="code-func" class="form-label">Mã chức năng</label>
                                    <input type="text" class="form-control" id="code-func">
                                </div>
                                <div class="mb-3">
                                    <label for="name-func" class="form-label">Tên quyền</label>
                                    <input type="text" class="form-control" id="name-func">
                                </div>
                                <div class="mb-3">
                                    <label for="description-func" class="form-label">Mô tả quyền</label>
                                    <textarea type="text" class="form-control" id="description-func" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="icon-func" class="form-label">Icon chức năng</label>
                                    <input type="text" class="form-control" id="icon-func">
                                </div>
                                <div class="mb-3">
                                    <label for="file-func" class="form-label">File</label>
                                    <input type="text" class="form-control" id="file-func">
                                </div>
                                <div class="error">Error print here</div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="submit-create-form-func" type="button" class="btn btn-primary">Thêm</button>
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
    let role_func = {
        roleSetFunc: "roleSetFunc"
    };
    function getRoleFunc() {
        $.ajax({
            method: "post",
            url: "../handle/handle_role.php",
            data: {get: "functions"},
            success: function(res) {
                var data = JSON.parse(res);
                for (row in data) {
                    role_func[data[row]["Id"]] = 0;
                }
            }
        })
    }
    $(document).ready(function() {
        getRoleFunc();
    })

    $(document).on("click", "tbody#table-role tr", function (e) {
        var code = $(this).find("td").eq(1).text();
        var name = $(this).find("td").eq(2).text();
        if (e.target == $(this).find("button")[2] && e.target.getAttribute("f") == "delete" && confirm(`Đồng ý xóa quyền "${code}" ?!`)) {
            $.ajax({
                method:"post",
                url:"../handle/handle_role.php",
                data: {code: code, delete: "role"},
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_role.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }

        if (e.target == $(this).find("button")[0] && e.target.getAttribute("f") == "role-func") {
            $("#code-role-func").val(code);
            $("#name-role-func").val(name);
            // Set all unchecked
            $("#form-role-func").find("input.form-check-input").prop("checked", false);
            getRoleFunc();
            $.ajax({
                method: "post",
                url: "../handle/handle_role.php",
                data: {code: code, "code-func": "code-func"},
                success: function(res) {
                    var data = JSON.parse(res);
                    for (row in data) {
                        role_func[data[row]["Id"]] = 1;
                        $("#flexSwitch"+data[row]['Id']).prop("checked", "checked");
                    }
                }
            })
        }
    })


    $("#submit-create-form-role").click(function () {
        var name = document.getElementById("name").value;
        var description = document.getElementById("description").value;

        if (name.length < 4) {
            $("#create-form div.error").css("display", "unset");
            $("#create-form div.error").text("Vui lòng điền đầy đủ thông tin");
        } else {
            $.ajax({
                method:"post",
                url:"../handle/handle_role.php",
                data: {
                    name: name,
                    description: description,
                    create: "role"
                },
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_role.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })

    $(document).on("click", "tbody#table-func tr", function (e) {
        var code = $(this).find("td").eq(1).text();
        if (e.target == $(this).find("button")[1] && e.target.getAttribute("f") == "delete" && confirm(`Đồng ý xóa chức năng "${code}" ?!`)) {
            $.ajax({
                method:"post",
                url:"../handle/handle_role.php",
                data: {code: code, delete: "function"},
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_role.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })

    $("#submit-create-form-func").click(function () {
        var code = document.getElementById("code-func").value;
        var name = document.getElementById("name-func").value;
        var description = document.getElementById("description-func").value;
        var icon = document.getElementById("icon-func").value;
        var file = document.getElementById("file-func").value;

        if (code.length < 4 || name.length < 5 || file.length < 5 ) {
            $("#create-form-func div.error").css("display", "unset");
            $("#create-form-func div.error").text("Vui lòng điền đầy đủ thông tin");
        } else {
            $.ajax({
                method:"post",
                url:"../handle/handle_role.php",
                data: {
                    code: code,
                    name: name,
                    description: description,
                    icon: icon,
                    file: file,
                    create: "function"
                },
                success:function(res) {
                    if (res.trim() == "success") {
                        window.location = "manage_role.php";
                    } else alert("Thao tác thất bại !");
                }
            })
        }
    })

    $("#submit-form-role-func").click(function () {
        var all = $("#form-role-func").find("input.form-check-input");
        var amount = all.length;
        for (i = 0; i < amount; i ++) {
            var id_func = all.eq(i).attr("func");
            if (all.eq(i).prop("checked")) role_func[id_func] = 1;
            else role_func[id_func] = 0;
        }
        role_func["code"] = $("#code-role-func").val();
        $.ajax({
            method:"post",
            url:"../handle/handle_role.php",
            data: role_func,
            success: function(res) {
                if (res.trim() == "success") {
                    window.location = "manage_role.php";
                } else alert("Thao tác thất bại !");
            }
        })
    })
</script>

</html>