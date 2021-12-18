<?php
class shipment_method {
    public function getAllShipmentMethod()
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
}
