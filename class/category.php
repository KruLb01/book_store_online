<?php
class category {
    public function getCategories() {
        include_once 'connect_db.php';
        $connect_db = new connect_db();
        $result = $connect_db ->select("select * from danh_muc");
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
}
