<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/sale.php");
        $saleModel = new sale();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $saleModel->deleteSale($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/sale.php");
        $saleModel = new sale();

        // Nhan input
        $newSale = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"],
            "Start" => $_POST["start"],
            "End" => $_POST["end"],
            "Percent" => $_POST["percent"],
            "Dong" => $_POST["dong"],
        );

        $res = $saleModel->createSale($newSale);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

if (isset($_GET["export"])) {
    $type_export = $_GET["export"];

    include_once("../plugin/PHPExcel/Classes/PHPExcel.php");
    $phpExcel = new PHPExcel();

    include_once("../class/sale.php");
    $saleModel = new sale();

    $data = $saleModel->getSales();

    $phpExcel->setActiveSheetIndex(0);
    $phpExcel->getActiveSheet()->setTitle("Danh sách CTKM");
    $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
    $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    $phpExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);

    $phpExcel->getActiveSheet()->setCellValue('A1', 'Mã chương trình');
    $phpExcel->getActiveSheet()->setCellValue('B1', 'Tên chương trình');
    $phpExcel->getActiveSheet()->setCellValue('C1', 'Ngày bắt đầu');
    $phpExcel->getActiveSheet()->setCellValue('D1', 'Ngày kết thúc');
    $phpExcel->getActiveSheet()->setCellValue('E1', 'Giảm theo phần trăm');
    $phpExcel->getActiveSheet()->setCellValue('F1', 'Giảm theo VNĐ');

    $rowStart = 2;
    foreach ($data as $key=>$val) {
        $phpExcel->getActiveSheet()->setCellValue('A' . $rowStart, $val["Id"]);
        $phpExcel->getActiveSheet()->setCellValue('B' . $rowStart, $val["Name"]);
        $phpExcel->getActiveSheet()->setCellValue('C' . $rowStart, $val["Start"]);
        $phpExcel->getActiveSheet()->setCellValue('D' . $rowStart, $val["End"]);
        $phpExcel->getActiveSheet()->setCellValue('E' . $rowStart, number_format($val["Percent"]) . "%");
        $phpExcel->getActiveSheet()->setCellValue('F' . $rowStart, number_format($val["Dong"]) . " đồng");
        $rowStart++;
    }

    $filename = "../data/list_sale.xlsx";
    PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007')->save($filename);

    header('Content-Disposition: attachment; filename= "danhsach_khuyenmai.xlsx');
    header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
}

?>
