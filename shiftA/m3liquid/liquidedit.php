<?php
$host = "localhost";
$username = "root";
$password = "Rajukumar@21";
$database = "vendors";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM liquida3 WHERE id = $id";
$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    die("Record not found.");
}
$row = $result->fetch_assoc();

// Fetch employees for dropdown
$employees = [];
$sql_emp = "SELECT id, company_name FROM employee";
$result_emp = $conn->query($sql_emp);
if ($result_emp->num_rows > 0) {
    while ($emp = $result_emp->fetch_assoc()) {
        $employees[] = $emp;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Liquid Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body { background-color: #f8f9fa; }
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
    </style>
</head>
<body>
    <div class="contai d-flex flex-container">
        <div class="contai-box">
            <div class="containe">
                <p class="machine-info">BPT SHIFT A</p>
                <div class="machine-info">Edit Liquid</div>
                <div class="machine-info">PSN: 1295</div>
            </div>
            <form action="liquidupdate.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="row mb-3 mt-2">
                    <div class="col-12 d-flex align-items-center">
                        <label class="me-2"><strong>Date & Time:</strong></label>
                        <input type="datetime-local" class="form-control" name="datetime"
                            value="<?php echo isset($row['datetime']) ? date('Y-m-d\TH:i', strtotime($row['datetime'])) : date('Y-m-d\TH:i'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2"><strong>product</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="product1" disabled>
                            <option value="Mobile-2T" <?php if($row['product1']=="Mobile-2T") echo "selected"; ?>>Mobile-2T</option>
                            <option value="Mobile-1L" <?php if($row['product1']=="Mobile-1L") echo "selected"; ?>>Mobile-1L</option>
                            <option value="D water-1 Ltr" <?php if($row['product1']=="D water-1 Ltr") echo "selected"; ?>>D water-1 Ltr</option>
                            <option value="D water-5 Ltr" <?php if($row['product1']=="D water-5 Ltr") echo "selected"; ?>>D water-5 Ltr</option>
                        </select>
                        <input type="hidden" name="product1" value="<?php echo $row['product1']; ?>">
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="product2" disabled>
                            <option value="Mobile-2T" <?php if($row['product2']=="Mobile-2T") echo "selected"; ?>>Mobile-2T</option>
                            <option value="Mobile-1L" <?php if($row['product2']=="Mobile-1L") echo "selected"; ?>>Mobile-1L</option>
                            <option value="D water-1 Ltr" <?php if($row['product2']=="D water-1 Ltr") echo "selected"; ?>>D water-1 Ltr</option>
                            <option value="D water-5 Ltr" <?php if($row['product2']=="D water-5 Ltr") echo "selected"; ?>>D water-5 Ltr</option>
                        </select>
                        <input type="hidden" name="product2" value="<?php echo $row['product2']; ?>">
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="product3" disabled>
                            <option value="Mobile-2T" <?php if($row['product3']=="Mobile-2T") echo "selected"; ?>>Mobile-2T</option>
                            <option value="Mobile-1L" <?php if($row['product3']=="Mobile-1L") echo "selected"; ?>>Mobile-1L</option>
                            <option value="D water-1 Ltr" <?php if($row['product3']=="D water-1 Ltr") echo "selected"; ?>>D water-1 Ltr</option>
                            <option value="D water-5 Ltr" <?php if($row['product3']=="D water-5 Ltr") echo "selected"; ?>>D water-5 Ltr</option>
                        </select>
                        <input type="hidden" name="product3" value="<?php echo $row['product3']; ?>">
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="product4" disabled>
                            <option value="Mobile-2T" <?php if($row['product4']=="Mobile-2T") echo "selected"; ?>>Mobile-2T</option>
                            <option value="Mobile-1L" <?php if($row['product4']=="Mobile-1L") echo "selected"; ?>>Mobile-1L</option>
                            <option value="D water-1 Ltr" <?php if($row['product4']=="D water-1 Ltr") echo "selected"; ?>>D water-1 Ltr</option>
                            <option value="D water-5 Ltr" <?php if($row['product4']=="D water-5 Ltr") echo "selected"; ?>>D water-5 Ltr</option>
                        </select>
                        <input type="hidden" name="product4" value="<?php echo $row['product4']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2"><strong>Select Employee</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="employee1">
                            <option value="">Select Employee</option>
                            <?php foreach ($employees as $employee) { ?>
                            <option value="<?php echo $employee['company_name']; ?>"
                                <?php echo ($row['employee1'] == $employee['company_name']) ? "selected" : ""; ?>>
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
                                <?php echo ($row['employee2'] == $employee['company_name']) ? "selected" : ""; ?>>
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
                                <?php echo ($row['employee3'] == $employee['company_name']) ? "selected" : ""; ?>>
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
                                <?php echo ($row['employee4'] == $employee['company_name']) ? "selected" : ""; ?>>
                                <?php echo $employee['company_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-2"><strong>Open Reading</strong></div>
                    <div class="col-3">
                        <input type="text" class="form-control" name="xg1_start_reading" value="<?php echo $row['xg1_start_reading']; ?>" >
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="xg2_start_reading" value="<?php echo $row['xg2_start_reading']; ?>" >
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" name="ms1_start_reading" value="<?php echo $row['ms1_start_reading']; ?>" >
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" name="ms2_start_reading" value="<?php echo $row['ms2_start_reading']; ?>" >
                    </div>
                </div>
                <?php
                $fields = ["Close Reading", "Net Sale", "Rate", "Total Amount"];
                foreach ($fields as $field) {
                    $field_key = strtolower(str_replace(" ", "_", $field));
                    echo '<div class="row mb-2">
                            <div class="col-2">' . $field . '</div>
                            <div class="col-3">
                                <input type="text" class="form-control" name="xg1_' . $field_key . '" value="' . (isset($row['xg1_' . $field_key]) ? $row['xg1_' . $field_key] : "") . '">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="xg2_' . $field_key . '" value="' . (isset($row['xg2_' . $field_key]) ? $row['xg2_' . $field_key] : "") . '">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="ms1_' . $field_key . '" value="' . (isset($row['ms1_' . $field_key]) ? $row['ms1_' . $field_key] : "") . '">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" name="ms2_' . $field_key . '" value="' . (isset($row['ms2_' . $field_key]) ? $row['ms2_' . $field_key] : "") . '">
                            </div>
                        </div>';
                }
                ?>
                <button type="submit" class="btn btn-submit mt-3">Update</button>
                <a href="liquidlist.php" class="btn btn-secondary mt-3">Cancel</a>
            </form>
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