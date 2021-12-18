<?php
    if (isset($_POST["code"]) && isset($_POST["delete"]))
    {
        include_once("../class/books.php");
        $bookModel = new books();

        // Thuc hien thay doi trang thai t.khoan
        $code = $_POST["code"];
        $res = $bookModel->deleteBook($code);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["code"]) && isset($_POST["create"])) {
        include_once("../class/books.php");
        $bookModel = new books();

        // Nhan input
        $newBook = array(
            "Code"=> $_POST["code"],
            "Category"=> $_POST["category"],
            "Name"=> $_POST["name"],
            "Author"=> $_POST["author"],
            "Nxb"=> $_POST["nxb"],
            "Released"=> $_POST["released"],
            "Amount"=> $_POST["amount"],
            "Description"=> $_POST["description"],
            "Language"=> $_POST["language"],
            "Price"=> $_POST["price"],
            "Ebook"=> $_POST["ebook"],
        );

        $res = $bookModel->createBook($newBook);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_POST["update"]))
    {
        session_start();
        include_once("../class/books.php");
        $bookModel = new books();
        $update = $_POST["update"];

        // Nhan input
        $book = array(
            "Code" => $_POST["code"],
            "Name" => $_POST["name"],
            "Amount" => $_POST["amount"],
            "Language" => $_POST["language"],
            "Description" => $_POST["description"],
            "Price" => $_POST["price"],
            "Ebook" => $_POST["ebook"],
            "Category" => $_POST["category"],
            "Author" => $_POST["author"],
            "Nxb" => $_POST["nxb"],
            "Year" => $_POST["year"],
        );

        $res = $bookModel->updateBook($book);
        if (trim($res)) {
            echo "success";
        } else echo "fail";
    }

    if (isset($_GET["export"])) {
        $type_export = $_GET["export"];

        include_once("../plugin/PHPExcel/Classes/PHPExcel.php");
        $phpExcel = new PHPExcel();

        include_once("../class/books.php");
        $bookModel = new books();

        $data = $bookModel->exportDataBook();

        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setTitle("Danh sách sản phẩm");
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

        $phpExcel->getActiveSheet()->setCellValue('A1', 'Mã sách');
        $phpExcel->getActiveSheet()->setCellValue('B1', 'Danh mục');
        $phpExcel->getActiveSheet()->setCellValue('C1', 'Tên sách');
        $phpExcel->getActiveSheet()->setCellValue('D1', 'Tác giả');
        $phpExcel->getActiveSheet()->setCellValue('E1', 'Nhà xuất bản');
        $phpExcel->getActiveSheet()->setCellValue('F1', 'Năm xuất bản');
        $phpExcel->getActiveSheet()->setCellValue('G1', 'Số lượng tồn kho');
        $phpExcel->getActiveSheet()->setCellValue('H1', 'Mô tả sách');
        $phpExcel->getActiveSheet()->setCellValue('I1', 'Ngôn ngữ');
        $phpExcel->getActiveSheet()->setCellValue('J1', 'Giá sách giấy');
        $phpExcel->getActiveSheet()->setCellValue('K1', 'Giá sách Ebook');

        $rowStart = 2;
        foreach ($data as $key=>$val) {
            $phpExcel->getActiveSheet()->setCellValue('A' . $rowStart, $val["Id"]);
            $phpExcel->getActiveSheet()->setCellValue('B' . $rowStart, $val["Category"]);
            $phpExcel->getActiveSheet()->setCellValue('C' . $rowStart, $val["Name"]);
            $phpExcel->getActiveSheet()->setCellValue('D' . $rowStart, $val["Author"]);
            $phpExcel->getActiveSheet()->setCellValue('E' . $rowStart, $val["NXB"]);
            $phpExcel->getActiveSheet()->setCellValue('F' . $rowStart, $val["DayReleased"]);
            $phpExcel->getActiveSheet()->setCellValue('G' . $rowStart, $val["Amount"]);
            $phpExcel->getActiveSheet()->setCellValue('H' . $rowStart, $val["Description"]);
            $phpExcel->getActiveSheet()->setCellValue('I' . $rowStart, $val["Language"]);
            $phpExcel->getActiveSheet()->setCellValue('J' . $rowStart, number_format($val["PriceBook"]) . " đồng");
            $phpExcel->getActiveSheet()->setCellValue('K' . $rowStart, number_format($val["PriceEbook"]) . " đồng");
            $rowStart++;
        }

        $filename = "../data/list_book.xlsx";
        PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007')->save($filename);

        header('Content-Disposition: attachment; filename= "danhsach_sanpham.xlsx');
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
        header('Content-Length: ' . filesize($filename));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: no-cache');
        readfile($filename);
    }

?>