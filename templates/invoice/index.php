<?php 
    session_start();
    if(!isset($_SESSION['customerlogin']) || $_SESSION['customerlogin']===array())
    {
        header("Location: ../customer/login.php");
    }
    include '../connection.php';
    include '../class/order.php';
    $ordermd = new order();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.css"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>History</title>
        <style>
            .wrap{
                padding:10px;
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <h3>History</h3>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detail</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $result = $ordermd->getAllOrder($_SESSION['customerlogin']['id']);
                    if($result)
                    {
                        while($row = mysqli_fetch_array($result)){
                            $href = "'detail.php?orderid=$row[0]'";
                            echo '<tr>
                                <td>'.$row[0].'</td>
                                <td>'.$row[1].'</td>
                                <td>'.$row[2].'</td>
                                <td><button class="btn btn-info" onclick="location.href='.$href.'">Detail</button></td>
                            </tr>';
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
