<?php
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input values
    function clean_input($data) {
        return htmlspecialchars(trim($data));
    }

    // Assign values safely
    $Datetime = clean_input($_POST['Datetime'] ?? date('Y-m-d H:i:s'));
    $Select_Employee1 = clean_input($_POST['Select_Employee1'] ?? '');
    $Select_Employee2 = clean_input($_POST['Select_Employee2'] ?? '');
    $Select_Liquid1 = clean_input($_POST['Select_Liquid1'] ?? '');
    $Select_Liquid2 = clean_input($_POST['Select_Liquid2'] ?? '');
    $Opening_QTY1 = clean_input($_POST['Opening_QTY1'] ?? 0);
    $Opening_QTY2 = clean_input($_POST['Opening_QTY2'] ?? 0);
    $Sale1 = clean_input($_POST['Sale1'] ?? 0);
    $Sale2 = clean_input($_POST['Sale2'] ?? 0);
    $Sale_AMT1 = clean_input($_POST['Sale_AMT1'] ?? 0.00);
    $Sale_AMT2 = clean_input($_POST['Sale_AMT2'] ?? 0.00);
    $Closing_QTY1 = clean_input($_POST['Closing_QTY1'] ?? 0);
    $Closing_QTY2 = clean_input($_POST['Closing_QTY2'] ?? 0);
    $rate1 = clean_input($_POST['rate1'] ?? 0.00);
    $rate2 = clean_input($_POST['rate2'] ?? 0.00);

    // Using prepared statements for security
    $stmt = $conn->prepare("INSERT INTO liquid 
        (Datetime, Select_Employee1, Select_Employee2, Select_Liquid1, Select_Liquid2, 
        Opening_QTY1, Opening_QTY2, Sale1, Sale2, Sale_AMT1, Sale_AMT2, 
        Closing_QTY1, Closing_QTY2, rate1, rate2) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssssssssssss", 
        $Datetime, $Select_Employee1, $Select_Employee2, 
        $Select_Liquid1, $Select_Liquid2, $Opening_QTY1, $Opening_QTY2, 
        $Sale1, $Sale2, $Sale_AMT1, $Sale_AMT2, 
        $Closing_QTY1, $Closing_QTY2, $rate1, $rate2
    );

    // Execute query
    if ($stmt->execute()) {
        "<script>
            alert('Vendor added successfully!');
            window.location.href='liquid.php'; // Redirect to dashboard or another page
          </script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    
    $stmt->close();
}
// Fetch latest Shift C close reading
$sql_shiftC = "SELECT Closing_QTY1 FROM liquidc1 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_reading = isset($shiftC_data['Closing_QTY1']) ? $shiftC_data['Closing_QTY1'] : "";


$sql_shiftC = "SELECT Closing_QTY2 FROM liquidc1 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_ms_reading = isset($shiftC_data['Closing_QTY2']) ? $shiftC_data['Closing_QTY2'] : "";
// Fetch latest data
$sql = "SELECT * FROM liquid ORDER BY Datetime DESC LIMIT 1";
$result = $conn->query($sql);
$latestData = ($result->num_rows > 0) ? $result->fetch_assoc() : null;

// Fetch Employee List
$employees = [];
$sql = "SELECT id, company_name FROM employee";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Data Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .container-box {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        width: 50%;
    }

    .machine-info {
        background: #ff6200;
        color: white;
        padding: 5px 10px;
        text-align: left;
        font-weight: bold;
        border-radius: 5px;
        margin-bottom: 10px;
        width: auto;
        font-size: 12px;
        display: inline-block;
    }

    .btn-submit {
        background: #ff6200 !important;
        color: white;
        font-weight: bold;
        width: 30%;
        display: block;
        margin: 20px auto;
        padding: 5px;
        font-size: 14px;
        border: none;
    }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container-box">
            <div class="machine-info">Add Liquid</div>
            <button type="button" class="machine-info" onclick="window.location.href='../mainshiftA.php'">Back</button>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label"><strong>Date & Time:</strong></label>
                    <input type="text" class="form-control" name="Datetime" value="<?php echo date('Y-m-d H:i:s'); ?>"
                        readonly>
                </div>
                <div class="mb-3 row">
                    <label class="col-4"><strong>Select Employee</strong></label>
                    <div class="col-4">
                        <select class="form-select" name="Select_Employee1">
                            <option>Select Employee</option>
                            <?php foreach ($employees as $employee) { ?>
                            <option value="<?php echo $employee['company_name']; ?>"
                                <?php echo (isset($latestData['Select_Employee1']) && $latestData['Select_Employee1'] == $employee['company_name']) ? "selected" : ""; ?>>
                                <?php echo $employee['company_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select" name="Select_Employee2">
                            <option>Select Employee</option>
                            <?php foreach ($employees as $employee) { ?>
                            <option value="<?php echo $employee['company_name']; ?>"
                                <?php echo (isset($latestData['Select_Employee2']) && $latestData['Select_Employee2'] == $employee['company_name']) ? "selected" : ""; ?>>
                                <?php echo $employee['company_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4"><strong>Select Liquid</strong></label>

                    <div class="col-4">
                        <select class="form-select" name="Select_Liquid1">
                            <option value="">Select Liquid</option>
                            <option value="Mobile-2T"
                                <?php echo (isset($latestData['Select_Liquid1']) && $latestData['Select_Liquid1'] == 'Mobile-2T') ? 'selected' : ''; ?>>
                                Mobile-2T</option>
                            <option value="D Water 1 Ltr"
                                <?php echo (isset($latestData['Select_Liquid1']) && $latestData['Select_Liquid1'] == 'D Water 1 Ltr') ? 'selected' : ''; ?>>
                                D Water 1 Ltr</option>
                            <option value="Mobile-1 Ltr"
                                <?php echo (isset($latestData['Select_Liquid1']) && $latestData['Select_Liquid1'] == 'Mobile-1 Ltr') ? 'selected' : ''; ?>>
                                Mobile-1 Ltr</option>
                            <option value="D Water 5 Ltr"
                                <?php echo (isset($latestData['Select_Liquid1']) && $latestData['Select_Liquid1'] == 'D Water 5 Ltr') ? 'selected' : ''; ?>>
                                D Water 5 Ltr</option>
                        </select>

                    </div>

                    <div class="col-4">
                        <select class="form-select" name="Select_Liquid2">
                            <option value="">Select Liquid</option>
                            <option value="Mobile-2T"
                                <?php echo (isset($latestData['Select_Liquid2']) && $latestData['Select_Liquid2'] == 'Mobile-2T') ? 'selected' : ''; ?>>
                                Mobile-2T</option>
                            <option value="D Water 1 Ltr"
                                <?php echo (isset($latestData['Select_Liquid2']) && $latestData['Select_Liquid2'] == 'D Water 1 Ltr') ? 'selected' : ''; ?>>
                                D Water 1 Ltr</option>
                            <option value="Mobile-1 Ltr"
                                <?php echo (isset($latestData['Select_Liquid2']) && $latestData['Select_Liquid2'] == 'Mobile-1 Ltr') ? 'selected' : ''; ?>>
                                Mobile-1 Ltr</option>
                            <option value="D Water 5 Ltr"
                                <?php echo (isset($latestData['Select_Liquid2']) && $latestData['Select_Liquid2'] == 'D Water 5 Ltr') ? 'selected' : ''; ?>>
                                D Water 5 Ltr</option>
                        </select>

                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-4">Opening QTY</label>
                    <div class="col-4"><input type="number" class="form-control" name="Opening_QTY1" id="Opening_QTY1"
                            oninput="calculateSaleAndAmount()"
                            value="<?php echo $shiftC_close_reading; ?>" readonly>
                        </div>
                    <div class="col-4"><input type="number" class="form-control" name="Opening_QTY2"id="Opening_QTY2"
                            oninput="calculateSaleAndAmount2()"
                            value="<?php echo $shiftC_close_ms_reading; ?>" readonly>
                        </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4">Closing QTY</label>
                    <div class="col-4">
                        <input type="number" class="form-control" name="Closing_QTY1" id="Closing_QTY1"
                            oninput="calculateSaleAndAmount()"
                            value="<?php echo isset($latestData['Closing_QTY1']) ? $latestData['Closing_QTY1'] : ''; ?>">
                    </div>
                    <div class="col-4">
                        <input type="number" class="form-control" name="Closing_QTY2"id="Closing_QTY2"
                            oninput="calculateSaleAndAmount2()"
                            value="<?php echo isset($latestData['Closing_QTY2']) ? $latestData['Closing_QTY2'] : ''; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4">Sale</label>
                    <div class="col-4"><input type="number" class="form-control" name="Sale1" id="Sale1"
                            oninput="calculateSaleAmount()"
                            value="<?php echo $latestData ? $latestData['Sale1'] : ''; ?>"></div>
                    <div class="col-4"><input type="number" class="form-control" name="Sale2"id="Sale2"
                            oninput="calculateSaleAmount2()"
                            value="<?php echo $latestData ? $latestData['Sale2'] : ''; ?>"></div>
                </div>

                <div class="mb-3 row">
                    <label class="col-4">Rate</label>
                    <div class="col-4"><input type="number" class="form-control" name="rate1" id="rate1"
                            oninput="calculateSaleAndAmount()"
                            value="<?php echo $latestData ? $latestData['rate1'] : ''; ?>"></div>
                    <div class="col-4"><input type="number" class="form-control" name="rate2" id="rate2"
                            oninput="calculateSaleAndAmount2()"
                            value="<?php echo $latestData ? $latestData['rate2'] : ''; ?>"></div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4">Sale AMT</label>
                    <div class="col-4"><input type="number" class="form-control" name="Sale_AMT1" id="Sale_AMT1"
                            readonly readonly value="<?php echo $latestData ? $latestData['Sale_AMT1'] : ''; ?>"></div>
                    <div class="col-4"><input type="number" class="form-control" name="Sale_AMT2"id="Sale_AMT2"
                            value="<?php echo $latestData ? $latestData['Sale_AMT2'] : ''; ?>"></div>
                </div>



                <button type="submit" class="btn btn-submit">SUBMIT</button>
            </form>
        </div>
    </div>
    <script>
    function calculateSaleAndAmount() {
        let opening1 = parseFloat(document.getElementById('Opening_QTY1').value) || 0;
        let closing1 = parseFloat(document.getElementById('Closing_QTY1').value) || 0;
        let rate1 = parseFloat(document.getElementById('rate1').value) || 0;

        let sale1 = closing1 - opening1;
        document.getElementById('Sale1').value = sale1;
        document.getElementById('Sale_AMT1').value = sale1 * rate1;

        
    }
    </script>
    <script>
    function calculateSaleAndAmount2() {
        let opening2 = parseFloat(document.getElementById('Opening_QTY2').value) || 0;
        let closing2 = parseFloat(document.getElementById('Closing_QTY2').value) || 0;
        let rate2 = parseFloat(document.getElementById('rate2').value) || 0;

        let sale2 = closing2 - opening2;
        document.getElementById('Sale2').value = sale2;
        document.getElementById('Sale_AMT2').value = sale2 * rate2;
    }
</script>


</body>

</html>