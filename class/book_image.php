<?php
class book_image {
    public function getBookImages($id_san_pham) {
        include_once 'connect_db.php';
        $connect_db = new connect_db();
        $result = $connect_db ->select("select * from hinh_anh_san_pham where id_san_pham = '$id_san_pham'");
        $imagesLink = array();
        if($result)
        {
            while($row = mysqli_fetch_array($result))
            {
                array_push($imagesLink,$row);
            }
        }
        return $imagesLink;
    }
    public function getFirstImageBook($id_san_pham) {
        include_once 'connect_db.php';
        $connect_db = new connect_db();
        $result = $connect_db ->select("select * from hinh_anh_san_pham where id_san_pham = '$id_san_pham'"
                . "                     group by id_san_pham");
        if($result){
            $row = mysqli_fetch_array($result);
            return $row;
        }
        return array();
    }
}
