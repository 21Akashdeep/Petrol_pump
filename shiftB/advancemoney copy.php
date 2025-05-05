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
    $advancec = $_POST['advancec'];
    

    $sql = "INSERT INTO advancec (advancec) 
            VALUES ('$advancec')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Vendor added successfully!');
            window.location.href='mainshiftC.php'; // Redirect to dashboard or another page
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
        <!-- <h3 class="text-center mb-4"> Create Vender</h3> -->
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Advance money</label>
                <input type="text" class="form-control" placeholder="enter advance"name="advancec">
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
        <!-- <div class="text-center mt-3">
            <a href="index.html" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
