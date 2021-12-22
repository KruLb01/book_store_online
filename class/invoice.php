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
}
