<?php
class book {
    public function getRangeListBook($start, $end)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        return $connectDB -> select("select * from san_pham limit $start,$end");
    }
    public function findBook($id_san_pham)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB -> select("select * from san_pham where id_san_pham = '$id_san_pham'");
        if($result)
        {
            $row = mysqli_fetch_array($result);
            return $row;
        } else{
            return array();
        }
    }
}
