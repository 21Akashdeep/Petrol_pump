<?php
$servername = "localhost";
$username = "root";  
$password = "Rajukumar@21";  
$dbname = "vendors";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid rate ID.');
}
$id = intval($_GET['id']);

$sql = "SELECT * FROM liquidrate WHERE id=$id";
$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
    die('Rate not found.');
}
$row = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Liquid Rate</title>
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
        <h3 class="text-center mb-4">Edit Liquid Rate</h3>
        <form method="POST" action="../update/liquidrateupdate.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Enter Mobile - 2T Rate</label>
                <input type="text" class="form-control" name="mobile_2t_rate" value="<?= htmlspecialchars($row['mobile_2t_rate']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Enter Mobile - 1 Ltr. Rate</label>
                <input type="text" class="form-control" name="mobile_1t_rate" value="<?= htmlspecialchars($row['mobile_1t_rate']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Enter D Water 1 Ltr. Rate</label>
                <input type="text" class="form-control" name="mobile_D1_rate" value="<?= htmlspecialchars($row['mobile_D1_rate']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Enter D Water 5 Ltr. Rate</label>
                <input type="text" class="form-control" name="mobile_D5_rate" value="<?= htmlspecialchars($row['mobile_D5_rate']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
        <div class="text-center mt-3">
            <a href="../list/liquidratelist.php" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>