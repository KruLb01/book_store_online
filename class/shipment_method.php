<?php
class shipment_method {
    public function getAllShipmentMethods()
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB -> select("SELECT * from hinh_thuc_giao_hang");
        if($result)
        {
            $shipMethods = array();
            while($row = mysqli_fetch_array($result)){
                array_push($shipMethods,$row);
            }
            return $shipMethods;
        } else{
            return array();
        }
    }
    public function isValidShipmentMethod($id_sm)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB ->select("select * from hinh_thuc_giao_hang where id_hinh_thuc = '$id_sm'");
        if($result)
        {
            if(mysqli_num_rows($result) === 1)
            {
                return true;
            }
            else {
                return false;
            }              
        }
        else {
            return false;
        }
    }
}
