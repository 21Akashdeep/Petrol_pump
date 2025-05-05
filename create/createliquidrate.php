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
    $mobile_2t_rate = mysqli_real_escape_string($conn, $_POST['mobile_2t_rate']);
    $mobile_1t_rate = mysqli_real_escape_string($conn, $_POST['mobile_1t_rate']);
    $mobile_D1_rate = mysqli_real_escape_string($conn, $_POST['mobile_D1_rate']);
    $mobile_D5_rate = mysqli_real_escape_string($conn, $_POST['mobile_D5_rate']);

    $sql = "INSERT INTO liquidrate (mobile_2t_rate, mobile_1t_rate, mobile_D1_rate, mobile_D5_rate) 
            VALUES ('$mobile_2t_rate', '$mobile_1t_rate', '$mobile_D1_rate', '$mobile_D5_rate')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Rates added successfully!');
                window.location.href='../list/liquidratelist.php';
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
                <label class="form-label">Enter Mobile - 2T Rate</label>
                <input type="text" class="form-control" placeholder="Enter ms rate"name="mobile_2t_rate">
            </div>
            <div class="mb-3">
                <label class="form-label">Enter  Mobile - 1 Ltr. Rate</label>
                <input type="text" class="form-control" placeholder="Enter ms rate"name="mobile_1t_rate">
            </div><div class="mb-3">
                <label class="form-label">Enter D Water 1 Ltr. Rate</label>
                <input type="text" class="form-control" placeholder="Enter ms rate"name="mobile_D1_rate">
            </div><div class="mb-3">
                <label class="form-label">Enter D Water 5 Ltr. Rate</label>
                <input type="text" class="form-control" placeholder="Enter ms rate"name="mobile_D5_rate">
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
