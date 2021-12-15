<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/import.php");
        $importModel = new import();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $importModel->deleteNote($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["get"])) {
        include_once("../class/import.php");
        $importModel = new import();

        $code = $_POST["code"];
        $data = $importModel->getDetails($code);
        echo json_encode($data);
    }

    if (isset($_POST["data"]) && isset($_POST["create"])) {
        session_start();
        include_once("../class/import.php");
        $importModel = new import();

        // Get total
        $notes = $_POST['data'];
        $total = 0;
        foreach ($notes as $key=>$val)
        {
            $total += $val["Amount"]*$val["Price"];
        }

        $array = $_POST;
        $temp = array("User"=>$_SESSION['user']['User'], "Total"=>$total);
        $array = $array + $temp;

        $res = $importModel->importBook($array);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }



?>