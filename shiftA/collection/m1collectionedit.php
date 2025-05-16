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
$sql = "SELECT * FROM Collection WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows != 1) {
    die("Record not found.");
}
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Date_And_Time = $_POST['Date_And_Time'];
    $Employee_Name1 = $_POST['shifta1_emp1'];
    $Employee_Name2 = $_POST['shifta1_emp2'];
    $Collection_Name1 = $_POST['Collection_Name1'];
    $Collection_Name2 = $_POST['Collection_Name2'];
    $Amount1 = $_POST['Amount1'];
    $Amount2 = $_POST['Amount2'];

    $sql = "UPDATE Collection SET 
        Date_And_Time = '$Date_And_Time',
        Employee_Name1 = '$Employee_Name1',
        Employee_Name2 = '$Employee_Name2',
        Collection_Name1 = '$Collection_Name1',
        Collection_Name2 = '$Collection_Name2',
        Amount1 = '$Amount1',
        Amount2 = '$Amount2'
        WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data updated successfully!'); window.location.href='m1collectionReport.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
    }
}

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
     footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #212529;
            color: #6c757d;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
        }

        footer a.brand {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        footer a.brand:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <div class="header">Edit Collection</div>

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
      <footer>
        <p><strong>Copyright © 2025 <a href="https://pcats.co.in/" class="brand" target="_blank">P-Cats,
                    Jamshedpur</a>.</strong> All
            rights reserved.</p>
    </footer>
</body>
</html>