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

    public function createAuthor($author)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into tac_gia(id_tac_gia, ten_tac_gia, mo_ta_tac_gia) 
                values('{$author['Code']}', '{$author['Name']}', '{$author['Description']}')";
        return $conn->execute($query);
    }
}