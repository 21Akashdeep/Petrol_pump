
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $Date_And_Time = isset($_POST['Date_And_Time']) ? $_POST['Date_And_Time'] : '';
    $Employee_Name1 = isset($_POST['Employee_Name1']) ? $_POST['Employee_Name1'] : '';
    $Employee_Name2 = isset($_POST['Employee_Name2']) ? $_POST['Employee_Name2'] : '';
    $Collection_Name1 = isset($_POST['Collection_Name1']) ? $_POST['Collection_Name1'] : '';
    $Collection_Name2 = isset($_POST['Collection_Name2']) ? $_POST['Collection_Name2'] : '';
    $Amount1 = isset($_POST['Amount1']) ? $_POST['Amount1'] : '0';
    $Amount2 = isset($_POST['Amount2']) ? $_POST['Amount2'] : '0';

    // SQL Query
    $sql = "INSERT INTO Collectionc1 (Date_And_Time, Employee_Name1,Employee_Name2 ,Collection_Name1, Collection_Name2, Amount1, Amount2) 
            VALUES ('$Date_And_Time', '$Employee_Name1', '$Employee_Name2','$Collection_Name1', '$Collection_Name2', '$Amount1', '$Amount2')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data saved successfully!'); window.location.href='../mainshiftc.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";

    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 450px;
        }
        .header {
            background: #ff6600;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-align: left;
            font-weight: bold;
            font-size: 16px;
            width: fit-content;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 5px;
        }
        select, input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .row select, .row input {
            flex: 1;
        }
        input::placeholder {
            color: #777;
            font-weight: normal;
        }
        .submit-btn {
            background: #ff6600;
            color: white;
            border: none;
            padding: 8px 15px;
            width: auto;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 15px auto 0;
        }
        .submit-btn:hover {
            background: #e65c00;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <div class="header">Collection</div>

            <label>Date & Time:</label>
            <input type="datetime-local" name="Date_And_Time" required>

            <label>Select Employee</label>
            <div class="row">
                <div>
                    <select name="Employee_Name1" required>
                        <option value="" disabled selected>Select Employee 1</option>
                        <option value="John Doe">John Doe</option>
                        <option value="Jane Smith">Jane Smith</option>
                        <option value="Michael Johnson">Michael Johnson</option>
                        <option value="Emily Davis">Emily Davis</option>
                    </select>
                </div>
                <div>
                    <select name="Employee_Name2" required>
                        <option value="" disabled selected>Select Employee 2</option>
                        <option value="John Doe">John Doe</option>
                        <option value="Jane Smith">Jane Smith</option>
                        <option value="Michael Johnson">Michael Johnson</option>
                        <option value="Emily Davis">Emily Davis</option>
                    </select>
                </div>
            </div>

            <label>Collection Name</label>
            <div class="row">
                <input type="text" placeholder="Enter Collection Name 1" name="Collection_Name1" required>
                <input type="text" placeholder="Enter Collection Name 2" name="Collection_Name2" required>
            </div>

            <label>Amount</label>
            <div class="row">
                <input type="number" placeholder="Amount 1" name="Amount1" required>
                <input type="number" placeholder="Amount 2" name="Amount2" required>
            </div>

            <button type="submit" class="submit-btn">SUBMIT</button>
        </form>
    </div>
</body>
</html>
