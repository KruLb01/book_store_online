<!DOCTYPE HTML>
<html>
    <head>
        <head>
        <meta charset="UTF-8" />
        <title>Đăng nhập</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script type="text/javascript" src="../static/js/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="../static/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="../static/css/login.css"/>
    </head>
    <body>
        <div class="header">
            <a href="index.php">
                <i class="fas fa-long-arrow-alt-left"></i>Trở về trang chủ
            </a>
        </div>
        <div class="body-content">
            <div class="login-form-container">
                <form>
                    <div class="form-group">
                        <label for="tendangnhap">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="tendangnhap" name="tendangnhap" required="required">
                    </div>
                    <div class="form-group">
                        <label for="matkhau">Mật khẩu</label>
                        <input type="password" class="form-control" id="matkhau" name="matkhau" required="required">
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    <div class="form-text text-center">
                        <small>Quên mật khẩu đăng nhập? Nhấn vào <a href="#">đây</a> để khôi phục</small>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

