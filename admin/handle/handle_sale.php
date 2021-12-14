<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/sale.php");
        $saleModel = new sale();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $saleModel->deleteSale($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/sale.php");
        $saleModel = new sale();

        // Nhan input
        $newSale = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"],
            "Start" => $_POST["start"],
            "End" => $_POST["end"],
            "Percent" => $_POST["percent"],
            "Dong" => $_POST["dong"],
        );

        $res = $saleModel->createSale($newSale);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>
