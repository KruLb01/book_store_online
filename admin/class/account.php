<?php

class account
{
    public function checkLogin($username, $password) {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from nguoi_dung where tai_khoan = '$username' and mat_khau = '$password'";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $user = array();
        } else {
            $user = mysqli_fetch_array($data);
            $user = array(
                "User" => $user["tai_khoan"],
                "Password" => $user["mat_khau"],
                "Email" => $user["email"],
                "Name" => $user["ho_ten"],
                "Address" => $user["dia_chi"],
                "Phone" => $user["so_dien_thoai"],
                "Status" => $user["tinh_trang_tai_khoan"],
                "Permission" => $user["id_quyen"]
            );
        }
        return $user;
    }

    public function customerAccounts()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from nguoi_dung where id_quyen = 1 order by tai_khoan";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $customer = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $customer[] = array(
                    "User" => $row["tai_khoan"],
                    "Password" => $row["mat_khau"],
                    "Email" => $row["email"],
                    "Name" => $row["ho_ten"],
                    "Address" => $row["dia_chi"],
                    "Phone" => $row["so_dien_thoai"],
                    "Status" => $row["tinh_trang_tai_khoan"],
                    "Permission" => $row["id_quyen"]
                );
            }
        }
        return $customer;
    }

    public function employeeAccounts()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from nguoi_dung, quyen where nguoi_dung.id_quyen = quyen.id_quyen and nguoi_dung.id_quyen != 1 order by tai_khoan";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $employee = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $employee[] = array(
                    "User" => $row["tai_khoan"],
                    "Password" => $row["mat_khau"],
                    "Email" => $row["email"],
                    "Name" => $row["ho_ten"],
                    "Address" => $row["dia_chi"],
                    "Phone" => $row["so_dien_thoai"],
                    "Status" => $row["tinh_trang_tai_khoan"],
                    "Permission" => $row["ten_quyen"]
                );
            }
        }
        return $employee;
    }

    public function changeStatus($user, $currentStatus) {
        include_once("connect_db.php");
        $conn = new connect_db();

        $newStatus = $currentStatus==0 ? 1 : 0;
        $query = "update nguoi_dung set tinh_trang_tai_khoan = $newStatus where tai_khoan = '$user'";
        $res = $conn->execute($query);
        return $res;
    }

    public function deleteAccount($user)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from nguoi_dung where tai_khoan = '$user'";
        return $conn->execute($query);
    }

    public function createAccount($user)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into nguoi_dung(tai_khoan, mat_khau, email, ho_ten, dia_chi, so_dien_thoai, tinh_trang_tai_khoan, id_quyen) 
                values('{$user['User']}', '{$user['Password']}', '{$user['Email']}', '{$user['Name']}', '{$user['Address']}', '{$user['Phone']}', '{$user['Status']}', '{$user['Permission']}')";
        return $conn->execute($query);
    }
}