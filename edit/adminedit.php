<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "Rajukumar@21";  // Change if needed
$dbname = "vendors";  // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get admin ID and fetch data
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid admin ID.');
}
$id = intval($_GET['id']);

$sql = "SELECT * FROM adminsignup WHERE id=$id";
$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
    die('Admin not found.');
}
$row = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
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
        <h3 class="text-center mb-4">Update Admin</h3>
        <form method="POST" action="../update/adminupdate.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username"
                    value="<?= htmlspecialchars($row['username']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone No.</label>
                <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($row['phone']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Id</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row['email']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Aadhaar</label>
                <input type="text" class="form-control" name="aadhaar" value="<?= htmlspecialchars($row['aadhaar']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password"
                    value="<?= htmlspecialchars($row['password']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
        <div class="text-center mt-3">
            <a href="../list/adminlist.php" class="btn btn-outline-secondary">Back to List</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>