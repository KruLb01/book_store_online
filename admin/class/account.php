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
}