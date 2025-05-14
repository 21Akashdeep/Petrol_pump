<?php
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("Invalid ID.");
}

// Fetch employees
$employees = [];
$sql = "SELECT id, company_name FROM employee";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Fetch existing collection data
$sql = "SELECT * FROM Collectiona2 WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Record not found.");
}
$data = $result->fetch_assoc();

date_default_timezone_set('Asia/Kolkata');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Collection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 450px;
        }
        .header {
            background: #ff6600;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: left;
            font-weight: bold;
            font-size: 16px;
            width: fit-content;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 5px;
        }
        select,
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .row select,
        .row input {
            flex: 1;
        }
        input::placeholder {
            color: #777;
            font-weight: normal;
        }
        .submit-btn {
            background: #ff6600;
            color: white;
            border: none;
            padding: 8px 15px;
            width: auto;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 15px auto 0;
        }
        .submit-btn:hover {
            background: #e65c00;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="m2collectionupdate.php">
            <div class="header">Edit Collection</div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label>Date & Time:</label>
            <input type="datetime-local" name="Date_And_Time" required value="<?php echo date('Y-m-d\TH:i', strtotime($data['Date_And_Time'])); ?>">

            <label>Select Employee</label>
            <div class="row mb-3">
                <div class="col-4"><strong>Select Employee</strong></div>
                <div class="col-4">
                    <select class="form-select" name="shifta1_emp1" required>
                        <option value="">Select Employee</option>
                        <?php foreach ($employees as $employee) { ?>
                        <option value="<?php echo $employee['company_name']; ?>"
                            <?php echo ($data['Employee_Name1'] == $employee['company_name']) ? "selected" : ""; ?>>
                            <?php echo $employee['company_name']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-select" name="shifta1_emp2" required>
                        <option value="">Select Employee</option>
                        <?php foreach ($employees as $employee) { ?>
                        <option value="<?php echo $employee['company_name']; ?>"
                            <?php echo ($data['Employee_Name2'] == $employee['company_name']) ? "selected" : ""; ?>>
                            <?php echo $employee['company_name']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <label>Collection Name</label>
            <div class="row">
                <input type="text" placeholder="Enter Collection Name 1" name="Collection_Name1" required value="<?php echo htmlspecialchars($data['Collection_Name1']); ?>">
                <input type="text" placeholder="Enter Collection Name 2" name="Collection_Name2" required value="<?php echo htmlspecialchars($data['Collection_Name2']); ?>">
            </div>

            <label>Amount</label>
            <div class="row">
                <input type="number" placeholder="Amount 1" name="Amount1" required value="<?php echo htmlspecialchars($data['Amount1']); ?>">
                <input type="number" placeholder="Amount 2" name="Amount2" required value="<?php echo htmlspecialchars($data['Amount2']); ?>">
            </div>

            <button type="submit" class="submit-btn">UPDATE</button>
        </form>
    </div>
</body>
</html>