<?php


class shipping
{
    public function getShipping()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from hinh_thuc_giao_hang order by id_hinh_thuc";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $shipping = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $shipping[] = array(
                    "Id" => $row["id_hinh_thuc"],
                    "Name" => $row["ten_hinh_thuc"],
                    "Description" => $row["mo_ta"]
                );
            }
        }
        return $shipping;
    }

    public function deleteShipping($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from hinh_thuc_giao_hang where id_hinh_thuc = '$code'";
        return $conn->execute($query);
    }

    public function createShipping($shipping)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into hinh_thuc_giao_hang(id_hinh_thuc, ten_hinh_thuc, mo_ta) 
                values('{$shipping['Code']}', '{$shipping['Name']}', '{$shipping['Description']}')";
        return $conn->execute($query);
    }
}