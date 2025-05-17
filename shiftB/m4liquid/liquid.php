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
$sql = "SELECT * FROM liquidb4 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$latestData = $result->fetch_assoc(); // Fetch data as an associative array

// Fetch latest Shift C close reading
$sql_shiftC = "SELECT xg1_close_reading FROM liquida4 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_xg1_reading = isset($shiftC_data['xg1_close_reading']) ? $shiftC_data['xg1_close_reading'] : "";


$sql_shiftC = "SELECT xg2_close_reading FROM liquida4 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_xg2_reading = isset($shiftC_data['xg2_close_reading']) ? $shiftC_data['xg2_close_reading'] : "";

$sql_shiftC = "SELECT ms1_close_reading FROM liquida4 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_ms1_reading = isset($shiftC_data['ms1_close_reading']) ? $shiftC_data['ms1_close_reading'] : "";

$sql_shiftC = "SELECT ms2_close_reading FROM liquida4 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_ms2_reading = isset($shiftC_data['ms2_close_reading']) ? $shiftC_data['ms2_close_reading'] : "";

// Fetch latest Shift A entry (if needed)
$sql_shiftA = "SELECT * FROM liquidb4 ORDER BY id DESC LIMIT 1";
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
        width: 35%;
        margin: 10px;
    }

    .contai-box {
        background: white;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);

        margin: 5%;
        margin-left: 15%;
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


    <div class="contai d-flex flex-container">
        <!-- <div class="row mt-3">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-danger" onclick="resetForm()">Reset</button>
            </div>
        </div> -->
        <script>
        function resetForm() {
            // Select all input and select fields except the opening readings
            document.querySelectorAll(
                    'input:not([name="xg1_start_reading"]):not([name="xg2_start_reading"]):not([name="ms1_start_reading"]):not([name="ms2_start_reading"]), select'
                )
                .forEach(field => {
                    if (field.tagName === 'INPUT') {
                        field.value = ''; // Clear input fields
                    } else if (field.tagName === 'SELECT') {
                        field.selectedIndex = 0; // Reset select dropdowns
                    }
                });
        }
        </script>
        <div class="contai-box">
            <div class="containe">
                <p class="machine-info">BPT SHIFT A</p>
                <div class="machine-info">Add Liquid</div>
                <div class="machine-info">PSN: 1295</div>
            </div>

            <form action="liquiddb.php" method="POST">
                <div class="row mb-3 mt-2">
                    <div class="col-12 d-flex align-items-center">
                        <label class="me-2"><strong>Date & Time:</strong></label>
                        <input type="datetime-local" class="form-control" name="datetime"
                            value="<?php echo isset($latestData['shifta1_datetime']) ? date('Y-m-d\TH:i', strtotime($latestData['shifta1_datetime'])) : date('Y-m-d\TH:i'); ?>">
                    </div>


                </div>


                <div class="row mb-3">
                    <div class="col-2"><strong>product</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="product1"disabled>
                            <option value="Mobile-2T" selected>Mobile-2T</option>
                            <option value="Mobile-1L">Mobile-1L</option>
                            <option value="D water-1 Ltr">D water-1 Ltr</option>
                            <option value="D water-5 Ltr">D water-5 Ltr</option>
                        </select>
                        <input type="hidden" name="product1" value="Mobile-2T">

                    </div>
                    <div class="col-2">
                        <select class="form-select" name="product2"disabled>
                        <option value="Mobile-2T" >Mobile-2T</option>
                            <option value="Mobile-1L"selected>Mobile-1L</option>
                            <option value="D water-1 Ltr">D water-1 Ltr</option>
                            <option value="D water-5 Ltr">D water-5 Ltr</option>
                        </select>
                        <input type="hidden" name="product2" value="Mobile-1L">

                    </div>
                    <div class="col-2">
                        <select class="form-select" name="product3"disabled>
                        <option value="Mobile-2T" >Mobile-2T</option>
                            <option value="Mobile-1L">Mobile-1L</option>
                            <option value="D water-1 Ltr"selected>D water-1 Ltr</option>
                            <option value="D water-5 Ltr">D water-5 Ltr</option>
                        </select>
                        <input type="hidden" name="product3" value="D water-1 Ltr">

                    </div>
                    <div class="col-3">
                        <select class="form-select" name="product4"disabled>
                        <option value="Mobile-2T" >Mobile-2T</option>
                            <option value="Mobile-1L">Mobile-1L</option>
                            <option value="D water-1 Ltr">D water-1 Ltr</option>
                            <option value="D water-5 Ltr"selected>D water-5 Ltr</option>
                        </select>
                        <input type="hidden" name="product4" value="D water-5 Ltr">

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


                <div class="row mb-2">
                    <div class="col-2"><strong>Open Reading</strong></div>
                    <div class="col-3">
                        <input type="text" class="form-control" name="xg1_start_reading" id="xg1_start_reading"
                            value="<?php echo $shiftC_close_xg1_reading; ?>" >
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="xg2_start_reading" id="xg2_start_reading"
                            value="<?php echo $shiftC_close_xg2_reading; ?>" >
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="ms1_start_reading" id="ms1_start_reading"
                            value="<?php echo $shiftC_close_ms1_reading; ?>" >
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" name="ms2_start_reading" id="ms2_start_reading"
                            value="<?php echo $shiftC_close_ms2_reading; ?>" >
                    </div>
                </div>
                <?php
                    $fields = ["Close Reading", "Net Sale", "Rate", "Total Amount"];

                    foreach ($fields as $field) {
                        echo '<div class="row mb-2">
                                <div class="col-2">' . $field . '</div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="xg1_' . strtolower(str_replace(" ", "_", $field)) . '_' . $field . '"
                                    name="xg1_' . strtolower(str_replace(" ", "_", $field)) . '" 
                                    value="' . (isset($latestData['xg1_' . strtolower(str_replace(" ", "_", $field))]) ? $latestData['xg1_' . strtolower(str_replace(" ", "_", $field))] : "") . '">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="xg2_' . strtolower(str_replace(" ", "_", $field)) . '_' . $field . '"  
                                    name="xg2_' . strtolower(str_replace(" ", "_", $field)) . '" 
                                    value="' . (isset($latestData['xg2_' . strtolower(str_replace(" ", "_", $field))]) ? $latestData['xg2_' . strtolower(str_replace(" ", "_", $field))] : "") . '">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="ms1_' . strtolower(str_replace(" ", "_", $field)) . '_' . $field . '" 
                                    name="ms1_' . strtolower(str_replace(" ", "_", $field)) . '" 
                                    value="' . (isset($latestData['ms1_' . strtolower(str_replace(" ", "_", $field))]) ? $latestData['ms1_' . strtolower(str_replace(" ", "_", $field))] : "") . '">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="ms2_' . strtolower(str_replace(" ", "_", $field)) . '_' . $field . '"  
                                    name="ms2_' . strtolower(str_replace(" ", "_", $field)) . '" 
                                    value="' . (isset($latestData['ms2_' . strtolower(str_replace(" ", "_", $field))]) ? $latestData['ms2_' . strtolower(str_replace(" ", "_", $field))] : "") . '">
                                </div>
                            </div>';
                    }
                ?>



                <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
            </form>
            <!-- <div class="row">
                <div class="col-3">
                    <a href="moneycash/m4moneyreport.php" class="">Add cash</a>
                </div>
                <div class="col-3">
                    <a href="m4liquid/liquidlist.php" class="">Add Liquid</a>

                </div>
                <div class="col-3">
                    <a href="m4expense/report.html" class="">Expenses</a>

                </div>
                <div class="col-3">
                    <a href="collection/m4collectionreport.php" class="">Collection</a>

                </div>

            </div> -->
            <!-- <a href='liquidedit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
            <a href='liquiddelete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm("Are you sure you want to delete?")'>Delete</a> -->
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
    </script>



</body>

</html>