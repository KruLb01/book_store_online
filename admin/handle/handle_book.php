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

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/books.php");
        $bookModel = new books();

        // Nhan input
        $newBook = array(
            "Code"=> $_POST["code"],
            "Category"=> $_POST["category"],
            "Name"=> $_POST["name"],
            "Author"=> $_POST["author"],
            "Nxb"=> $_POST["nxb"],
            "Released"=> $_POST["released"],
            "Amount"=> $_POST["amount"],
            "Description"=> $_POST["description"],
            "Language"=> $_POST["language"],
            "Price"=> $_POST["price"],
            "Ebook"=> $_POST["ebook"],
        );

        $res = $bookModel->createBook($newBook);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

?>