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

        $query = "select chuc_nang.file as file from nguoi_dung as nd, quyen, chi_tiet_quyen_chuc_nang as phan_quyen, chuc_nang 
                where nd.id_quyen = quyen.id_quyen 
                and quyen.id_quyen = phan_quyen.id_quyen 
                and phan_quyen.id_chuc_nang = chuc_nang.id_chuc_nang 
                and nd.tai_khoan = '{$username}'";
        $data = $conn->select($query);
        $funcs = array();
        if (mysqli_num_rows($data)==0) {
            $funcs = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                array_push($funcs, $row["file"]);
            }
        };
        $user = $user + array("Function" => $funcs);
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

    public function updatePassword($user, $password) {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "update nguoi_dung set mat_khau = '$password' where tai_khoan = '$user'";
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

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $time = date("Y-m-d H:i:s");
        $query = "insert into nguoi_dung(tai_khoan, mat_khau, email, ho_ten, dia_chi, so_dien_thoai, tinh_trang_tai_khoan, id_quyen, ngay_tao) 
                values('{$user['User']}', '{$user['Password']}', '{$user['Email']}', '{$user['Name']}', '{$user['Address']}', '{$user['Phone']}', '{$user['Status']}', '{$user['Permission']}', '$time')";
        return $conn->execute($query);
    }

    public function updateAccount($user)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "update nguoi_dung set ho_ten = N'{$user['Name']}', email = '{$user['Email']}'
                    , dia_chi = N'{$user['Address']}', so_dien_thoai = '{$user['Phone']}' 
                    where tai_khoan = '{$user['User']}'";
        return $conn->execute($query);
    }

    public function updateRole($user, $role)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "update nguoi_dung set id_quyen = $role where tai_khoan = '$user'";
        return $conn->execute($query);
    }

    public function getNewCustomer()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from nguoi_dung where id_quyen = 1 order by ngay_tao desc limit 0, 5";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $customer = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $customer[] = array(
                    "User" => $row["tai_khoan"],
                    "Email" => $row["email"],
                    "Name" => $row["ho_ten"],
                    "Phone" => $row["so_dien_thoai"],
                );
            }
        }
        return $customer;
    }

    public function getMostValueCustomer()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select nguoi_dung.email as Email, nguoi_dung.ho_ten as Name, nguoi_dung.so_dien_thoai as Phone, sum(hoa_don.tong_gia) as total, count(hoa_don.id_hoa_don) as totalInvoice  
                from nguoi_dung, hoa_don 
                where nguoi_dung.tai_khoan = hoa_don.id_nguoi_dung 
                and hoa_don.tinh_trang_don_hang = 2 
                group by hoa_don.id_nguoi_dung 
                order by total desc";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $customer = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $customer[] = array(
                    "Email" => $row["Email"],
                    "Name" => $row["Name"],
                    "Phone" => $row["Phone"],
                    "Total" => number_format($row["total"]),
                    "Amount Invoice" => number_format($row["totalInvoice"]),
                );
            }
        }
        return $customer;
    }
}