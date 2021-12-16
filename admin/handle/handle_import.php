<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/import.php");
        $importModel = new import();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $importModel->deleteNote($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["get"])) {
        include_once("../class/import.php");
        $importModel = new import();

        $code = $_POST["code"];
        $data = $importModel->getDetails($code);
        echo json_encode($data);
    }

    if (isset($_POST["data"]) && isset($_POST["create"])) {
        session_start();
        include_once("../class/import.php");
        $importModel = new import();

        // Get total
        $notes = $_POST['data'];
        $total = 0;
        foreach ($notes as $key=>$val)
        {
            $total += $val["Amount"]*$val["Price"];
        }

        $array = $_POST;
        $temp = array("User"=>$_SESSION['user']['User'], "Total"=>$total);
        $array = $array + $temp;

        $res = $importModel->importBook($array);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

if (isset($_GET["export"])) {
    $type_export = $_GET["export"];

    include_once("../plugin/PHPExcel/Classes/PHPExcel.php");
    $phpExcel = new PHPExcel();

    include_once("../class/import.php");
    $importModel = new import();

    $data = $importModel->getNotes();

    $phpExcel->setActiveSheetIndex(0);
    $phpExcel->getActiveSheet()->setTitle("Danh sách phiếu nhập");
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

    $phpExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
    $phpExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->getColor()->setRGB('FF0000');

    $phpExcel->getActiveSheet()->setCellValue('A1', 'Mã phiếu nhập');
    $phpExcel->getActiveSheet()->setCellValue('B1', 'Người nhập');
    $phpExcel->getActiveSheet()->setCellValue('C1', 'Chức vụ');
    $phpExcel->getActiveSheet()->setCellValue('D1', 'Nhà cung cấp');
    $phpExcel->getActiveSheet()->setCellValue('E1', 'Ngày nhập');
    $phpExcel->getActiveSheet()->setCellValue('F1', 'Tổng giá nhập');
    $phpExcel->getActiveSheet()->setCellValue('G1', 'Mã sản phẩm');
    $phpExcel->getActiveSheet()->setCellValue('H1', 'Tên sản phẩm');
    $phpExcel->getActiveSheet()->setCellValue('I1', 'Số lượng');
    $phpExcel->getActiveSheet()->setCellValue('J1', 'Đơn giá');
    $phpExcel->getActiveSheet()->setCellValue('K1', 'Thành tiền');

    $rowStart = 2;
    foreach ($data as $key=>$val) {
        $phpExcel->getActiveSheet()->setCellValue('A' . $rowStart, $val["Id"]);
        $phpExcel->getActiveSheet()->setCellValue('B' . $rowStart, $val["Name"]);
        $phpExcel->getActiveSheet()->setCellValue('C' . $rowStart, $val["Role"]);
        $phpExcel->getActiveSheet()->setCellValue('D' . $rowStart, $val["Ncc"]);
        $phpExcel->getActiveSheet()->setCellValue('E' . $rowStart, $val["Date"]);
        $phpExcel->getActiveSheet()->setCellValue('F' . $rowStart, $val["Total"] . " đồng");
        $data_details = $importModel->getDetails($val["Id"]);
        foreach ($data_details as $key_d=>$val_d) {
            $phpExcel->getActiveSheet()->setCellValue('G' . $rowStart, $val_d["Code"]);
            $phpExcel->getActiveSheet()->setCellValue('H' . $rowStart, $val_d["Name"]);
            $phpExcel->getActiveSheet()->setCellValue('I' . $rowStart, $val_d["Amount"]);
            $phpExcel->getActiveSheet()->setCellValue('J' . $rowStart, $val_d["Price"] . " đồng");
            $phpExcel->getActiveSheet()->setCellValue('K' . $rowStart, $val_d["Total"] . " đồng");
            $rowStart++;
        }
    }

    $filename = "../data/list_import.xlsx";
    PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007')->save($filename);

    header('Content-Disposition: attachment; filename= "danhsach_phieunhap.xlsx');
    header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
}


?>