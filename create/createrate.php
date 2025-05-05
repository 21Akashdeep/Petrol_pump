<?php
$servername = "localhost";
$username = "root";  
$password = "Rajukumar@21";  
$dbname = "vendors";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ms_rate = mysqli_real_escape_string($conn, $_POST['ms_rate']);
    $xp95_rate = mysqli_real_escape_string($conn, $_POST['xp95_rate']);
    $hsd_rate = mysqli_real_escape_string($conn, $_POST['hsd_rate']);
    $hd_rate = mysqli_real_escape_string($conn, $_POST['hd_rate']);

    $sql = "INSERT INTO rate (ms_rate, xp95_rate, hsd_rate, hd_rate) 
            VALUES ('$ms_rate', '$xp95_rate', '$hsd_rate', '$hd_rate')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Rates added successfully!');
                window.location.href='../list/ratelist.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $conn->error . "');
              </script>";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Vendor</title>
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
        <h3 class="text-center mb-4"> Rate</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Enter Ms Rate</label>
                <input type="text" class="form-control" placeholder="Enter ms rate"name="ms_rate">
            </div>
            <div class="mb-3">
                <label class="form-label">Enter xp-95 Rate</label>
                <input type="text" class="form-control" placeholder="Enter ms rate"name="xp95_rate">
            </div><div class="mb-3">
                <label class="form-label">Enter HSD Rate</label>
                <input type="text" class="form-control" placeholder="Enter ms rate"name="hsd_rate">
            </div><div class="mb-3">
                <label class="form-label">Enter HD Rate</label>
                <input type="text" class="form-control" placeholder="Enter ms rate"name="hd_rate">
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
        <div class="text-center mt-3">
            <a href="index.html" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
