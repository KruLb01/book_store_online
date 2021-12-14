<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/category.php");
        $categoryModel = new category();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $categoryModel->deleteCategory($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/category.php");
        $categoryModel = new category();

        // Nhan input
        $newCategory = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"]
        );

        $res = $categoryModel->createCategory($newCategory);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>
