<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/invoice.php");
        $invoiceModel = new invoice();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $invoiceModel->deleteInvoice($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["get"])) {
        include_once("../class/invoice.php");
        $invoiceModel = new invoice();

        $code = $_POST["code"];
        $data = $invoiceModel->getDetails($code);
        echo json_encode($data);
    }

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/author.php");
        $authorModel = new author();

        // Nhan input
        $newAuthor = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"],
            "Description" => $_POST["description"]
        );

        $res = $authorModel->createAuthor($newAuthor);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>
