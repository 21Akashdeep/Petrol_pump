<?php
$host = "localhost";
$username = "root";
$password = "Rajukumar@21";
$database = "vendors";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employee list
$employees = [];
$sql = "SELECT id, company_name FROM employee";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee1 = $_POST['employee1'];
    $employee2 = $_POST['employee2'];
    $employee3 = $_POST['employee3'];
    $employee4 = $_POST['employee4'];
    $product1 = $_POST['product1'];
    $product2 = $_POST['product2'];
    $product3 = $_POST['product3'];
    $product4 = $_POST['product4'];
    $xg1_start_reading = $_POST['xg1_start_reading'];
    $xg2_start_reading = $_POST['xg2_start_reading'];
    $ms1_start_reading = $_POST['ms1_start_reading'];
    $ms2_start_reading = $_POST['ms2_start_reading'];
    $xg1_close_reading = $_POST['xg1_close_reading'];
    $xg2_close_reading = $_POST['xg2_close_reading'];
    $ms1_close_reading = $_POST['ms1_close_reading'];
    $ms2_close_reading = $_POST['ms2_close_reading'];
    $xg1_net_sale = $_POST['xg1_net_sale'];
    $xg2_net_sale = $_POST['xg2_net_sale'];
    $ms1_net_sale = $_POST['ms1_net_sale'];
    $ms2_net_sale = $_POST['ms2_net_sale'];
    $xg1_rate = $_POST['xg1_rate'];
    $xg2_rate = $_POST['xg2_rate'];
    $ms1_rate = $_POST['ms1_rate'];
    $ms2_rate = $_POST['ms2_rate'];
    $xg1_total_amount = $_POST['xg1_total_amount'];
    $xg2_total_amount = $_POST['xg2_total_amount'];
    $ms1_total_amount = $_POST['ms1_total_amount'];
    $ms2_total_amount = $_POST['ms2_total_amount'];
    $datetime = $_POST['datetime'];

    $sql = "UPDATE liquidb2 SET 
        employee1=?, employee2=?, employee3=?, employee4=?,
        product1=?, product2=?, product3=?, product4=?,
        xg1_start_reading=?, xg2_start_reading=?, ms1_start_reading=?, ms2_start_reading=?,
        xg1_close_reading=?, xg2_close_reading=?, ms1_close_reading=?, ms2_close_reading=?,
        xg1_net_sale=?, xg2_net_sale=?, ms1_net_sale=?, ms2_net_sale=?,
        xg1_rate=?, xg2_rate=?, ms1_rate=?, ms2_rate=?,
        xg1_total_amount=?, xg2_total_amount=?, ms1_total_amount=?, ms2_total_amount=?,
        datetime=?
        WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssssssssssssssssssi",
        $employee1,
        $employee2,
        $employee3,
        $employee4,
        $product1,
        $product2,
        $product3,
        $product4,
        $xg1_start_reading,
        $xg2_start_reading,
        $ms1_start_reading,
        $ms2_start_reading,
        $xg1_close_reading,
        $xg2_close_reading,
        $ms1_close_reading,
        $ms2_close_reading,
        $xg1_net_sale,
        $xg2_net_sale,
        $ms1_net_sale,
        $ms2_net_sale,
        $xg1_rate,
        $xg2_rate,
        $ms1_rate,
        $ms2_rate,
        $xg1_total_amount,
        $xg2_total_amount,
        $ms1_total_amount,
        $ms2_total_amount,
        $datetime,
        $id
    );
    $stmt->execute();
    $stmt->close();
    header("Location: liquidlist.php");
    exit;
}

// Fetch current data
$sql = "SELECT * FROM liquidb2 WHERE id=$id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
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
        <div class="machine-info">BPT SHIFT B</div>
        <div class="machine-info">Edit Liquid Entry</div>
        <form method="POST">
            <div class="row mb-3 mt-2">
                <div class="col-12 d-flex align-items-center">
                    <label class="me-2"><strong>Date & Time:</strong></label>
                    <input type="datetime-local" class="form-control" name="datetime"
                        value="<?php echo isset($row['datetime']) && $row['datetime'] ? date('Y-m-d\TH:i', strtotime($row['datetime'])) : date('Y-m-d\TH:i'); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2"><strong>Product</strong></div>
                <div class="col-3">
                    <input type="text" class="form-control" name="product1" value="<?php echo $data['product1']; ?>" readonly>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="product2" value="<?php echo $data['product2']; ?>" readonly>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="product3" value="<?php echo $data['product3']; ?>" readonly>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" name="product4" value="<?php echo $data['product4']; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2"><strong>Select Employee</strong></div>
                <div class="col-3">
                    <select class="form-select" name="employee1">
                        <option value="">Select Employee</option>
                        <?php foreach ($employees as $employee) { ?>
                        <option value="<?php echo $employee['company_name']; ?>"
                            <?php echo ($data['employee1'] == $employee['company_name']) ? "selected" : ""; ?>>
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
                            <?php echo ($data['employee2'] == $employee['company_name']) ? "selected" : ""; ?>>
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
                            <?php echo ($data['employee3'] == $employee['company_name']) ? "selected" : ""; ?>>
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
                            <?php echo ($data['employee4'] == $employee['company_name']) ? "selected" : ""; ?>>
                            <?php echo $employee['company_name']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-2"><strong>Open Reading</strong></div>
                <div class="col-3">
                    <input type="text" class="form-control" name="xg1_start_reading" value="<?php echo $data['xg1_start_reading']; ?>" readonly>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="xg2_start_reading" value="<?php echo $data['xg2_start_reading']; ?>" readonly>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" name="ms1_start_reading" value="<?php echo $data['ms1_start_reading']; ?>" readonly>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" name="ms2_start_reading" value="<?php echo $data['ms2_start_reading']; ?>" readonly>
                </div>
            </div>
            <?php
            $fields = ["Close Reading", "Net Sale", "Rate", "Total Amount"];
            foreach ($fields as $field) {
                $field_key = strtolower(str_replace(" ", "_", $field));
                echo '<div class="row mb-2">
                        <div class="col-2">' . $field . '</div>
                        <div class="col-3">
                            <input type="text" class="form-control" name="xg1_' . $field_key . '" value="' . (isset($data['xg1_' . $field_key]) ? $data['xg1_' . $field_key] : "") . '">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" name="xg2_' . $field_key . '" value="' . (isset($data['xg2_' . $field_key]) ? $data['xg2_' . $field_key] : "") . '">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" name="ms1_' . $field_key . '" value="' . (isset($data['ms1_' . $field_key]) ? $data['ms1_' . $field_key] : "") . '">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" name="ms2_' . $field_key . '" value="' . (isset($data['ms2_' . $field_key]) ? $data['ms2_' . $field_key] : "") . '">
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