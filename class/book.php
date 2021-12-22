<?php
class book {
    public function getRangeListBook($start, $end)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        return $connectDB -> select("select * from san_pham limit $start,$end");
    }
    public function getLimitRangeListBook($start, $limit)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB -> select("select * from san_pham limit $limit offset $start");
        $listBook = array();
        if($result)
        {
            while($row = mysqli_fetch_array($result))
            {
                array_push($listBook,$row);
            }
        }
        return $listBook;
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
    public function findBooks($key)
    {
        include_once 'connect_db.php';
        $connectDB = new connect_db();
        $result = $connectDB -> select("select * from san_pham where id_san_pham = '$key' or ten_san_pham like '%$key%'");
        $lsBook = array();
        if($result)
        {
            while($row = mysqli_fetch_array($result)){
                array_push($lsBook,$row);
            }
        }
        return $lsBook;
    }
    public function findByCategories($cateids)
    {
        if(!$cateids)
        {
            return array();
        }
        include_once 'connect_db.php';
        $connectdb = new connect_db();
        $required = "("; 
        $i = 0;
        foreach($cateids as $key)
        {
            $i++;
            $required .= "'$key'";
            if($i < count($cateids)){
                $required .= ", ";
            }
        }
        $required .= ")";
        $sql = "select * from san_pham where san_pham.id_danh_muc in $required";
        $result = $connectdb ->select($sql);
        $listBook = array();
        if($result)
        {
            while ($row = mysqli_fetch_array($result))
            {
                array_push($listBook,$row);
            }
        }
        return $listBook;
    }
    public function findByCategoriesFrom($cateids,$start,$limit)
    {
        if(!$cateids)
        {
            return array();
        }
        include_once 'connect_db.php';
        $connectdb = new connect_db();
        $required = "("; 
        $i = 0;
        foreach($cateids as $key)
        {
            $i++;
            $required .= "'$key'";
            if($i < count($cateids)){
                $required .= ", ";
            }
        }
        $required .= ")";
        $sql = "select * from san_pham where san_pham.id_danh_muc in $required limit $limit offset $start";
        $result = $connectdb ->select($sql);
        $listBook = array();
        if($result)
        {
            while ($row = mysqli_fetch_array($result))
            {
                array_push($listBook,$row);
            }
        }
        return $listBook;
    }
    public function getAllBooks()
    {
        include_once 'connect_db.php';
        $connectdb = new connect_db();
        $result = $connectdb ->select("Select * from san_pham");
        $listBook = array();
        if($result)
        {
            while($row = mysqli_fetch_array($result))
            {
                array_push($listBook,$row);
            }
        }
        return $listBook;
    }
}
