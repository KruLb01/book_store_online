<?php


class sale
{
    public function getSales()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from sale order by id_sale";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $sales = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $sales[] = array(
                    "Id" => $row["id_sale"],
                    "Name" => $row["ten_sale"],
                    "Start" => join("/", array_reverse(explode("-", $row["ngay_bat_dau"]))),
                    "End" => join("/", array_reverse(explode("-", $row["ngay_ket_thuc"]))),
                    "Percent" => $row["giam_theo_%"],
                    "Dong" => $row["giam_theo_vnd"],
                );
            }
        }
        return $sales;
    }

    public function deleteSale($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from sale where id_sale = '$code'";
        return $conn->execute($query);
    }

    public function createSale($sale)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into sale(id_sale, ten_sale, ngay_bat_dau, ngay_ket_thuc, `giam_theo_%`, giam_theo_vnd) 
                values('{$sale['Code']}', '{$sale['Name']}', '{$sale['Start']}', '{$sale['End']}', '{$sale['Percent']}', '{$sale['Dong']}')";
        return $conn->execute($query);
    }
}