<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/invoice.php");
        $invoiceModel = new invoice();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $invoiceModel->deleteInvoice($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["get"])) {
        include_once("../class/invoice.php");
        $invoiceModel = new invoice();

        $code = $_POST["code"];
        $data = $invoiceModel->getDetails($code);
        echo json_encode($data);
    }
    if (isset($_POST["code"]) && isset($_POST["update"])) {
        include_once("../class/invoice.php");
        $invoiceModel = new invoice();

        $code = $_POST["code"];
        $res = $invoiceModel->updateStatusInvoice($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }
    if (isset($_POST["code"]) && isset($_POST["cancel"])) {
        include_once("../class/invoice.php");
        $invoiceModel = new invoice();

        $code = $_POST["code"];
        $res = $invoiceModel->cancelInvoice($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/author.php");
        $authorModel = new author();

        // Nhan input
        $newAuthor = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"],
            "Description" => $_POST["description"]
        );

        $res = $authorModel->createAuthor($newAuthor);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

if (isset($_GET["export"])) {
    $type_export = $_GET["export"];

    include_once("../plugin/PHPExcel/Classes/PHPExcel.php");
    $phpExcel = new PHPExcel();

    include_once("../class/invoice.php");
    $invoiceModel = new invoice();

    $data = $invoiceModel->getInvoices();

    $phpExcel->setActiveSheetIndex(0);
    $phpExcel->getActiveSheet()->setTitle("Danh sách hóa đơn");
    $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
    $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
    $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

    $phpExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
    $phpExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->getColor()->setRGB('FF0000');

    $phpExcel->getActiveSheet()->setCellValue('A1', 'Mã hóa đơn');
    $phpExcel->getActiveSheet()->setCellValue('B1', 'Khách hàng');
    $phpExcel->getActiveSheet()->setCellValue('C1', 'Ngày mua');
    $phpExcel->getActiveSheet()->setCellValue('D1', 'Hình thức giao hàng');
    $phpExcel->getActiveSheet()->setCellValue('E1', 'Tổng giá');
    $phpExcel->getActiveSheet()->setCellValue('F1', 'Trạng thái đơn hàng');
    $phpExcel->getActiveSheet()->setCellValue('G1', 'Mã sản phẩm');
    $phpExcel->getActiveSheet()->setCellValue('H1', 'Tên sản phẩm');
    $phpExcel->getActiveSheet()->setCellValue('I1', 'Loại');
    $phpExcel->getActiveSheet()->setCellValue('J1', 'Số lượng');
    $phpExcel->getActiveSheet()->setCellValue('K1', 'Đơn giá');
    $phpExcel->getActiveSheet()->setCellValue('L1', 'Thành tiền');

    $rowStart = 2;
    foreach ($data as $key=>$val) {
        $phpExcel->getActiveSheet()->setCellValue('A' . $rowStart, $val["Id"]);
        $phpExcel->getActiveSheet()->setCellValue('B' . $rowStart, $val["Customer"]);
        $phpExcel->getActiveSheet()->setCellValue('C' . $rowStart, $val["Date"]);
        $phpExcel->getActiveSheet()->setCellValue('D' . $rowStart, $val["Shipping"]);
        $phpExcel->getActiveSheet()->setCellValue('E' . $rowStart, number_format($val["Total"]) . " đồng");
        $phpExcel->getActiveSheet()->setCellValue('F' . $rowStart, $val["Status"]);
        $data_details = $invoiceModel->getDetails($val["Id"]);
        foreach ($data_details as $key_d=>$val_d) {
            $phpExcel->getActiveSheet()->setCellValue('G' . $rowStart, $val_d["Code"]);
            $phpExcel->getActiveSheet()->setCellValue('H' . $rowStart, $val_d["Name"]);
            $phpExcel->getActiveSheet()->setCellValue('I' . $rowStart, $val_d["Type"]);
            $phpExcel->getActiveSheet()->setCellValue('J' . $rowStart, $val_d["Amount"]);
            $phpExcel->getActiveSheet()->setCellValue('K' . $rowStart, $val_d["Price"] . " đồng");
            $phpExcel->getActiveSheet()->setCellValue('L' . $rowStart, $val_d["Total"] . " đồng");
            $rowStart++;
        }
    }

    $filename = "../data/list_invoice.xlsx";
    PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007')->save($filename);

    header('Content-Disposition: attachment; filename= "danhsach_hoadon.xlsx');
    header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
}

?>
