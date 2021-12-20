<?php
    include_once '../class/sale.php';
    include_once '../class/shipment_method.php';
    include_once '../class/invoice.php';
    $saleModel = new sale();
    $invoiceModel = new invoice();
    $shipment_methodModel = new shipment_method();
    session_start();
    if(isset($_POST["action"]))
    {
        $action = $_POST['action'];
        switch($action)
        {
            case "add": {
                if(isset($_POST['ship_method']) && $shipment_methodModel -> isValidShipmentMethod($_POST['ship_method']))
                {
                    $ship_method = $_POST['ship_method'];
                    $saleID = isset($_POST['id_sale'])?$_POST['id_sale']:"";
                    if($saleID === "" || $saleModel -> isValidSale($saleID))
                    {
                        $details = array();
                        $cart = $_SESSION['cart'];
                        foreach($cart as $prodID => $value)
                        {
                            foreach($value as $booktype => $value1)
                            {
                                array_push($details, array("id_san_pham" => $prodID,
                                                           "soluong" => $value1['soluong'],
                                                           "loai" => $booktype,
                                                           "don_gia" => $value1['giatien']
                                                           ));
                            }
                        }
                        if($invoiceModel -> addInvoice($_SESSION['customer']['User'], $ship_method, $saleID, $details))
                        {
                            $_SESSION['cart'] = array();
                            echo json_encode(array("success" => true, "message" => "Thanh toán thành công"));
                        }
                        else {
                            echo json_encode(array("success" => false, "message" => "Không thể thực hiện thao tác thanh toán"));
                        }
                    }
                    else {
                        echo json_encode(array("success" => false, "message" => "Mã sale không hợp lệ"));
                    }
                }
                else {
                    echo json_encode(array("success" => false, "message" => "Không tìm thấy hình thức giao hàng"));
                }
            } 
            break;
        }
    }
