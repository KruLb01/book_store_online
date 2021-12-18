<?php
    include_once '../class/book.php';
    include_once '../class/book_image.php';
    $bookQuery = new book();
    session_start();
    if(isset($_POST['id_san_pham']) && isset($_POST['id_san_pham']) && isset($_POST['id_san_pham']))
    {
        foreach($_POST as $postValue)
        {
            if($postValue === ""){
                echo json_encode(array("success" => false, "message" => $postValue+" is null","error_code" => "empty_string_found"));
            }
        }
        $idsp = $_POST['id_san_pham'];
        $book = $bookQuery ->findBook($idsp);
        if($book != array())
        {
            $soluong = $_POST['soluong'];
            $booktype = $_POST['loai_sach'];
            $qtyinCart = isset($_SESSION['cart'][$idsp]["qty"])?$_SESSION['cart'][$idsp][$booktype]["qty"]:0;
            if($soluong + $qtyinCart > $book['so_luong']){
                echo json_encode(array("success" => false, "message" => "Số lượng sách mua vượt quá số lượng sách hiện có","error_code" => "out_of_stock"));
            }
            else{
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
