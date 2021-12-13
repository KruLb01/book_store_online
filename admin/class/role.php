<?php


class role
{
    public function getRoles()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from quyen where id_quyen > 2 order by id_quyen";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $roles = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $roles[] = array(
                    "Role" => $row["id_quyen"],
                    "Name" => $row["ten_quyen"],
                    "Description" => $row["mo_ta"]
                );
            }
        }
        return $roles;
    }
}