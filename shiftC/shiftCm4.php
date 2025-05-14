<?php
// Database connection
$host = "localhost"; // Change if required
$username = "root"; // Change if required
$password = "Rajukumar@21"; // Change if required
$database = "vendors"; // Replace with your DB name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest entry from the database
$sql = "SELECT * FROM shiftc4 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$latestData = $result->fetch_assoc(); // Fetch data as an associative array

// Fetch latest Shift C close reading
$sql_shiftC = "SELECT xg1_close_reading FROM shiftb4 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_xg1_reading = isset($shiftC_data['xg1_close_reading']) ? $shiftC_data['xg1_close_reading'] : "";


$sql_shiftC = "SELECT xg2_close_reading FROM shiftb4 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_xg2_reading = isset($shiftC_data['xg2_close_reading']) ? $shiftC_data['xg2_close_reading'] : "";

$sql_shiftC = "SELECT ms1_close_reading FROM shiftb4 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_ms1_reading = isset($shiftC_data['ms1_close_reading']) ? $shiftC_data['ms1_close_reading'] : "";

$sql_shiftC = "SELECT ms2_close_reading FROM shiftb4 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_ms2_reading = isset($shiftC_data['ms2_close_reading']) ? $shiftC_data['ms2_close_reading'] : "";

// Fetch latest Shift A entry (if needed)
$sql_shiftA = "SELECT * FROM shiftc4 ORDER BY id DESC LIMIT 1";
$result_shiftA = $conn->query($sql_shiftA);
$latestData = $result_shiftA->fetch_assoc();


$employees = [];
$sql = "SELECT id, company_name FROM employee";  // Apni employee table ka actual naam yaha likhein
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
date_default_timezone_set('Asia/Kolkata');

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
        padding: 10px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        width: 50%;
        margin: 10px;
    }

    .contai-box {
        background: white;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        width: 80%;
        margin: 10px;
    }

    .header {
        text-align: center;
        font-weight: bold;
        color: #ff6200;
    }

    .machine-info {
        background: #ff6200;
        color: white;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .psn {
        color: red;
        font-size: 18px;
        text-align: center;
        font-weight: bold;
    }

    .btn-submit {
        background: #ff6200;
        color: white;
        font-weight: bold;
        width: 100%;
    }

    .containe {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header,
    .machine-info,
    .psn {
        margin: 0 10px;
    }

    .color {
        background-color: red;
    }
    </style>
</head>

<body>
    <?php 
    //include '../navbar.php'; ?>

    <div class="contai d-flex flex-container">
        <!-- <div class="row mt-3">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-danger" onclick="resetForm()">Reset</button>
            </div>
        </div>
        <script>
        function resetForm() {
            // Exclude open readings, date, and all rate fields from reset
            document.querySelectorAll(
                'input:not([name="xg1_start_reading"]):not([name="xg2_start_reading"]):not([name="ms1_start_reading"]):not([name="ms2_start_reading"]):not([name="datetime"]):not([name$="_rate"]), select'
            ).forEach(field => {
                if (field.tagName === 'INPUT') {
                    field.value = ''; // Clear input fields
                } else if (field.tagName === 'SELECT') {
                    field.selectedIndex = 0; // Reset select dropdowns
                }
            });
        }
        </script> -->
        <div class="contai-box">
            <div class="containe">
                <p class="machine-info">BPT SHIFT C</p>
                <div class="machine-info">MACHINE NO. 04</div>
                <div class="machine-info">PSN: 1295</div>
            </div>

            <form action="shiftCm4DB.php" method="POST">
                <div class="row mb-3 mt-2">
                <div class="col-12 d-flex align-items-center">
                        <label class="me-2"><strong>Date & Time:</strong></label>
                        <input type="datetime-local" class="form-control" name="datetime"
                            value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
                    </div>

                </div>


                <div class="row mb-3">
                    <div class="col-2"><strong>product</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="product1" disabled>
                            <option value="XG-1"
                                <?php echo (isset($latestData['product1']) && $latestData['product1'] == "XG-1") ? "selected" : ""; ?>>
                                XG-1
                            </option>
                            <option value="XG-2"
                                <?php echo (isset($latestData['product1']) && $latestData['product1'] == "XG-2") ? "selected" : ""; ?>>
                                XG-2
                            </option>
                            <option value="MS-1"
                                <?php echo (isset($latestData['product1']) && $latestData['product1'] == "MS-1") ? "selected" : ""; ?>>
                                MS-1
                            </option>
                            <option value="MS-2"
                                <?php echo (isset($latestData['product1']) && $latestData['product1'] == "MS-2") ? "selected" : ""; ?>>
                                MS-2
                            </option>
                        </select>
                        <input type="hidden" name="product1"
                            value="<?php echo isset($latestData['product1']) ? htmlspecialchars($latestData['product1']) : ''; ?>">
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="product2" disabled>
                        <option value="XG-2"
                                <?php echo (isset($latestData['product2']) && $latestData['product2'] == "XG-2") ? "selected" : ""; ?>>
                                XG-2
                            </option>
                            <option value="XG-1"
                                <?php echo (isset($latestData['product2']) && $latestData['product2'] == "XG-1") ? "selected" : ""; ?>>
                                XG-1
                            </option>
                            
                            <option value="MS-1"
                                <?php echo (isset($latestData['product2']) && $latestData['product2'] == "MS-1") ? "selected" : ""; ?>>
                                MS-1
                            </option>
                            <option value="MS-2"
                                <?php echo (isset($latestData['product2']) && $latestData['product2'] == "MS-2") ? "selected" : ""; ?>>
                                MS-2
                            </option>
                        </select>

                        <input type="hidden" name="product2"
                            value="<?php echo isset($latestData['product2']) ? htmlspecialchars($latestData['product2']) : ''; ?>">

                    </div>
                    <div class="col-2">
                        <select class="form-select" name="product3" disabled>
                        <option value="MS-1"
                                <?php echo (isset($latestData['product3']) && $latestData['product3'] == "MS-1") ? "selected" : ""; ?>>
                                MS-1
                            </option>
                            <option value="XG-1"
                                <?php echo (isset($latestData['product3']) && $latestData['product3'] == "XG-1") ? "selected" : ""; ?>>
                                XG-1
                            </option>
                            <option value="XG-2"
                                <?php echo (isset($latestData['product3']) && $latestData['product3'] == "XG-2") ? "selected" : ""; ?>>
                                XG-2
                            </option>
                            
                            <option value="MS-2"
                                <?php echo (isset($latestData['product3']) && $latestData['product3'] == "MS-2") ? "selected" : ""; ?>>
                                MS-2
                            </option>
                        </select>

                        <input type="hidden" name="product3"
                            value="<?php echo isset($latestData['product3']) ? htmlspecialchars($latestData['product3']) : ''; ?>">

                    </div>
                    <div class="col-3">
                        <select class="form-select" name="product4" disabled>
                        <option value="MS-2"
                                <?php echo (isset($latestData['product4']) && $latestData['product4'] == "MS-2") ? "selected" : ""; ?>>
                                MS-2
                            </option>
                            <option value="XG-1"
                                <?php echo (isset($latestData['product4']) && $latestData['product4'] == "XG-1") ? "selected" : ""; ?>>
                                XG-1
                            </option>
                            <option value="XG-2"
                                <?php echo (isset($latestData['product4']) && $latestData['product4'] == "XG-2") ? "selected" : ""; ?>>
                                XG-2
                            </option>
                            <option value="MS-1"
                                <?php echo (isset($latestData['product4']) && $latestData['product4'] == "MS-1") ? "selected" : ""; ?>>
                                MS-1
                            </option>
                            
                        </select>

                        <input type="hidden" name="product4"
                            value="<?php echo isset($latestData['product4']) ? htmlspecialchars($latestData['product4']) : ''; ?>">

                    </div>
                </div>

                <!-- Employee Selection -->
                <div class="row mb-3">
                    <div class="col-2"><strong>Select Employee</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="employee1">
                            <option value="">Select Employee</option>
                            <?php foreach ($employees as $employee) { ?>
                            <option value="<?php echo $employee['company_name']; ?>"
                                <?php echo (isset($latestData['employee1']) && $latestData['employee1'] == $employee['company_name']) ? "selected" : ""; ?>>
                                <?php echo $employee['company_name']; ?>
                            </option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="col-2">
                        <select class="form-select" name="employee2">
                            <option value="">Select Employee</option>
                            <?php foreach ($employees as $employee) { ?>
                            <option value="<?php echo $employee['company_name']; ?>"
                                <?php echo (isset($latestData['employee2']) && $latestData['employee2'] == $employee['company_name']) ? "selected" : ""; ?>>
                                <?php echo $employee['company_name']; ?>
                            </option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="col-2">
                        <select class="form-select" name="employee3">
                            <option value="">Select Employee</option>
                            <?php foreach ($employees as $employee) { ?>
                            <option value="<?php echo $employee['company_name']; ?>"
                                <?php echo (isset($latestData['employee3']) && $latestData['employee3'] == $employee['company_name']) ? "selected" : ""; ?>>
                                <?php echo $employee['company_name']; ?>
                            </option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="col-3">
                        <select class="form-select" name="employee4">
                            <option value="">Select Employee</option>
                            <?php foreach ($employees as $employee) { ?>
                            <option value="<?php echo $employee['company_name']; ?>"
                                <?php echo (isset($latestData['employee4']) && $latestData['employee4'] == $employee['company_name']) ? "selected" : ""; ?>>
                                <?php echo $employee['company_name']; ?>
                            </option>
                            <?php } ?>
                        </select>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2"><strong>Nozzle</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="nozzle1">
                            <option>Select Nozzle</option>
                            <option value="Nozzle 1"
                                <?php echo (isset($latestData['nozzle1']) && $latestData['nozzle1'] == "Nozzle 1") ? "selected" : ""; ?>>
                                Nozzle 1</option>
                            <option value="Nozzle 2"
                                <?php echo (isset($latestData['nozzle1']) && $latestData['nozzle1'] == "Nozzle 2") ? "selected" : ""; ?>>
                                Nozzle 2</option>
                            <option value="Nozzle 3"
                                <?php echo (isset($latestData['nozzle1']) && $latestData['nozzle1'] == "Nozzle 3") ? "selected" : ""; ?>>
                                Nozzle 3</option>
                            <option value="Nozzle 4"
                                <?php echo (isset($latestData['nozzle1']) && $latestData['nozzle1'] == "Nozzle 4") ? "selected" : ""; ?>>
                                Nozzle 4</option>
                        </select>

                    </div>

                    <div class="col-2">
                        <select class="form-select" name="nozzle2">
                            <option>Select Nozzle</option>
                            <option value="Nozzle 1"
                                <?php echo (isset($latestData['nozzle2']) && $latestData['nozzle2'] == "Nozzle 1") ? "selected" : ""; ?>>
                                Nozzle 1</option>
                            <option value="Nozzle 2"
                                <?php echo (isset($latestData['nozzle2']) && $latestData['nozzle2'] == "Nozzle 2") ? "selected" : ""; ?>>
                                Nozzle 2</option>
                            <option value="Nozzle 3"
                                <?php echo (isset($latestData['nozzle2']) && $latestData['nozzle2'] == "Nozzle 3") ? "selected" : ""; ?>>
                                Nozzle 3</option>
                            <option value="Nozzle 4"
                                <?php echo (isset($latestData['nozzle2']) && $latestData['nozzle2'] == "Nozzle 4") ? "selected" : ""; ?>>
                                Nozzle 4</option>
                        </select>

                    </div>

                    <div class="col-2">
                        <select class="form-select" name="nozzle3">
                            <option>Select Nozzle</option>
                            <option value="Nozzle 1"
                                <?php echo (isset($latestData['nozzle3']) && $latestData['nozzle3'] == "Nozzle 1") ? "selected" : ""; ?>>
                                Nozzle 1</option>
                            <option value="Nozzle 2"
                                <?php echo (isset($latestData['nozzle3']) && $latestData['nozzle3'] == "Nozzle 2") ? "selected" : ""; ?>>
                                Nozzle 2</option>
                            <option value="Nozzle 3"
                                <?php echo (isset($latestData['nozzle3']) && $latestData['nozzle3'] == "Nozzle 3") ? "selected" : ""; ?>>
                                Nozzle 3</option>
                            <option value="Nozzle 4"
                                <?php echo (isset($latestData['nozzle3']) && $latestData['nozzle3'] == "Nozzle 4") ? "selected" : ""; ?>>
                                Nozzle 4</option>
                        </select>

                    </div>
                    <div class="col-3">
                        <select class="form-select" name="nozzle4">
                            <option>Select Nozzle</option>
                            <option value="Nozzle 1"
                                <?php echo (isset($latestData['nozzle4']) && $latestData['nozzle4'] == "Nozzle 1") ? "selected" : ""; ?>>
                                Nozzle 1</option>
                            <option value="Nozzle 2"
                                <?php echo (isset($latestData['nozzle4']) && $latestData['nozzle4'] == "Nozzle 2") ? "selected" : ""; ?>>
                                Nozzle 2</option>
                            <option value="Nozzle 3"
                                <?php echo (isset($latestData['nozzle4']) && $latestData['nozzle4'] == "Nozzle 3") ? "selected" : ""; ?>>
                                Nozzle 3</option>
                            <option value="Nozzle 4"
                                <?php echo (isset($latestData['nozzle4']) && $latestData['nozzle4'] == "Nozzle 4") ? "selected" : ""; ?>>
                                Nozzle 4</option>
                        </select>

                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-2"><strong>Open Reading</strong></div>
                    <div class="col-3">
                        <input type="text" class="form-control" name="xg1_start_reading" id="xg1_start_reading"
                            value="<?php echo $shiftC_close_xg1_reading; ?>" readonly>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="xg2_start_reading" id="xg2_start_reading"
                            value="<?php echo $shiftC_close_xg2_reading; ?>" readonly>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="ms1_start_reading" id="ms1_start_reading"
                            value="<?php echo $shiftC_close_ms1_reading; ?>" readonly>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" name="ms2_start_reading" id="ms2_start_reading"
                            value="<?php echo $shiftC_close_ms2_reading; ?>" readonly>
                    </div>
                </div>
                <?php
// Database connection required
//include '../db_connect.php'; 

// Rate table se data fetch karna
$xp95_rate = "";
$ms_rate = "";

$query = "SELECT hd_rate, ms_rate FROM rate LIMIT 1"; // Sirf ek record lena
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $xp95_rate = $row['hd_rate'];
        $ms_rate = $row['ms_rate'];
    }
} else {
    die("Query Failed: " . mysqli_error($conn)); // Debugging ke liye
}

// Form fields
$fields = ["Close Reading", "Reading Difference", "Testing Less", "Net Sale", "Rate", "Cash", "Paytm machine No", "Paytm Amount", "Card Machine No", "Card Amount", "Sortage", "Surplus", "Total Amount"];
$paytm_numbers = ["1", "2", "3", "4", "5"];
$cash_denominations = ["1", "2", "3", "4", "5"];

foreach ($fields as $field) {
    echo '<div class="row mb-2">
            <div class="col-2">' . $field . '</div>';

    if ($field == "Rate") {
        // ✅ Rate field - Fetch from database
        echo '<div class="col-3">
                <input type="text" class="form-control" id="xg1_rate" name="xg1_rate" 
                value="' . $xp95_rate . '" readonly>
              </div>
              <div class="col-2">
                <input type="text" class="form-control" id="xg2_rate" name="xg2_rate" 
                value="' . $xp95_rate . '" readonly>
              </div>
              <div class="col-2">
                <input type="text" class="form-control" id="ms1_rate" name="ms1_rate" 
                value="' . $ms_rate . '" readonly>
              </div>
              <div class="col-3">
                <input type="text" class="form-control" id="ms2_rate" name="ms2_rate" 
                value="' . $ms_rate . '" readonly>
              </div>';
    } elseif ($field == "Paytm machine No" || $field == "Card Machine No") {
        // ✅ Dropdowns for Paytm & Card Machine Numbers
        $dropdown_values = ($field == "Paytm machine No") ? $paytm_numbers : $cash_denominations;
        $name_prefix = ($field == "Paytm machine No") ? "paytm" : "card";

        for ($i = 0; $i < 4; $i++) {
            $input_name = $name_prefix . '_' . $i;
            $input_value = isset($latestData[$input_name]) ? $latestData[$input_name] : "";

            echo '<div class="col-2">
                    <div class="input-group">
                        <input type="text" class="form-control" id="' . $input_name . '" 
                        name="' . $input_name . '" placeholder="Enter Amount" value="' . $input_value . '">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                        <ul class="dropdown-menu">';
                            foreach ($dropdown_values as $value) {
                                echo '<li><a class="dropdown-item select-option" data-input="' . $input_name . '" href="#">' . $value . '</a></li>';
                            }
            echo       '</ul>
                    </div>
                </div>';
        }
    } else {
        // ✅ Normal input fields
        echo '<div class="col-3">
                <input type="text" class="form-control" id="xg1_' . strtolower(str_replace(" ", "_", $field)) . '" 
                name="xg1_' . strtolower(str_replace(" ", "_", $field)) . '" 
                value="' . (isset($latestData['xg1_' . strtolower(str_replace(" ", "_", $field))]) ? $latestData['xg1_' . strtolower(str_replace(" ", "_", $field))] : "") . '">
              </div>
              <div class="col-2">
                <input type="text" class="form-control" id="xg2_' . strtolower(str_replace(" ", "_", $field)) . '"  
                name="xg2_' . strtolower(str_replace(" ", "_", $field)) . '" 
                value="' . (isset($latestData['xg2_' . strtolower(str_replace(" ", "_", $field))]) ? $latestData['xg2_' . strtolower(str_replace(" ", "_", $field))] : "") . '">
              </div>
              <div class="col-2">
                <input type="text" class="form-control" id="ms1_' . strtolower(str_replace(" ", "_", $field)) . '" 
                name="ms1_' . strtolower(str_replace(" ", "_", $field)) . '" 
                value="' . (isset($latestData['ms1_' . strtolower(str_replace(" ", "_", $field))]) ? $latestData['ms1_' . strtolower(str_replace(" ", "_", $field))] : "") . '">
              </div>
              <div class="col-3">
                <input type="text" class="form-control" id="ms2_' . strtolower(str_replace(" ", "_", $field)) . '"  
                name="ms2_' . strtolower(str_replace(" ", "_", $field)) . '" 
                value="' . (isset($latestData['ms2_' . strtolower(str_replace(" ", "_", $field))]) ? $latestData['ms2_' . strtolower(str_replace(" ", "_", $field))] : "") . '">
              </div>';
    }
    echo '</div>'; // Close row
}
?>


                <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
            </form>
            <div class="row mt-2">
                <div class="row">
                    <div class="col-3">
                        <a href="moneycash/m4moneyreport.php" class="">Add cash</a>
                    </div>
                    <div class="col-3">
                        <a href="m4liquid/liquidlist.php" class="">Add Liquid</a>

                    </div>
                    <div class="col-3">
                        <a href="expensem4/explist.php" class="">Expenses</a>

                    </div>
                    <div class="col-3">
                        <a href="collection/m4collectionreport.php" class="">Collection</a>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function calculateValues(rowIndex, prefix) {
        let startReading = parseFloat(document.getElementsByName(`${prefix}start_reading`)[rowIndex]?.value) || 0;
        let closeReading = parseFloat(document.getElementsByName(`${prefix}close_reading`)[rowIndex]?.value) || 0;
        let testingLess = parseFloat(document.getElementsByName(`${prefix}testing_less`)[rowIndex]?.value) || 0;
        let rate = parseFloat(document.getElementsByName(`${prefix}rate`)[rowIndex]?.value) || 0;

        let readingDifference = closeReading - startReading;
        let netSale = readingDifference - testingLess;
        let totalAmount = netSale * rate;

        if (document.getElementsByName(`${prefix}reading_difference`)[rowIndex])
            document.getElementsByName(`${prefix}reading_difference`)[rowIndex].value = readingDifference.toFixed(2);

        if (document.getElementsByName(`${prefix}net_sale`)[rowIndex])
            document.getElementsByName(`${prefix}net_sale`)[rowIndex].value = netSale.toFixed(2);

        if (document.getElementsByName(`${prefix}total_amount`)[rowIndex])
            document.getElementsByName(`${prefix}total_amount`)[rowIndex].value = totalAmount.toFixed(2);
    }

    document.addEventListener("input", function(event) {
        let prefixes = ["xg1_", "xg2_", "ms1_", "ms2_"];
        let fields = ["start_reading", "close_reading", "testing_less", "rate"];

        prefixes.forEach(prefix => {
            fields.forEach(field => {
                document.getElementsByName(`${prefix}${field}`).forEach((input, index) => {
                    input.addEventListener("input", function() {
                        calculateValues(index, prefix);
                    });
                });
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".select-option").forEach(function (option) {
        option.addEventListener("click", function (event) {
            event.preventDefault();
            var inputId = this.getAttribute("data-input");
            var inputElement = document.getElementById(inputId);
            if (inputElement) {
                inputElement.value = this.innerText;
            }
        });
    });
});

    </script>
</body>

</html>