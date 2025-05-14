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
$sql = "SELECT * FROM liquidb1 WHERE id = $id";
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
    body {
        background-color: #f8f9fa;
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
    .btn-submit {
        background: #ff6200;
        color: white;
        font-weight: bold;
        width: 100%;
    }
    </style>
</head>
<body>
    <div class="contai-box">
        <div class="machine-info">BPT SHIFT A</div>
        <div class="machine-info">Edit Liquid Entry</div>
        <form action="liquidupdate.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="row mb-3 mt-2">
                <div class="col-12 d-flex align-items-center">
                    <label class="me-2"><strong>Date & Time:</strong></label>
                    <input type="datetime-local" class="form-control" name="datetime"
                        value="<?php echo isset($row['shifta1_datetime']) ? date('Y-m-d\TH:i', strtotime($row['shifta1_datetime'])) : date('Y-m-d\TH:i'); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2"><strong>Product</strong></div>
                <div class="col-3">
                    <input type="text" class="form-control" name="product1" value="<?php echo $row['product1']; ?>" readonly>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="product2" value="<?php echo $row['product2']; ?>" readonly>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="product3" value="<?php echo $row['product3']; ?>" readonly>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" name="product4" value="<?php echo $row['product4']; ?>" readonly>
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
                    <input type="text" class="form-control" name="xg1_start_reading" value="<?php echo $row['xg1_start_reading']; ?>" readonly>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="xg2_start_reading" value="<?php echo $row['xg2_start_reading']; ?>" readonly>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="ms1_start_reading" value="<?php echo $row['ms1_start_reading']; ?>" readonly>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" name="ms2_start_reading" value="<?php echo $row['ms2_start_reading']; ?>" readonly>
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
</body>
</html>