<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="16x16" href="../static/plugins/images/favicon.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: "Nunito Sans", sans-serif;
        }
        .login {
            display: flex;
            height: 100%;
            width: 100%;
            background-color: rgb(235, 240, 235);
            justify-content: center;
            align-items: center;
            position : fixed;
        }
        .login-container {
            width: 60%;
            background-color: #fdf7eb;
            display: flex;
            border-radius: 8px;
        }
        .logo {
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo img {
            height: 300px;
            width: 300px;
        }
        .content-login {
            width: 60%;
        }
        .content-login {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content-login form label {
            display: block;
            font-weight: 500;
            font-size: 20px;
            padding: 10px 0;
        }
        .content-login form input {
            width: 200px;
            height: 25px;
            margin: 0 20px;
            font-size: 18px;
        }
        .content-login form button {
            margin: 15px 0;
            padding: 10px;
            font-size: 20px;
            font-weight: 500;
            color: #fff;
            background-color: #159981;
            cursor: pointer;
            border-radius: 5px;
            border: 1px solid rgb(95, 91, 91);
        }
        .error {
            display: none;
            color: red;
            padding: 10px 0 0 0;
            font-size: 18px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="login">
    <div class="login-container">
        <div class="logo">
            <img src="../static/images/logo.jpg" alt="Logo website">
        </div>

        <div class="content-login">
            <form id="login-form">
                <label for="username">Tài khoản<input type="text" name="username" id="username"></label>
                <label for="password">Mật khẩu <input type="password" name="password" id="password"></label>
                <span class="error">Error print here</span>
                <div class="submit-container">
                    <button id="login-btn">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

<script>
    function validateLogin() {
        let username = document.getElementsByName("username")[0].value;
        let password = document.getElementsByName("password")[0].value;
        if (username.trim() == "" || password.trim() == "") {
            document.getElementsByClassName('error')[0].innerHTML = 'Vui lòng nhập vào username và password'
            document.getElementsByClassName('error')[0].style = 'display:block;';
        } else {
            return true;
        }
        return false;
    }

    $(".submit-container button").click(function(e) {
        e.preventDefault();
        if (status = validateLogin()) {
            $.ajax({
                method:'post',
                url:'../handle/handle_login.php',
                data:$('#login-form').serialize(),
                success:function(res) {
                    if (res.trim() == "success") {
                        $('.error').css('display','none');
                        window.location = '../index.php';
                    } else if (res.trim() == "unable") {
                        $('.error').html('Tài khoản đã bị khóa !');
                        $('.error').css('display','block');
                    } else {
                        $('.error').html('Tài khoản hoặc mật khẩu không đúng !');
                        $('.error').css('display','block');
                    }
                }
            })
        }
    })
</script>

</html>