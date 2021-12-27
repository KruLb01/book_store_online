<?php 
    session_start();
    if(!isset($_SESSION['customer']) || $_SESSION['customer']===array())
    {
        header("Location: ../customer/login.php");
    }
    
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/main.css" />
        <noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
        <link rel="icon" type="image/png" sizes="16x16" href="../../admin/static/plugins/images/favicon.png">
        <title>Đơn hàng</title>
        <style>
            #wrapper{
                padding:0 20px 0 20px;
            }
            #wrapper .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            ul li {
                padding-left: 0px;
            }
            ul {
                margin-left: 0px;
                margin-right: 20px;
            }
            /* Style the tab */
            .tab {
                overflow: hidden;
                list-style: none;
                border-bottom: 1px solid #ccc;
            }
            /* Style the buttons that are used to open the tab content */
            .tab .tablinks {
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                transition: 0.3s;
                text-align: center;
                width: 160px;
            }

            /* Change background color of buttons on hover */
            .tab .tablinks:hover {
                background-color: black;
                color: white;
                font-weight:  bold;
            }

            /* Create an active/current tablink class */
            .tab .tablinks.active {
                background-color: black;
                color: white;
                font-weight:  bold;
            }

            /* Style the tab content */
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;
            }
            button {
                all: initial;
                * {
                    all: unset;
                }
            }
            .btn-warning:hover {
                color:black !important;
            }
            .btn-danger {
                color: white !important;
            }
            .btns button{
                margin-left: 10px;
                margin-right: 10px;
            }
        </style>
    </head>
    <body class="is-preload">
        <div id="wrapper">
            <?php include 'header.php' ?>
            <div class="header">
                <h3>Đơn hàng của bạn</h3>
                <ul class="tab">
                    <!-- Create tabs: https://www.w3schools.com/howto/howto_js_tabs.asp -->
                    <li class="tablinks active">Đơn hàng chờ xử lý</li>
                    <li class="tablinks">Đơn hàng đang giao</li>
                    <li class="tablinks">Đơn hàng đã giao</li>
                    <li class="tablinks">Đơn hàng đã huỷ</li>
                </ul>
            </div>
            <div class="tabcontent">
                
            </div>
        </div>
            <!--Scripts-->
            <script src="../../assets/js/jquery.min.js"></script>
            <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../../assets/js/jquery.scrolly.min.js"></script>
            <script src="../../assets/js/jquery.scrollex.min.js"></script>
            <script src="../../assets/js/main.js"></script>
            <script>
                $(document).ready(function(){
                    $(".tablinks").each(function(index){
                        $(this).on("click",function(){
                            $(".tablinks").removeClass("active");
                            $(this).addClass("active");
                            getOrders(index);
                        });
                    });
                });
                getOrders(0);
                function getOrders(state) {
                    $(document).ready(function(){
                        $.ajax({
                            url: "../../handle/handle_order.php",
                            type: "POST",
                            data:{
                                    action: "vieworders",
                                    state: state
                                 },
                            success: function(reps){
                                $(".tabcontent").html(reps);
                                $(".tabcontent").css("display","block");
                            }
                        });
                    });
                }
                function getDetailOrder(orderid){
                    window.location.href = 'detail.php?id_hoa_don='+orderid;
                }
                function cancelOrder(orderid)
                {
                    if(!confirm("Bạn có chắc muốn huỷ đơn hàng ("+orderid+") này ?"))
                    {
                        return;
                    }
                    $(document).ready(function(){
                        $.ajax({
                            url: "../../handle/handle_order.php",
                            type: "POST",
                            data:{
                                    action: "cancelorder",
                                    id_hoa_don: orderid
                                 },
                            success: function(reps){
                                var getJSON = JSON.parse(reps);
                                if(getJSON.success)
                                {
                                    alert("Huỷ đơn hàng thành công");
                                    window.location.reload();
                                    return;
                                }
                                alert("Huỷ đơn hàng không thành công");
                            }
                        });
                    });
                }
            </script>
    </body>
</html>
