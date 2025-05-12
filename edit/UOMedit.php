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
    die('Invalid UOM ID.');
}
$id = intval($_GET['id']);

$sql = "SELECT * FROM UOM WHERE id=$id";
$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
    die('UOM not found.');
}
$row = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit UOM</title>
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
        <h3 class="text-center mb-4">Edit UOM</h3>
        <form method="POST" action="../update/UOMupdate.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label class="form-label">UOM Name</label>
                <input type="text" class="form-control" name="UOM" value="<?= htmlspecialchars($row['UOM']) ?>"
                    required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
        <div class="text-center mt-3">
            <a href="../list/UOMlist.php" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>