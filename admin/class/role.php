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

    public function getAllRoles()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from quyen order by id_quyen";
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

    public function getFunctions()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from chuc_nang order by id_chuc_nang";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $roles = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $roles[] = array(
                    "Id" => $row["id_chuc_nang"],
                    "Name" => $row["ten_chuc_nang"],
                    "Description" => $row["mo_ta"],
                    "Icon" => $row["icon"],
                    "File" => $row["file"]
                );
            }
        }
        return $roles;
    }

    public function deleteRole($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from quyen where id_quyen = '$code'; delete from chi_tiet_quyen_chuc_nang where id_quyen = '$code'";
        return $conn->multiExecute($query);
    }

    public function deleteFunction($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from chuc_nang where id_chuc_nang = '$code'; delete from chi_tiet_quyen_chuc_nang where id_chuc_nang = '$code'";
        return $conn->multiExecute($query);
    }

    public function createRole($role)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        // Auto get id role
        $query = "select max(id_quyen) + 1 as id from quyen";
        $code = $conn->select($query);
        if (mysqli_num_rows($code)==0) $code = 3;
        else $code = mysqli_fetch_array($code)['id'];

        $query = "insert into quyen(id_quyen, ten_quyen, mo_ta) 
                values('$code', '{$role['Name']}', '{$role['Description']}')";
        return $conn->execute($query);
    }

    public function createFunction($function)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into chuc_nang(id_chuc_nang, ten_chuc_nang, mo_ta, icon, file) 
                values('{$function['Code']}', '{$function['Name']}', '{$function['Description']}', '{$function['Icon']}', '{$function['File']}')";
        return $conn->execute($query);
    }

    public function roleSetFunc($array)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $code = $array["code"];
        $query = "";
        foreach ($array as $key=>$val) {
            if ($key == "code") continue;
            if ($val == 1) $query .= "insert ignore into chi_tiet_quyen_chuc_nang(id_quyen, id_chuc_nang) values('$code', '$key');";
            else if ($val == 0) $query .= "delete from chi_tiet_quyen_chuc_nang where id_quyen = '$code' and id_chuc_nang = '$key';";
        }
        return $conn->multiExecute($query);
    }
}