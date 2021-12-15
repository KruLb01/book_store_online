<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />-->
<!--    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />-->
    <link rel="stylesheet" href="../assets/css/main.css" />
<!--    <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>-->
    <title>Document</title>
    <style>
        body {
            background: #ccc
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .error {
            display: none;
            color: red;
            font-size: 1.2rem;
            font-weight: 600;
            margin: 15px 0;
        }

        .profile-button {
            background: rgb(99, 39, 120);
            color: #fff !important;
            font-weight: 550;
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 1rem;
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <?php
        include_once("header.php");
        ?>
    </div>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo $_SESSION['customer']['User'] ?></span><span class="text-black-50"><?php echo $_SESSION['customer']['Email'] ?></span><span> </span></div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Thông tin cá nhân</h4>
                    </div>
                    <div class="row mt-3" id="info-form">
                        <input type="hidden" name="password" value="<?php echo $_SESSION['customer']['Password'] ?>">
                        <div class="col-md-12 mt-3"><label class="labels">Họ tên</label><input name="name" type="text" class="form-control" <?php if (isset($_SESSION['customer']['Name']) && $_SESSION['customer']['Name'] != "") echo "value='{$_SESSION['customer']['Name']}'"; else echo "placeholder='Xin chàoo 👋 bạn  ...'";  ?>></div>
                        <div class="col-md-12 mt-3"><label class="labels">Số điện thoại</label><input name="phone" type="text" class="form-control" <?php if (isset($_SESSION['customer']['Phone']) && $_SESSION['customer']['Phone'] != "0") echo "value='{$_SESSION['customer']['Phone']}'"; else echo "placeholder='Cho xin số điện thoại đi mà 😢'";  ?>></div>
                        <div class="col-md-12 mt-3"><label class="labels">Email</label><input name="email" type="text" class="form-control" <?php if (isset($_SESSION['customer']['Email']) && $_SESSION['customer']['Email'] != "") echo "value='{$_SESSION['customer']['Email']}'"; else echo "placeholder='Chưa có email nè'";  ?>></div>
                        <div class="col-md-12 mt-3"><label class="labels">Địa chỉ</label><textarea name="address" type="text" rows="4" class="form-control" <?php if (isset($_SESSION['customer']['Address']) && $_SESSION['customer']['Address'] != "") echo ">{$_SESSION['customer']['Address']}"; else echo "placeholder='Cho tui địa chỉ giao hàng đi chứ 😠'>";  ?></textarea>
                    </div>
                    <div class="error">Error print here</div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button" id="save-btn">Lưu thông tin</button></div>
                </div>
            </div>
        </div>
    </div>
        <?php echo $_SESSION['customer']['Address'] ?>
    <!-- Scripts -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.scrolly.min.js"></script>
    <script src="../assets/js/jquery.scrollex.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
<script>
    $("#save-btn").click(function() {
        var form = $("#info-form");
        var password = form.find("input[name=password]").val();
        var name = form.find("input[name=name]").val();
        var phone = form.find("input[name=phone]").val();
        var email = form.find("input[name=email]").val();
        var address = form.find("textarea[name=address]").val();

        if (name.trim().length < 5 || phone.trim().length != 10 || email.trim().length < 5 || address.trim().length < 5 ) {
            form.find(".error").css("display", "unset");
            form.find(".error").text("Thông tin không hợp lệ");
        } else if (prompt("Nhập mật khẩu để cập nhật thông tin")==password) {
            $.ajax({
                method: "post",
                url: "../handle/handle_account.php",
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    address: address,
                    update: "profile"
                },
                success: function(res) {
                    if (res.trim()=="success") {
                        window.location = "profile.php";
                    } else alert("Thao tác thất bại");
                }
            })
        }
    })
</script>
</html>