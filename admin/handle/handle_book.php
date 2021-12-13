<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/books.php");
        $bookModel = new books();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $bookModel->deleteBook($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>