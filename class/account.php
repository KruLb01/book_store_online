<?php


class account
{
    public function checkLogin($username, $password)
    {
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
            );
        }
        return $user;
    }

    public function registerAccount($username, $password)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into nguoi_dung(tai_khoan, mat_khau, tinh_trang_tai_khoan, id_quyen) values('$username', '$password', '1', '1')";
        return $conn->execute($query);
    }

    public function updateProfile($user)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "update nguoi_dung set ho_ten = '{$user['Name']}', so_dien_thoai = '{$user['Phone']}', 
                      email = '{$user['Email']}', dia_chi = '{$user['Address']}' where tai_khoan = '{$user['User']}'";
        return $conn->execute($query);
    }

    public function changePassword($user)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "update nguoi_dung set mat_khau = '{$user['Password']}' where tai_khoan = '{$user['User']}'";
        return $conn->execute($query);
    }
}