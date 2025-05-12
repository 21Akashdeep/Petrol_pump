<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "Rajukumar@21";  // Change if needed
$dbname = "vendors";  // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $aadhaar = $_POST['aadhaar'];
    $password = $_POST['password'];

    $sql = "INSERT INTO adminsignup (username, phone, email, aadhaar, password) 
            VALUES ('$username', '$phone', '$email', '$aadhaar', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Admin added successfully!');
            window.location.href='../list/adminlist.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: " . $conn->error . "');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container {
            margin-top: 3%;
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center mb-4">Create Admin</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone No.</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter phone number" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Id</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Aadhaar</label>
                <input type="text" class="form-control" name="aadhaar" placeholder="Enter Aadhaar number" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
        <div class="text-center mt-3">
            <a href="../list/adminlist.php" class="btn btn-outline-secondary">Back to List</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>