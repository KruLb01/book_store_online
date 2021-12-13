<?php


class nxb
{
    public function getNXB()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from nha_xuat_ban order by id_nha_xuat_ban";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $nxb = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $nxb[] = array(
                    "Id" => $row["id_nha_xuat_ban"],
                    "Name" => $row["ten_nha_xuat_ban"],
                    "Description" => $row["mo_ta_nha_xuat_ban"]
                );
            }
        }
        return $nxb;
    }

    public function deleteNXB($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from nha_xuat_ban where id_nha_xuat_ban = '$code'";
        return $conn->execute($query);
    }

    public function createNXB($nxb)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into nha_xuat_ban(id_nha_xuat_ban, ten_nha_xuat_ban, mo_ta_nha_xuat_ban) 
                values('{$nxb['Code']}', '{$nxb['Name']}', '{$nxb['Description']}')";
        return $conn->execute($query);
    }
}