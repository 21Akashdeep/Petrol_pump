<?php
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

// Database Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form Data Processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expense_name = $_POST['expense_name'];
    $vehicle_numbers = $_POST['vehicle_number']; // Array of vehicle numbers
    $amounts = $_POST['amount']; // Array of amounts

    // Loop through each vehicle number and insert separately
    for ($i = 0; $i < count($vehicle_numbers); $i++) {
        $vehicle_number = $conn->real_escape_string($vehicle_numbers[$i]);
        $amount = $conn->real_escape_string($amounts[$i]);

        $sql = "INSERT INTO expensea2 (expense_name, amount, vehicle_number) 
                VALUES ('$expense_name', '$amount', '$vehicle_number')";

        if (!$conn->query($sql)) {
            echo "Error: " . $conn->error;
        }
    }

    echo "<script>alert('Expense Added Successfully'); window.location.href='explist.php';</script>";
}

// Close Connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
            background: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h5 class="text-center">Expense Form</h5>
        <form action="" method="POST">
            <input type="text" name="expense_name" class="form-control form-control-sm mb-2" placeholder="Expense Name" required>

            <div id="vehicleFields">
                <div class="vehicle-group">
                    <input type="text" name="vehicle_number[]" class="form-control form-control-sm mb-2" placeholder="Vehicle Number">
                    <input type="number" name="amount[]" class="form-control form-control-sm mb-2" placeholder="Amount">
                </div>
            </div>
            
            <button type="button" class="btn btn-success btn-sm mb-2" id="addVehicle">+ Add More</button>
            <button type="submit" class="btn btn-primary btn-sm w-100">Submit</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#addVehicle").click(function () {
            if ($(".vehicle-group").length < 5) { 
                $("#vehicleFields").append(`
                    <div class="vehicle-group">
                        <input type="text" name="vehicle_number[]" class="form-control form-control-sm mb-2" placeholder="Vehicle Number" required>
                        <input type="number" name="amount[]" class="form-control form-control-sm mb-2" placeholder="Amount" required>
                    </div>
                `);
            } else {
                alert("You can add only 5 vehicle numbers!");
            }
        });
    });
</script>

</body>
</html>


