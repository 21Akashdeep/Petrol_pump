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

$sql = "SELECT * FROM rate WHERE id=$id";
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
    <title>Edit Rate</title>
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
        <h3 class="text-center mb-4">Edit Rate</h3>
        <form method="POST" action="../update/rateupdate.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Enter Ms Rate</label>
                <input type="text" class="form-control" name="ms_rate" value="<?= htmlspecialchars($row['ms_rate']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Enter xp-95 Rate</label>
                <input type="text" class="form-control" name="xp95_rate"
                    value="<?= htmlspecialchars($row['xp95_rate']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Enter HSD Rate</label>
                <input type="text" class="form-control" name="hsd_rate"
                    value="<?= htmlspecialchars($row['hsd_rate']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Enter HD Rate</label>
                <input type="text" class="form-control" name="hd_rate" value="<?= htmlspecialchars($row['hd_rate']) ?>"
                    required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
        <div class="text-center mt-3">
            <a href="../list/ratelist.php" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>