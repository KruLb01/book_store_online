<?php


class category
{
    public function getCategory()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from danh_muc order by id_danh_muc";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $category = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $category[] = array(
                    "Id" => $row["id_danh_muc"],
                    "Name" => $row["ten_danh_muc"],
                );
            }
        }
        return $category;
    }

    public function deleteCategory($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from danh_muc where id_danh_muc = '$code'";
        return $conn->execute($query);
    }

    public function createCategory($category)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into danh_muc(id_danh_muc, ten_danh_muc) 
                values('{$category['Code']}', '{$category['Name']}')";
        return $conn->execute($query);
    }

}