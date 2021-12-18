<?php


class invoice
{
    public function getInvoices()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select hd.id_hoa_don as id, nd.ho_ten as customer, hd.ngay_mua as date, ht.ten_hinh_thuc as shipping, hd.tong_gia as total, hd.tinh_trang_don_hang as status 
                from hoa_don as hd, nguoi_dung as nd, hinh_thuc_giao_hang as ht 
                where hd.id_nguoi_dung = nd.tai_khoan and hd.hinh_thuc_giao_hang = ht.id_hinh_thuc 
                order by hd.id_hoa_don";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $invoices = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $invoices[] = array(
                    "Id" => $row["id"],
                    "Customer" => $row["customer"],
                    "Date" => join("/", array_reverse(explode("-", $row["date"]))),
                    "Shipping" => $row["shipping"],
                    "Total" => $row["total"],
                    "Status" => $row["status"],
                );
            }
        }
        return $invoices;
    }

    public function deleteInvoice($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "delete from hoa_don where id_hoa_don = '$code'; delete from chi_tiet_hoa_don where id_hoa_don = '$code'";
        return $conn->multiExecute($query);
    }

    public function cancelInvoice($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();
        $invoice = new invoice();
        $details = $invoice->getDetails($code);

        $query = "update hoa_don set tinh_trang_don_hang = 3 where id_hoa_don = '$code';";

        foreach ($details as $key=>$val) {
            $query .= "update san_pham set so_luong = so_luong + '{$val['Amount']}' where id_san_pham = N'{$val['Id Product']}';";
        }
        return $conn->multiExecute($query);
    }

    public function updateStatusInvoice($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "update hoa_don set tinh_trang_don_hang = (select tinh_trang_don_hang + 1 from hoa_don where id_hoa_don = '$code') where id_hoa_don = '$code'";
        return $conn->execute($query);
    }

    public function getDetails($code)
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select ct.id_san_pham as code, sp.id_san_pham as product, sp.ten_san_pham as name, ct.loai as type, ct.so_luong as amount, ct.don_gia as price 
                from hoa_don, chi_tiet_hoa_don as ct, san_pham as sp 
                where hoa_don.id_hoa_don = ct.id_hoa_don 
                  and ct.id_san_pham = sp.id_san_pham 
                  and hoa_don.id_hoa_don =  '$code' 
                  order by sp.id_san_pham";
        $data = $conn->select($query);
        if (mysqli_num_rows($data)==0) {
            $details = array();
        } else {
            while ($row = mysqli_fetch_array($data)) {
                $details[] = array(
                    "Code" => $row["code"],
                    "Id Product" => $row["product"],
                    "Name" => $row["name"],
                    "Type" => $row["type"],
                    "Amount" => number_format($row["amount"]),
                    "Price" => number_format($row["price"]),
                    "Total" => number_format($row["amount"]*$row["price"]),
                );
            }
        }
        return $details;
    }
}