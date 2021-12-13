<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/nxb.php");
        $nxbModel = new nxb();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $nxbModel->deleteNXB($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>
