<?php
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter values from URL
$search = isset($_GET['search']) ? $_GET['search'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Fetch data based on filters
$sql = "SELECT * FROM stock_entries WHERE 1";

if (!empty($search)) {
    $sql .= " AND (company_name LIKE '%$search%' OR invoice_no LIKE '%$search%' OR veh_no LIKE '%$search%')";
}

if (!empty($start_date) && !empty($end_date)) {
    $sql .= " AND invoice_date BETWEEN '$start_date' AND '$end_date'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Load PHPExcel library
    require_once 'PHPExcel/PHPExcel.php';
    
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);
    $sheet = $objPHPExcel->getActiveSheet();

    // Set column headers
    $sheet->setCellValue('A1', 'SNo');
    $sheet->setCellValue('B1', 'Company Name');
    $sheet->setCellValue('C1', 'Invoice No.');
    $sheet->setCellValue('D1', 'Vehicle No.');
    $sheet->setCellValue('E1', 'Challan No.');
    $sheet->setCellValue('F1', 'Invoice Date');
    $sheet->setCellValue('G1', 'Delivery Date');
    $sheet->setCellValue('H1', 'Challan Date');
    $sheet->setCellValue('I1', 'GST No.');
    $sheet->setCellValue('J1', 'Remarks');

    // Populate data
    $rowNumber = 2;
    $sno = 1;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue("A$rowNumber", $sno);
        $sheet->setCellValue("B$rowNumber", $row['company_name']);
        $sheet->setCellValue("C$rowNumber", $row['invoice_no']);
        $sheet->setCellValue("D$rowNumber", $row['veh_no']);
        $sheet->setCellValue("E$rowNumber", $row['challan_no']);
        $sheet->setCellValue("F$rowNumber", $row['invoice_date']);
        $sheet->setCellValue("G$rowNumber", $row['delivery_date']);
        $sheet->setCellValue("H$rowNumber", $row['challan_date']);
        $sheet->setCellValue("I$rowNumber", $row['gst_no']);
        $sheet->setCellValue("J$rowNumber", $row['remark']);
        
        $rowNumber++;
        $sno++;
    }

    // Output to browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Stock_Entries.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $writer->save('php://output');
} else {
    echo "No records found!";
}

$conn->close();
?>
