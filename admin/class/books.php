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

    public function createBook($book)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "insert into san_pham(id_san_pham, id_danh_muc, ten_san_pham, id_tac_gia, id_nha_xuat_ban, nam_xuat_ban, so_luong, mo_ta_sach, ngon_ngu, gia_sach_giay, gia_sach_ebook) 
                values('{$book['Code']}', '{$book['Category']}', '{$book['Name']}', '{$book['Author']}', '{$book['Nxb']}', '{$book['Released']}', '{$book['Amount']}', '{$book['Description']}', '{$book['Language']}', '{$book['Price']}', '{$book['Ebook']}')";
        return $conn->execute($query);
    }

    public function updateBook($book)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "update san_pham set id_danh_muc = '{$book['Category']}', ten_san_pham = '{$book['Name']}', id_tac_gia = '{$book['Author']}', id_nha_xuat_ban = '{$book['Nxb']}',
                 nam_xuat_ban = '{$book['Year']}', so_luong = '{$book['Amount']}', mo_ta_sach = '{$book['Description']}', ngon_ngu = '{$book['Language']}',
                  gia_sach_giay = '{$book['Price']}', gia_sach_ebook = '{$book['Ebook']}' where id_san_pham = '{$book['Code']}'";
        return $conn->execute($query);
    }

    public function exportDataBook()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select sp.*, dm.ten_danh_muc as Category, tg.ten_tac_gia as Author, nxb.ten_nha_xuat_ban as Nxb 
                from san_pham as sp, danh_muc as dm, tac_gia as tg, nha_xuat_ban as nxb 
                where sp.id_danh_muc = dm.id_danh_muc 
                and sp.id_tac_gia = tg.id_tac_gia 
                and sp.id_nha_xuat_ban = nxb.id_nha_xuat_ban 
                order by sp.id_san_pham";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $books = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $books[] = array(
                    "Id" => $row["id_san_pham"],
                    "Category" => $row["Category"],
                    "Name" => $row["ten_san_pham"],
                    "Author" => $row["Author"],
                    "NXB" => $row["Nxb"],
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
}