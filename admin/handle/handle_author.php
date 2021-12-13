<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/author.php");
        $authorModel = new author();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $authorModel->deleteAuthor($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>
