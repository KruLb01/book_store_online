<?php
    session_start();
    if(!isset($_SESSION['customer']) || $_SESSION['customer']===array())
    {
        header("Location: ../customer/login.php");
    }
    function getStateName($index)
    {
        $state = array("Chờ xử lý","Đang giao","Đã giao","Đã huỷ");
        return $state[$index];
    }
    include_once '../../class/invoice.php';
    include_once '../../class/sale.php';
    $invoiceModel = new invoice();
    $saleModel = new sale();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/main.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="icon" type="image/png" sizes="16x16" href="../../admin/static/plugins/images/favicon.png">
        <script src='../../assets/js/post_method.js'></script>
        <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
        <title>Chi tiết đơn hàng</title>
        <style>
            .order-detail-item .prod-image {
                width:200px;
                height:170px;
            }
            .prod-image img {
                width:100%;
                height: 100%;
            }
            .order-detail{
                width: 90%;
                margin:auto;
                box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
                padding:2%;
                margin-bottom: 50px;
            }
            .order-detail-item {
                display:flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }
            .order-detail-item:last-child {
                margin-bottom: 10px;
            }
            .order-detail-item:first-child {
                margin-top: 10px;
            }
            .header-order-detail {
                display:flex;
                justify-content: space-between;
            }
            .header-order-detail div:not(:first-child) {
                width:100px;
                text-align: center;
            }
            .header-order-detail div:first-child {
                width:50%;
                padding-left:5%;
            }
            .product {
                width: 50%;
                display:flex;
            }
            .price {
                width:100px;
                text-align: center;
            }
            .subtotal {
                width:100px;
                text-align: center;
            }
            .header-order-detail {
                border-bottom: 1px solid gray;
            }
            .order-detail-items {
                border-bottom: 1px solid gray;
            }
            .order-detail .title {
                margin-bottom: 15px
            }
            .order-info {
                margin-bottom: 20px;
            }
            .order-footer {
                display:flex;
                justify-content: flex-end;
            }
            .order-footer > div:last-child {
                text-align: center;
                margin-left:10px;
            }
            .order-footer div div:nth-child(2)
            {
                height: 60px;
            }
        </style>
    </head>
    <body class="is-preload">
        <div id="wrapper">
            <?php include_once 'header.php' ?>
            <div>
                <div class="order-detail">
                    <h3 class="title">Thông tin đơn hàng</h3>
                    <?php
                        if(isset($_GET['id_hoa_don']) && $_GET['id_hoa_don'])
                        {
                            $orderid = $_GET['id_hoa_don'];
                            $id_nguoi_dung = $_SESSION['customer']['User'];
                            $order = $invoiceModel -> getOrder($orderid, $id_nguoi_dung);
                            $id_hoa_don = $order['id_hoa_don'];
                            $ngaymua = $order['ngay_mua'];
                            $trangthai = $order['tinh_trang_don_hang'];
                            $id_sale = $order['id_sale'];
                            echo '<div class="order-info">'
                               .      '<div><strong>Mã hoá đơn: </strong>'.$id_hoa_don.'</div>'
                               .      '<div><strong>Ngày mua: </strong>'.date("d-m-Y",strtotime($ngaymua)).'</div>'
                               .      '<div><strong>Tình trạng đơn hàng: </strong>'. getStateName($trangthai).'</div>'
                               . '</div>';
                    ?>
                    <div class="header-order-detail">
                        <div><strong>Sản phẩm</strong></div>
                        <div><strong>Đơn giá</strong></div>
                        <div><strong>Thành tiền</strong></div>
                    </div>
                    <?php 
                            $total = 0;
                            $detailsOrder = $invoiceModel ->getDetailOrder($orderid, $id_nguoi_dung);
                            echo '<div class="order-detail-items">';
                            foreach($detailsOrder as $detailOrder)
                            {
                                echo '<div class="order-detail-item">'
                                        ."<div class='product'>"
                                           .'<div class="prod-image"><img src="../../images/'.$detailOrder[1].'" /></div>'
                                           .'<div class="prod-info">'
                                              .'<span>'.$detailOrder[0].'</span>'
                                              .'<p>'.$detailOrder[2].'</p>'
                                              .'<span>x'.$detailOrder[4].'</span>'
                                           .'</div>'
                                        .'</div>'
                                        .'<div class="price">'
                                            .number_format($detailOrder[3],0, '', '.').'<sup>đ</sup>'
                                        .'</div>'
                                        .'<div class="subtotal">'
                                           .'<p>'.number_format($detailOrder[3]*$detailOrder[4],0, '', '.').'<sup>đ</sup></p>'
                                        .'</div>'
                                       .'</div>';
                                $total += $detailOrder[3]*$detailOrder[4];
                            }
                            $discountVal = 0;
                            $saleName = "<i>(Không áp dụng mã giảm giá)</i>";
                            if($id_sale != "")
                            {
                                $saleDetail = $saleModel ->getSale($id_sale);
                                $saleName = "<i>(Đã áp dụng ".$saleDetail['ten_sale'].")</i>";
                                $discountVal = intval($saleDetail['giam_theo_vnd']);
                                $total = $total - $discountVal;
                            }
                            echo '</div>'
                            . '<div class="order-footer">'
                                .'<div>'
                                    .'<div>Tổng tiền: </div>'
                                    .'<div>Áp dụng mã giảm giá: </div>'
                                    .'<div><strong>Tiền sau khi áp dụng mã giảm giá: </strong></div>'
                                .'</div>'
                                .'<div>'
                                    .'<div>'.number_format($detailOrder[3]*$detailOrder[4],0, '', '.').'<sup>đ</sup></div>'
                                    .'<div>'.number_format($discountVal,0, '', '.').'<sup>đ</sup><br/>'.$saleName.'</div>'
                                    .'<div><strong>'.number_format($total,0, '', '.').'<sup>đ</sup></div>'
                                .'</div>'
                            . '</div>';
                        }
                        else {

                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>