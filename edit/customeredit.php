<?php
$servername = "localhost";
$username = "root"; // change if needed
$password = "Rajukumar@21"; // change if needed
$dbname = "vendors"; // change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and get customer ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid customer ID.');
}
$id = intval($_GET['id']);

// Fetch customer data
$sql = "SELECT * FROM customer WHERE id=$id";
$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
    die('Customer not found.');
}
$row = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
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
        <h3 class="text-center mb-4">Edit Customer</h3>
        <form method="post" action="../update/customerupdate.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" class="form-control" name="company_name"
                    value="<?= htmlspecialchars($row['company_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">GST No.</label>
                <input type="number" class="form-control" name="gst_no" value="<?= htmlspecialchars($row['gst_no']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Pan No.</label>
                <input type="text" class="form-control" name="pan_no" value="<?= htmlspecialchars($row['pan_no']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Contact No.</label>
                <input type="tel" class="form-control" name="contact_no"
                    value="<?= htmlspecialchars($row['contact_no']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Person No.</label>
                <input type="tel" class="form-control" name="contact_person_no"
                    value="<?= htmlspecialchars($row['contact_person_no']) ?>">
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
        <div class="text-center mt-3">
            <a href="index.html" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>