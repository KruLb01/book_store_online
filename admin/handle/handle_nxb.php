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

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/nxb.php");
        $nxbModel = new nxb();

        // Nhan input
        $newNXB = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"],
            "Description" => $_POST["description"]
        );

        $res = $nxbModel->createNXB($newNXB);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>
