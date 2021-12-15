<?php


class import
{
    public function importBook($notes)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        // Create code for note
        $code = uniqid("PN-", true);

        $query = "insert into phieu_nhap(id_phieu_nhap, id_nhan_vien_nhap, id_nha_xuat_ban, ngay_nhap, tong_gia_nhap)
                values('$code', '{$notes['User']}', '{$notes['Ncc']}', '{$notes['Date']}', '{$notes['Total']}');";
        foreach ($notes["data"] as $key=>$val) {
            $query .= "insert into chi_tiet_phieu_nhap(id_phieu_nhap, id_sach, so_luong, don_gia) 
                    values('$code', '{$val['Code']}', '{$val['Amount']}', '{$val['Price']}');";
            $query .= "update san_pham set so_luong = so_luong + ${val['Amount']} where id_san_pham = '{$val['Code']}';";
        }
        return $conn->multiExecute($query);
    }

    public function getNotes()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select pn.id_phieu_nhap as Code, nd.ho_ten as Name, quyen.ten_quyen as Role, nxb.ten_nha_xuat_ban as NCC, pn.ngay_nhap as Date, pn.tong_gia_nhap as Total  
                from phieu_nhap as pn, nguoi_dung as nd, nha_xuat_ban as nxb, quyen 
                where pn.id_nhan_vien_nhap = nd.tai_khoan 
                and pn.id_nha_xuat_ban = nxb.id_nha_xuat_ban 
                and nd.id_quyen = quyen.id_quyen 
                order by pn.ngay_nhap";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $notes = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $notes[] = array(
                    "Id" => $row["Code"],
                    "Name" => $row["Name"],
                    "Role" => $row["Role"],
                    "Ncc" => $row["NCC"],
                    "Date" => join("/", array_reverse(explode("-", $row["Date"]))),
                    "Total" => number_format($row["Total"]),
                );
            }
        }
        return $notes;
    }

    public function deleteNote($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from phieu_nhap where id_phieu_nhap = '$code'; delete from chi_tiet_phieu_nhap where id_phieu_nhap = '$code'";
        return $conn->multiExecute($query);
    }

    public function getDetails($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select ct.id_sach as code, sp.ten_san_pham as name, ct.so_luong as amount, ct.don_gia as price 
                from phieu_nhap, chi_tiet_phieu_nhap as ct, san_pham as sp 
                where phieu_nhap.id_phieu_nhap = ct.id_phieu_nhap 
                  and ct.id_sach = sp.id_san_pham 
                  and phieu_nhap.id_phieu_nhap =  '$code' 
                  order by sp.id_san_pham";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $details = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $details[] = array(
                    "Code" => $row["code"],
                    "Name" => $row["name"],
                    "Amount" => number_format($row["amount"]),
                    "Price" => number_format($row["price"]),
                    "Total" => number_format($row["amount"]*$row["price"]),
                );
            }
        }
        return $details;
    }
}