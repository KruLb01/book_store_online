<?php
class book {
    public function getRangeListBook($start, $end)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        return $connectDB -> select("select * from san_pham limit $start,$end");
    }
    public function findSimilarBook($id_san_pham)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB -> select("SELECT * from san_pham "
                . "                     WHERE id_san_pham <> '$id_san_pham' "
                . "                     and id_danh_muc in (select id_danh_muc from san_pham "
                . "                     where id_san_pham = '$id_san_pham');");
        if($result)
        {
            $lsBook = array();
            while($row = mysqli_fetch_array($result)){
                array_push($lsBook,$row);
            }
            return $lsBook;
        } else{
            return array();
        }
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
