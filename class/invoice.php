<?php
class invoice {
    public function addInvoice ($userid,$ship_method,$id_sale,$details) {
        include_once '../class/connect_db.php';
        $connectdb = new connect_db();
        $curDate = date("Y-m-d");
        $last_id = 0;
        $result = $connectdb -> select("select max(id_hoa_don) from hoa_don");
        if($result){
            $row = mysqli_fetch_array($result);
            $maxID = $row[0]; 
            //Order ID stored in Database with syntax "HD" + idNumber so split it to two to get the id number
            //Example: HD001 -> idNumber = 001
            $idNumber = explode("HD",$maxID)[1];
            $last_id = intval($idNumber);
        }
        $total = 0;
        $queries2 = array();
        $last_id += 1;
        $strID = "HD".sprintf("%03d",$last_id);
        foreach($details as $detail)
        {
            $prodID = $detail['id_san_pham'];
            $bookType = $detail['loai'];
            $quantity = $detail['soluong'];
            $prodPrice = $detail['don_gia'];
            array_push($queries2,"insert into chi_tiet_hoa_don values ('$strID','$prodID',$quantity,'$bookType',$prodPrice);");
            $total += $detail['soluong'] * $detail['don_gia'];
        }
        $query1 = "insert into hoa_don values ('$strID','$userid','$curDate',$total,'$ship_method',0,'$id_sale')";
        $result1 = $connectdb -> executeTwoReferencTables($query1, $queries2);
        return $result1;
    }
    public function getListOrder($id_nguoi_dung, $state)
    {
        include_once 'connect_db.php';
        $connect_db = new connect_db();
        $result = $connect_db ->select("select * from hoa_don where id_nguoi_dung = '$id_nguoi_dung' "
                                                            . "and tinh_trang_don_hang = $state "
                                                            . "order by ngay_mua desc");
        $listOrder = array();
        if($result)
        {
            while($row = mysqli_fetch_array($result))
            {
                array_push($listOrder,$row);
            }
        }
        return $listOrder;
    }
    public function getOrder($orderid,$id_nguoi_dung)
    {
        include_once 'connect_db.php';
        $connect_db = new connect_db();
        $result = $connect_db ->select("select * from hoa_don where id_nguoi_dung = '$id_nguoi_dung' "
                                                             . "and id_hoa_don = '$orderid'");
        if($result)
        {
            $row = mysqli_fetch_array($result);
            return $row;
        }
        else {
            return null;
        }
    }
    public function getDetailOrder($orderid,$id_nguoi_dung)
    {
        include_once 'connect_db.php';
        $connect_db = new connect_db();
        $result = $connect_db ->select("SELECT san_pham.ten_san_pham,hinh_anh_san_pham.link_hinh_anh, "
                                       ."chi_tiet_hoa_don.loai,chi_tiet_hoa_don.don_gia,chi_tiet_hoa_don.so_luong "
                                       ."FROM `chi_tiet_hoa_don`, `san_pham`, `hinh_anh_san_pham`, `hoa_don`"
                                       ."where chi_tiet_hoa_don.id_hoa_don = '$orderid' "
                                       ."and chi_tiet_hoa_don.id_san_pham = san_pham.id_san_pham "
                                       ."and hoa_don.id_nguoi_dung = '$id_nguoi_dung' "
                                       ."and san_pham.id_san_pham = hinh_anh_san_pham.id_san_pham " 
                                       ."group by san_pham.id_san_pham");
        $orderDetails = array();
        if($result)
        {
            while ($row = mysqli_fetch_array($result))
            {
                array_push($orderDetails, $row);
            }
        }
        return $orderDetails;
    }
    public function cancelOrder ($orderid,$id_nguoi_dung,$state)
    {
        include_once 'connect_db.php';
        $connect_db = new connect_db();
        $result = $connect_db -> execute("Update hoa_don "
                                        ."set hoa_don.tinh_trang_don_hang = $state "
                                        ."where hoa_don.id_hoa_don = '$orderid' "
                                        ."and hoa_don.id_nguoi_dung = '$id_nguoi_dung'");
        return $result; //true or false;
    }
}
