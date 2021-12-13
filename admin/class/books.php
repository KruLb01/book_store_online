<?php


class books
{
    public function getBooks()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select * from san_pham order by id_san_pham";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $books = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $books[] = array(
                    "Id" => $row["id_san_pham"],
                    "Category" => $row["id_danh_muc"],
                    "Name" => $row["ten_san_pham"],
                    "Author" => $row["id_tac_gia"],
                    "NXB" => $row["id_nha_xuat_ban"],
                    "DayReleased" => $row["nam_xuat_ban"],
                    "Amount" => $row["so_luong"],
                    "Description" => $row["mo_ta_sach"],
                    "Language" => $row["ngon_ngu"],
                    "PriceBook" => $row["gia_sach_giay"],
                    "PriceEbook" => $row["gia_sach_ebook"],
                );
            }
        }
        return $books;
    }

    public function deleteBook($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from san_pham where id_san_pham = '$code'";
        return $conn->execute($query);
    }
}