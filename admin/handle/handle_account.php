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
        $update = $_POST["update"];

        if ($update=="role") {
            $user = $_POST["username"];
            $role = $_POST["role"];

            $res = $accountModel->updateRole($user, $role);
            if (trim($res)) {
                echo "success";
            } else echo "fail";

            return;
        } else if ($update=="profile") {
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
        // Nhan input
        $user = array(
            "User" => $_POST['username'],
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

    if (isset($_GET["export"])) {
        $type_export = $_GET["export"];

        include_once("../plugin/PHPExcel/Classes/PHPExcel.php");
        $phpExcel = new PHPExcel();

        include_once("../class/account.php");
        $accountModel = new account();

        $data = [];

        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setTitle("Danh sách khách hàng");
        $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

        $phpExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

        $phpExcel->getActiveSheet()->setCellValue('A1', 'Tên tài khoản');
        $phpExcel->getActiveSheet()->setCellValue('B1', 'Mật khẩu');
        $phpExcel->getActiveSheet()->setCellValue('C1', 'Email');
        $phpExcel->getActiveSheet()->setCellValue('D1', 'Họ tên khách hàng');
        $phpExcel->getActiveSheet()->setCellValue('E1', 'Địa chỉ');
        $phpExcel->getActiveSheet()->setCellValue('F1', 'Số điện thoại');
        $phpExcel->getActiveSheet()->setCellValue('G1', 'Tình trạng tài khoản');

        if ($type_export == "customer") $data = $accountModel->customerAccounts();
        if ($type_export == "employee") {
            $data = $accountModel->employeeAccounts();
            $phpExcel->getActiveSheet()->setTitle("Danh sách nhân viên");
            $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $phpExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
            $phpExcel->getActiveSheet()->setCellValue('H1', 'Quyền tài khoản');
        }

        $rowStart = 2;
        foreach ($data as $key=>$val) {
            $phpExcel->getActiveSheet()->setCellValue('A' . $rowStart, $val["User"]);
            $phpExcel->getActiveSheet()->setCellValue('B' . $rowStart, $val["Password"]);
            $phpExcel->getActiveSheet()->setCellValue('C' . $rowStart, $val["Email"]);
            $phpExcel->getActiveSheet()->setCellValue('D' . $rowStart, $val["Name"]);
            $phpExcel->getActiveSheet()->setCellValue('E' . $rowStart, $val["Address"]);
            $phpExcel->getActiveSheet()->setCellValue('F' . $rowStart, $val["Phone"]);
            $phpExcel->getActiveSheet()->setCellValue('G' . $rowStart, $val["Status"] == 0 ? "Đang bị khóa": "Đang sử dụng");
            if ($type_export == "employee") $phpExcel->getActiveSheet()->setCellValue('H' . $rowStart, $val["Permission"]);
            $rowStart++;
        }

        $filename_save = $type_export == "customer" ? '../data/list_customer.xlsx' : '../data/list_employee.xlsx';
        $filename_open = $type_export == "customer" ? 'danhsach_khachhang.xlsx' : 'danhsach_nhanvien.xlsx' ;
        PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007')->save($filename_save);

        header('Content-Disposition: attachment; filename= "'.$filename_open.'"');
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($filename_save));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        readfile($filename_save);
    }
?>