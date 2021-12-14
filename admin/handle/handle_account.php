<?php
    if (isset($_POST["user"]) && isset($_POST["status"]))
    {
        include_once("../class/account.php");
        $accountModel = new account();

        // Thuc hien thay doi trang thai t.khoan
        $user = $_POST["user"];
        $status = $_POST["status"];
        $res = $accountModel->changeStatus($user, $status);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["user"]) && isset($_POST["delete"]))
    {
        include_once("../class/account.php");
        $accountModel = new account();

        // Thuc hien xoa t.khoan
        $user = $_POST["user"];
        $res = $accountModel->deleteAccount($user);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["username"]) && isset($_POST["create"])) {
        include_once("../class/account.php");
        $accountModel = new account();

        // Nhan input
        $type = $_POST["create"];
        $newUser = array(
            "User" => $_POST["username"],
            "Password" => $_POST["password"],
            "Name" => $_POST["name"],
            "Email" => $_POST["email"],
            "Phone" => $_POST["phone"],
            "Address" => $_POST["address"],
            "Status" => 1
        );
        $role = array();
        if ($type == "customer") {
            $role = array("Permission" => 1);
        } else if ($type == "employee") {
            $role = array("Permission" => $_POST["permission"]);
        }

        $newUser = $newUser + $role;
        $res = $accountModel->createAccount($newUser);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["update"]))
    {
        session_start();
        include_once("../class/account.php");
        $accountModel = new account();

        // Nhan input
        $user = array(
            "User" => $_SESSION['user']['User'],
            "Name" => $_POST['name'],
            "Email" => $_POST['email'],
            "Password" => $_POST['password'],
            "Phone" => $_POST['phone'],
            "Address" => $_POST['address'],
        );

        $res = $accountModel->updateAccount($user);
        if (trim($res)) {
            echo "success";
            $_SESSION["user"]["Password"] = $user["Password"];
            $_SESSION["user"]["Name"] = $user["Name"];
            $_SESSION["user"]["Email"] = $user["Email"];
            $_SESSION["user"]["Phone"] = $user["Phone"];
            $_SESSION["user"]["Address"] = $user["Address"];
        } else echo "fail";
    }

?>