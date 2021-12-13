<?php


class author
{
    public function getAuthors()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from tac_gia order by id_tac_gia";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $authors = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $authors[] = array(
                    "Id" => $row["id_tac_gia"],
                    "Name" => $row["ten_tac_gia"],
                    "Description" => $row["mo_ta_tac_gia"]
                );
            }
        }
        return $authors;
    }

    public function deleteAuthor($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from tac_gia where id_tac_gia = '$code'";
        return $conn->execute($query);
    }
}