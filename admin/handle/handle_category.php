<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/category.php");
        $categoryModel = new category();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $categoryModel->deleteCategory($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/category.php");
        $categoryModel = new category();

        // Nhan input
        $newCategory = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"]
        );

        $res = $categoryModel->createCategory($newCategory);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_GET["export"])) {
        $type_export = $_GET["export"];

        include_once("../plugin/PHPExcel/Classes/PHPExcel.php");
        $phpExcel = new PHPExcel();

        include_once("../class/category.php");
        $categoryModel = new category();

        $data = $categoryModel->getCategory();

        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setTitle("Danh sách danh mục");
        $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);

        $phpExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true);

        $phpExcel->getActiveSheet()->setCellValue('A1', 'Mã danh mục');
        $phpExcel->getActiveSheet()->setCellValue('B1', 'Tên danh mục');

        $rowStart = 2;
        foreach ($data as $key=>$val) {
            $phpExcel->getActiveSheet()->setCellValue('A' . $rowStart, $val["Id"]);
            $phpExcel->getActiveSheet()->setCellValue('B' . $rowStart, $val["Name"]);
            $rowStart++;
        }

        $filename = "../data/list_category.xlsx";
        PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007')->save($filename);

        header('Content-Disposition: attachment; filename= "danhsach_theloai.xlsx');
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($filename));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        readfile($filename);
    }
?>
