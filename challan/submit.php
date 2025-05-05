<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include TCPDF Library
require_once('tcpdf/tcpdf.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Check if form data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        empty($_POST['challan_no']) || empty($_POST['challan_date']) || empty($_POST['customer']) || 
        empty($_POST['shift']) || empty($_POST['vehicle_no']) || empty($_POST['shift_date']) || 
        empty($_POST['employee']) || empty($_POST['grand_total'])
    ) {
        die("Error: All required fields must be filled.");
    }

    // Retrieve form data
    $challan_no = $conn->real_escape_string($_POST['challan_no']);
    $challan_date = $conn->real_escape_string($_POST['challan_date']);
    $customer = $conn->real_escape_string($_POST['customer']);
    $shift = $conn->real_escape_string($_POST['shift']);
    $vehicle_no = $conn->real_escape_string($_POST['vehicle_no']);
    $shift_date = $conn->real_escape_string($_POST['shift_date']);
    $employee = $conn->real_escape_string($_POST['employee']);
    $grand_total = floatval($_POST['grand_total']);

    // Insert into challans table
    $stmt = $conn->prepare("INSERT INTO challans (challan_no, challan_date, customer, shift, vehicle_no, shift_date, employee, grand_total) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssd", $challan_no, $challan_date, $customer, $shift, $vehicle_no, $shift_date, $employee, $grand_total);

    if ($stmt->execute()) {
        $challan_id = $stmt->insert_id; // Get last inserted ID

        // Insert into challan_items table
        if (!empty($_POST['product'])) {
            $stmt_items = $conn->prepare("INSERT INTO challan_items (challan_id, product, quantity, uom, rate, total_amount) 
                                          VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($_POST['product'] as $index => $product) {
                if (!empty($product) && !empty($_POST['quantity'][$index]) && !empty($_POST['uom'][$index]) && !empty($_POST['rate'][$index])) {
                    $quantity = floatval($_POST['quantity'][$index]);
                    $uom = $conn->real_escape_string($_POST['uom'][$index]);
                    $rate = floatval($_POST['rate'][$index]);
                    $total_amount = floatval($_POST['total_amount'][$index]);

                    $stmt_items->bind_param("isdsdd", $challan_id, $product, $quantity, $uom, $rate, $total_amount);
                    $stmt_items->execute();
                }
            }
            $stmt_items->close();
        }

         // **Ensure "pdfs" directory exists**
         $pdfDir = __DIR__ . "/pdfs";
         if (!file_exists($pdfDir)) {
             mkdir($pdfDir, 0777, true); // Create folder with full permissions
         }
//  // Generate PDF
// $pdfFileName = "challan_$challan_id.pdf";
// $pdfFilePath = $pdfDir . "/" . $pdfFileName;

// $pdf->Output($pdfFilePath, 'F'); // Save PDF correctly
// echo "Challan and items saved successfully! <br>";
// echo "<a href='pdfs/$pdfFileName' target='_blank'>Download Challan PDF</a>";

        // **PDF Generation**
        $pdf = new TCPDF();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();
        
        // PDF Title
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Challan Details', 0, 1, 'C');
        $pdf->Ln(5);

        // Customer Details
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, "Challan No: $challan_no", 0, 1);
        $pdf->Cell(0, 10, "Challan Date: $challan_date", 0, 1);
        $pdf->Cell(0, 10, "Customer: $customer", 0, 1);
        $pdf->Cell(0, 10, "Shift: $shift", 0, 1);
        $pdf->Cell(0, 10, "Vehicle No: $vehicle_no", 0, 1);
        $pdf->Cell(0, 10, "Shift Date: $shift_date", 0, 1);
        $pdf->Cell(0, 10, "Employee: $employee", 0, 1);
        $pdf->Ln(5);

        // Table Header
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(30, 10, 'Product', 1);
        $pdf->Cell(30, 10, 'Quantity', 1);
        $pdf->Cell(30, 10, 'UOM', 1);
        $pdf->Cell(30, 10, 'Rate', 1);
        $pdf->Cell(30, 10, 'Total', 1);
        $pdf->Ln();

        // Fetch Items from Database
        $query = "SELECT product, quantity, uom, rate, total_amount FROM challan_items WHERE challan_id = ?";
        $stmt_fetch = $conn->prepare($query);
        $stmt_fetch->bind_param("i", $challan_id);
        $stmt_fetch->execute();
        $result = $stmt_fetch->get_result();

        $pdf->SetFont('helvetica', '', 12);
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(30, 10, $row['product'], 1);
            $pdf->Cell(30, 10, $row['quantity'], 1);
            $pdf->Cell(30, 10, $row['uom'], 1);
            $pdf->Cell(30, 10, $row['rate'], 1);
            $pdf->Cell(30, 10, $row['total_amount'], 1);
            $pdf->Ln();
        }

        // Grand Total
        $pdf->Ln(5);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, "Grand Total: $grand_total", 0, 1, 'R');

      // **Save PDF on server**
$pdfFileName = "challan_$challan_id.pdf";
$pdfFilePath = $pdfDir . "/" . $pdfFileName;
$pdf->Output($pdfFilePath, 'F'); // ✅ Save PDF on server

// **Force Download in Browser**
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $pdfFileName . '"');
readfile($pdfFilePath);
exit;
    }
}

  
