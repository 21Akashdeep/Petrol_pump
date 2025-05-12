<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "Rajukumar@21";  // Change if needed
$dbname = "vendors";  // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid employee ID.');
}
$id = intval($_GET['id']);

$sql = "SELECT * FROM employee WHERE id=$id";
$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
    die('Employee not found.');
}
$row = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 3%;
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <h3 class="text-center mb-4">Edit Employee</h3>
        <form method="POST" action="../update/employeeupdate.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Employee Name</label>
                <input type="text" class="form-control" name="company_name" value="<?= htmlspecialchars($row['company_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pan No.</label>
                <input type="text" class="form-control" name="pan_no" value="<?= htmlspecialchars($row['pan_no']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact No.</label>
                <input type="tel" class="form-control" name="contact_no" value="<?= htmlspecialchars($row['contact_no']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
        <div class="text-center mt-3">
            <a href="../list/employeelist.php" class="btn btn-outline-secondary">Back to List</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>