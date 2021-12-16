<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/author.php");
        $authorModel = new author();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $authorModel->deleteAuthor($code);
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

    include_once("../class/author.php");
    $authorModel = new author();

    $data = $authorModel->getAuthors();

    $phpExcel->setActiveSheetIndex(0);
    $phpExcel->getActiveSheet()->setTitle("Danh sách tác giả");
    $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);

    $phpExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);

    $phpExcel->getActiveSheet()->setCellValue('A1', 'Mã tác giả');
    $phpExcel->getActiveSheet()->setCellValue('B1', 'Tên tác giả');
    $phpExcel->getActiveSheet()->setCellValue('C1', 'Mô tả');

    $rowStart = 2;
    foreach ($data as $key=>$val) {
        $phpExcel->getActiveSheet()->setCellValue('A' . $rowStart, $val["Id"]);
        $phpExcel->getActiveSheet()->setCellValue('B' . $rowStart, $val["Name"]);
        $phpExcel->getActiveSheet()->setCellValue('C' . $rowStart, $val["Description"]);
        $rowStart++;
    }

    $filename = "../data/list_author.xlsx";
    PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007')->save($filename);

    header('Content-Disposition: attachment; filename= "danhsach_tacgia.xlsx');
    header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
}

?>
