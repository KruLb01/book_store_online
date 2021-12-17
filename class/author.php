<?php
class author {
    public function getAuthor($ma_tac_gia)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB ->select("select * from tac_gia where id_tac_gia = '$ma_tac_gia'");
        if($result) {
            $row = mysqli_fetch_array($result);
            return $row;
        }
        else {
            return array();
        }
    }    
}
