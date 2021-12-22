<?php
    session_start();
    if (isset($_POST["action"]) && isset($_POST["username"]) && isset($_POST["password"]))
    {
        $action = $_POST["action"];
        switch($action)
        {
            case "register": {
                include_once("../../class/account.php");
                $accountModel = new account();
                $username = $_POST["username"];
                $password = $_POST["password"];
                $res = $accountModel->registerAccount($username, $password);
                if(trim($res)) {
                    $_SESSION["customer"]["User"] = $username;
                    $_SESSION["customer"]["Password"] = $password;
                    echo "success";
                } else { 
                    echo "fail";
                }
            } break;
            case "login": {
                include_once("../class/account.php");
                $accountModel = new account();
                $username = $_POST["username"];
                $password = $_POST["password"];

                $data = $accountModel-> checkLogin($username, $password);
                if (sizeof($data)==0) {
                    echo "fail";
                } else {
                    if ($data["Status"]==0) {
                        echo "fail";
                        return;
                    }
                    $_SESSION["customer"]["User"] = $data["User"];
                    $_SESSION["customer"]["Password"] = $data["Password"];
                    $_SESSION["customer"]["Name"] = $data["Name"];
                    $_SESSION["customer"]["Email"] = $data["Email"];
                    $_SESSION["customer"]["Phone"] = $data["Phone"];
                    $_SESSION["customer"]["Address"] = $data["Address"];
                    $_SESSION["customer"]["Status"] = $data["Status"];
                    echo "success";
                }
            } break;
        }
    }
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: ../index.php");
    }

    if (isset($_POST["update"])) {
        include_once("../class/account.php");
        $accountModel = new account();
        $update = $_POST["update"];

        if ($update == "profile") {
            $user = array(
                "User" => $_SESSION['customer']['User'],
                "Name" => $_POST["name"],
                "Phone" => $_POST["phone"],
                "Email" => $_POST["email"],
                "Address" => $_POST["address"],
            );
            $res = $accountModel->updateProfile($user);
            if (trim($res)) {
                $_SESSION["customer"]["Name"] = $_POST["name"];
                $_SESSION["customer"]["Phone"] = $_POST["phone"];
                $_SESSION["customer"]["Email"] = $_POST["email"];
                $_SESSION["customer"]["Address"] = $_POST["address"];
                echo "success";
            } else echo "fail";
        } else if ($update == "password") {
            $user = array(
                "User" => $_SESSION['customer']['User'],
                "Password" => $_POST["new_password"],
            );
            $res = $accountModel->changePassword($user);
            if (trim($res)) {
                $_SESSION["customer"]["Password"] = $_POST["new_password"];
                echo "success";
            } else echo "fail";
        }
    }

?>