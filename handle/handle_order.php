<?php
    session_start();
    include_once '../class/invoice.php';
    $orderModel = new invoice();
    if(isset($_POST['action']) && $_POST['action'])
    {
        $id_nguoi_dung = $_SESSION['customer']['User'];
        $action = $_POST['action'];
        switch($action){
            case "vieworders":
            {   
                $orderState = $_POST['state'];
                $listOrder = $orderModel ->getListOrder($id_nguoi_dung, $orderState); 
                if($orderState == 0)
                {
                    echo '<table>'
                           . '<thead>'
                           .   '<tr>'
                           .     '<th>Mã đơn hàng</th>'
                           .     '<th>Ngày mua</th>'
                           .     '<th>Tổng tiền</th>'
                           .     '<th>Trạng thái</th>'
                           .     '<th></th>'
                           .   '</tr>'
                           . '</thead>'
                           . '<tbody>';
                    foreach($listOrder as $order)
                    {
                        echo   '<tr>'
                           .     '<td>'.$order['id_hoa_don'].'</td>'
                           .     '<td>'.date("d-m-Y",strtotime($order['ngay_mua'])).'</td>'
                           .     '<td>'.number_format($order['tong_gia'],0, '', '.')."<sup>đ</sup>".'</td>'
                           .     '<td>'.getStateName($order['tinh_trang_don_hang']).'</td>'
                           .     '<td>'
                           .        '<div class="btns">'
                           .          '<button class="btn btn-warning" onclick="getDetailOrder('."'".strval($order['id_hoa_don'])."'".');" >Xem chi tiết</button>'
                           .          '<button class="btn btn-danger" onclick="cancelOrder('."'".strval($order['id_hoa_don'])."'".')" class="cancel-order" value="'.$order['id_hoa_don'].'">Huỷ đơn hàng</button>'
                           .        '</div>'
                           .     '</td>'
                           .   '</tr>';
                    }
                    echo '</tbody>'
                       . '</table>';
                }
                else {
                    echo '<table>'
                           . '<thead>'
                           .   '<tr>'
                           .     '<th>Mã đơn hàng</th>'
                           .     '<th>Ngày mua</th>'
                           .     '<th>Tổng tiền</th>'
                           .     '<th>Trạng thái</th>'
                           .     '<th></th>'
                           .   '</tr>'
                           . '</thead>'
                           . '<tbody>';
                    foreach($listOrder as $order)
                    {
                        echo   '<tr>'
                           .     '<td>'.$order['id_hoa_don'].'</td>'
                           .     '<td>'.date("d-m-Y",strtotime($order['ngay_mua'])).'</td>'
                           .     '<td>'.number_format($order['tong_gia'],0, '', '.')."<sup>đ</sup>".'</td>'
                           .     '<td>'.getStateName($order['tinh_trang_don_hang']).'</td>'
                           .     '<td>'
                           .        '<button class="btn btn-warning" onclick="getDetailOrder('."'".strval($order['id_hoa_don'])."'".');" value="'.$order['id_hoa_don'].'">Xem chi tiết</button>'
                           .     '</td>'
                           .   '</tr>';
                    }
                    echo '</tbody>'
                       . '</table>';
                }
            }
            break;
            case "cancelorder":
            {
                $orderid = $_POST['id_hoa_don'];
                $result = $orderModel ->cancelOrder($orderid, $id_nguoi_dung, 3);
                if($result)
                {
                    echo json_encode(array("success" => true));
                }
                else {
                    echo json_encode(array("success" => false));
                }
            }
            break;
        }
    }
    function getStateName($index)
    {
        $state = array("Chờ xử lý","Đang giao","Đã giao","Đã huỷ");
        return $state[$index];
    }

