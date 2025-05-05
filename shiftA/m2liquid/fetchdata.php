<?php
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default values (fetch latest entry)
$Datetime = date('Y-m-d H:i:s');
$Select_Employee1 = "";
$Select_Employee2 = "";
$Select_Liquid1 = "";
$Select_Liquid2 = "";
$Opening_QTY1 = "";
$Opening_QTY2 = "";
$Sale1 = "";
$Sale2 = "";
$Sale_AMT1 = "";
$Sale_AMT2 = "";
$Closing_QTY1 = "";
$Closing_QTY2 = "";

// Fetch latest entry
$sql_fetch = "SELECT * FROM liquid ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql_fetch);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Datetime = $row['Datetime'];
    $Select_Employee1 = $row['Select_Employee1'];
    $Select_Employee2 = $row['Select_Employee2'];
    $Select_Liquid1 = $row['Select_Liquid1'];
    $Select_Liquid2 = $row['Select_Liquid2'];
    $Opening_QTY1 = $row['Opening_QTY1'];
    $Opening_QTY2 = $row['Opening_QTY2'];
    $Sale1 = $row['Sale1'];
    $Sale2 = $row['Sale2'];
    $Sale_AMT1 = $row['Sale_AMT1'];
    $Sale_AMT2 = $row['Sale_AMT2'];
    $Closing_QTY1 = $row['Closing_QTY1'];
    $Closing_QTY2 = $row['Closing_QTY2'];
}

// Insert data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Datetime = $_POST['Datetime'];
    $Select_Employee1 = $_POST['Select_Employee1'];
    $Select_Employee2 = $_POST['Select_Employee2'];
    $Select_Liquid1 = $_POST['Select_Liquid1'];
    $Select_Liquid2 = $_POST['Select_Liquid2'];
    $Opening_QTY1 = $_POST['Opening_QTY1'];
    $Opening_QTY2 = $_POST['Opening_QTY2'];
    $Sale1 = $_POST['Sale1'];
    $Sale2 = $_POST['Sale2'];
    $Sale_AMT1 = $_POST['Sale_AMT1'];
    $Sale_AMT2 = $_POST['Sale_AMT2'];
    $Closing_QTY1 = $_POST['Closing_QTY1'];
    $Closing_QTY2 = $_POST['Closing_QTY2'];

    $sql_insert = "INSERT INTO liquid (Datetime, Select_Employee1, Select_Employee2, Select_Liquid1, Select_Liquid2, 
                                       Opening_QTY1, Opening_QTY2, Sale1, Sale2, Sale_AMT1, Sale_AMT2, Closing_QTY1, Closing_QTY2) 
                   VALUES ('$Datetime', '$Select_Employee1', '$Select_Employee2', '$Select_Liquid1', '$Select_Liquid2', 
                           '$Opening_QTY1', '$Opening_QTY2', '$Sale1', '$Sale2', '$Sale_AMT1', '$Sale_AMT2', '$Closing_QTY1', '$Closing_QTY2')";

if ($conn->query($sql_insert) === TRUE) {
    echo "<script>alert('Data inserted successfully!'); window.location.href='".$_SERVER['PHP_SELF']."';</script>";
    exit();
} else {
    echo "<script>alert('Error: " . $conn->error . "');</script>";
}
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Data Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            width: 50%;
        }
        .machine-info {
            background: #ff6200;
            color: white;
            padding: 5px 10px;
            text-align: left;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 10px;
            width: auto;
            font-size: 12px;
            display: inline-block;
        }
        .btn-submit {
            background: #ff6200 !important;
            color: white;
            font-weight: bold;
            width: 30%;
            display: block;
            margin: 20px auto;
            padding: 5px;
            font-size: 14px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container-box">
            <div class="machine-info">Add Liquid</div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label"><strong>Date & Time:</strong></label>
                    <input type="text" class="form-control" name="Datetime" value="<?php echo $Datetime; ?>" readonly>
                </div>
                <div class="mb-3 row">
                    <label class="col-4"><strong>Select Employee</strong></label>
                    <div class="col-4">
                        <input type="text" class="form-control" name="Select_Employee1" value="<?php echo $Select_Employee1; ?>">
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="Select_Employee2" value="<?php echo $Select_Employee2; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4"><strong>Select Liquid</strong></label>
                    <div class="col-4">
                        <input type="text" class="form-control" name="Select_Liquid1" value="<?php echo $Select_Liquid1; ?>">
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="Select_Liquid2" value="<?php echo $Select_Liquid2; ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4">Opening QTY</label>
                    <div class="col-4"><input type="number" class="form-control" name="Opening_QTY1" value="<?php echo $Opening_QTY1; ?>"></div>
                    <div class="col-4"><input type="number" class="form-control" name="Opening_QTY2" value="<?php echo $Opening_QTY2; ?>"></div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4">Sale</label>
                    <div class="col-4"><input type="number" class="form-control" name="Sale1" value="<?php echo $Sale1; ?>"></div>
                    <div class="col-4"><input type="number" class="form-control" name="Sale2" value="<?php echo $Sale2; ?>"></div>
                </div>
                <div class="mb-3 row">
                    <label class="col-4">Sale AMT</label>
                    <div class="col-4"><input type="number" class="form-control" name="Sale_AMT1" value="<?php echo $Sale_AMT1; ?>"></div>
                    <div class="col-4"><input type="number" class="form-control" name="Sale_AMT2" value="<?php echo $Sale_AMT2; ?>"></div>
                </div>
                <button type="submit" class="btn btn-submit">SUBMIT</button>
            </form>
        </div>
    </div>
</body>
</html>
