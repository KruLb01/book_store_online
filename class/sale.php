<?php
class sale {
    public function isValidSale($id_sale)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB ->select("select * from sale where id_sale = '$id_sale'");
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
    public function getSale($id_sale)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB ->select("select * from sale where id_sale = '$id_sale'");
        if($result)
        {
            $row = mysqli_fetch_array($result);
            return $row;
        }
        else {
            return array();
        }
    }
}
