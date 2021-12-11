<?php
    session_start();
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        include_once("../class/account.php");
        $accountModel = new account();

        $usernmae = $_POST["username"];
        $password = $_POST["password"];

        $data = $accountModel->checkLogin($usernmae, $password);
        if (sizeof($data)==0) {
            echo "fail";
        } else {
            $_SESSION["user"]["User"] = $data["User"];
            $_SESSION["user"]["Password"] = $data["Password"];
            $_SESSION["user"]["Name"] = $data["Name"];
            $_SESSION["user"]["Email"] = $data["Email"];
            $_SESSION["user"]["Phone"] = $data["Phone"];
            $_SESSION["user"]["Address"] = $data["Address"];
            $_SESSION["user"]["Status"] = $data["Status"];
            $_SESSION["user"]["Permission"] = $data["Permission"];
            echo "success";
        }
    } else {
        header("Location: ../templates/login.php");
    }
?>