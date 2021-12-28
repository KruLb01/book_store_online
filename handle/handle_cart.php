<?php
    include_once '../class/book.php';
    include_once '../class/book_image.php';
    include_once '../class/connect_db.php';
    $connect_db = new connect_db();
    $bookQuery = new book();
    session_start();
    if(isset($_POST['action']))
    {
        $action = $_POST['action'];
        switch($action)
        {
            case "add":
            {
                if(isset($_POST['id_san_pham']) && isset($_POST['soluong']) && isset($_POST['loai_sach']))
                {

                    $idsp = $_POST['id_san_pham'];
                    $book = $bookQuery -> findBook($idsp);
                    if($book != array())
                    {
                        $soluong = $_POST['soluong'];
                        $booktype = $_POST['loai_sach'];
                        $userid = $_SESSION['customer']['User'];
                        $qtyinCart = isset($_SESSION['cart'][$idsp][$booktype]["soluong"])?$_SESSION['cart'][$idsp][$booktype]["soluong"]:0;
                        if($booktype === "EBook")
                        {
                            $result = $connect_db ->select("SELECT * from hoa_don, chi_tiet_hoa_don where hoa_don.id_hoa_don = chi_tiet_hoa_don.id_hoa_don "
                                    . "                             and hoa_don.id_nguoi_dung = '$userid' "
                                    . "                             and chi_tiet_hoa_don.id_san_pham = '$idsp' "
                                    . "                             and chi_tiet_hoa_don.loai = 'EBook'");
                            if(mysqli_num_rows($result) === 1)
                            {
                                echo json_encode(array("success" => false, "message" => "Bạn đã mua sách Ebook trước đó!!","error_code" => "ebook_had_bought"));
                            }
                            else if($soluong + $qtyinCart > 1){
                                echo json_encode(array("success" => false, "message" => "Chỉ có thể mua được 1 sách Ebook","error_code" => "ebook_max_out"));
                            }
                            else {
                                addtoCart($book,$booktype,$soluong);
                                echo json_encode(array("success" => true));
                            }
                        }
                        else{
                            if($soluong + $qtyinCart > $book['so_luong']){
                                echo json_encode(array("success" => false, "message" => "Số lượng sách mua vượt quá số lượng sách hiện có","error_code" => "out_of_stock"));
                            }
                            addtoCart($book,$booktype,$soluong);
                            echo json_encode(array("success" => true));
                        }
                    }
                    else{
                        echo json_encode(array("success" => false, "message" => "Không tìm thấy sản phẩm","error_code" => "product_not_found"));
                    }
                }else{
                    echo json_encode(array("success" => false, "message" => "Không tìm thấy truy vấn","error_code" => "no_query_found"));
                }
            }
            break;
            case "delete":{
                $delProds = isset($_POST['delProds'])?$_POST['delProds']:array();
                if($delProds != array()) {
                    if(isset($_SESSION['cart']) && $_SESSION['cart'])
                    {
                        $stt = 0;
                        foreach($_SESSION['cart'] as $prodID => $value)
                        {
                            foreach($value as $booktype => $value1)
                            {
                                if(in_array($stt, $delProds))
                                {
                                    unset($_SESSION['cart'][$prodID][$booktype]);
                                }
                                $stt++;
                            }
                        }
                        echo json_encode(array("success" => true, "message" => "Xoá sản phẩm thành công"));
                    }else{
                        echo json_encode(array("success" => false, "message" => "Giỏ hàng của bạn đang trống"));
                    }
                }
                else {
                    echo json_encode(array("success" => false, "message" => "Vui lòng chọn sản phẩm muốn xoá"));
                }
            }
            break;
        }
    }
    function addtoCart($book,$booktype,$qty)
    {
        $bookImageQuery = new book_image();
        $bookImage = $bookImageQuery -> getFirstImageBook($book['id_san_pham']);
        $idsp = $book['id_san_pham'];
        if(isset($_SESSION['cart'][$idsp][$booktype])){
            $_SESSION['cart'][$idsp][$booktype]['tensach'] = $book['ten_san_pham'];
            $_SESSION['cart'][$idsp][$booktype]['hinhanh'] = $bookImage[2];
            $_SESSION['cart'][$idsp][$booktype]['giatien'] = ($booktype==="Ebook")?$book['gia_sach_ebook']:$book['gia_sach_giay'];
            $_SESSION['cart'][$idsp][$booktype]['soluong'] += $qty;
        }
        else{
            $_SESSION['cart'][$idsp][$booktype]['tensach'] = $book['ten_san_pham'];
            $_SESSION['cart'][$idsp][$booktype]['hinhanh'] = $bookImage[2];
            $_SESSION['cart'][$idsp][$booktype]['giatien'] = ($booktype==="Ebook")?$book['gia_sach_ebook']:$book['gia_sach_giay'];
            $_SESSION['cart'][$idsp][$booktype]['soluong'] = $qty;
        }
    }
