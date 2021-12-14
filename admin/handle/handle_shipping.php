<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/shipping.php");
        $shippingModel = new shipping();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $shippingModel->deleteShipping($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/shipping.php");
        $shippingModel = new shipping();

        // Nhan input
        $newShippingType = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"],
            "Description" => $_POST["description"]
        );

        $res = $shippingModel->createShipping($newShippingType);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>
