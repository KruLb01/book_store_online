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
                if(isset($_POST['id_sale']))
                {
                    $id_sale = $_POST['id_sale'];
                    if($id_sale === "")
                    {
                        echo json_encode(array("valid" => true, "message" => "", "discount_percent" => 0, "discount_value" => 0));
                        return;
                    }
                    $sale = $saleModel -> getSale($id_sale);
                    if($sale )
                    {
                        echo json_encode(array("valid" => true, "message" => $sale['ten_sale'], "discount_percent" => $sale['giam_theo_%'],"discount_value" => $sale['giam_theo_vnd']));
                    }
                    else
                    {
                        echo json_encode(array("valid" => false, "message" => "Không tìm thấy mã sale"));
                    }
                }
                else {
                    echo json_encode(array("valid" => false, "message" => "Không tìm thấy truy vấn id_sale"));
                }
            }
            break;
        }
    }

