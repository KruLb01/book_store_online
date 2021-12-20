<?php
    include_once '../class/sale.php';
    $saleModel = new sale();
    if(isset($_POST['action']))
    {
        $action = $_POST['action'];
        switch($action)
        {
            case "find":
            {
                if(isset($_POST['id_sale']) && $_POST['id_sale'])
                {
                    $id_sale = $_POST['id_sale'];
                    $sale = $saleModel -> getSale($id_sale);
                    if($sale)
                    {
                        echo json_encode(array("valid" => true, "message" => $sale['ten_sale']));
                    }
                    else
                    {
                        echo json_encode(array("valid" => false, "message" => "Không tìm thấy mã sale"));
                    }
                }
                else if (!isset($_POST['id_sale'])){
                    echo json_encode(array("valid" => false, "message" => "Không tìm thấy truy vấn id_sale"));
                }
                else {
                    echo json_encode(array("valid" => true, "message" => ""));
                }
            }
            break;
        }
    }

