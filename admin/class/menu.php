<?php


class menu
{
    public function getMenu($role)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select chuc_nang.* from chi_tiet_quyen_chuc_nang as phan_quyen, chuc_nang where id_quyen = '$role' and phan_quyen.id_chuc_nang = chuc_nang.id_chuc_nang order by phan_quyen.id_chuc_nang";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $menu = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $menu[] = array(
                    "Id" => $row["id_chuc_nang"],
                    "Name" => $row["ten_chuc_nang"],
                    "Description" => $row["mo_ta"],
                    "Icon" => $row["icon"],
                    "File" => $row["file"]
                );
            }
        }
        return $menu;
    }
}