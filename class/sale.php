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
                return array("success" => true,"sale" => $result);
            }
            else {
                return array("success" => false,"message" => "id_sale_not_found");
            }
                
        }
        else {
            return array("success" => false,"message" => "somethings happened wrong");
        }
    }
}
