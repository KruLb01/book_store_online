<?php


class report
{
    public function getTotal_Customers_Invoice_Product()
    {
        include_once("connect_db.php");
        $conn = new connect_db();

        $query = "select count(*) as total from nguoi_dung where id_quyen = 1";
        $totalCustomer = mysqli_fetch_array($conn->select($query))["total"];

        $query = "select sum(so_luong) as total from chi_tiet_hoa_don";
        $totalSold = mysqli_fetch_array($conn->select($query))["total"];

        $query = "select count(*) as total from san_pham";
        $totalProduct = mysqli_fetch_array($conn->select($query))["total"];

        return array(
            "Customer" => $totalCustomer,
            "Sold" => $totalSold,
            "Product" => $totalProduct,
        );
    }
}