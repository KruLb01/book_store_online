<?php
    class publisher {
        public function getPublisher($ma_nxb)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB ->select("select * from nha_xuat_ban where id_nha_xuat_ban = '$ma_nxb'");
        if($result) {
            $row = mysqli_fetch_array($result);
            return $row;
        }
        else {
            return null;
        }
    }    
    }

