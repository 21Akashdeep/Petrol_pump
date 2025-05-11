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
    $company_name = $_POST['company_name'];
    // $gst_no = $_POST['gst_no'];
    $pan_no = $_POST['pan_no'];
    $contact_no = $_POST['contact_no'];
    // $contact_person_no = $_POST['contact_person_no'];

    $sql = "INSERT INTO employee (company_name,pan_no, contact_no) 
            VALUES ('$company_name', '$pan_no', '$contact_no')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Employee added successfully!');
            window.location.href='../list/employeelist.php'; // Redirect to dashboard or another page
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
    <title>Create Employee</title>
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
        <h3 class="text-center mb-4"> Create Employee</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Employee Name</label>
                <input type="text" class="form-control" placeholder="Enter Employee name" name="company_name">
            </div>
            <!-- <div class="mb-3">
                <label class="form-label">GST No.</label>
                <input type="number" class="form-control" placeholder="Enter GST number"name="gst_no">
            </div> -->
            <div class="mb-3">
                <label class="form-label">Pan No.</label>
                <input type="text" class="form-control" placeholder="Enter PAN number" name="pan_no">
            </div>
            <div class="mb-3">
                <label class="form-label">Contact No.</label>
                <input type="tel" class="form-control" placeholder="Enter Contact number" name="contact_no">
            </div>
            <!-- <div class="mb-3">
                <label class="form-label">Contact Person No.</label>
                <input type="number" class="form-control" placeholder="Enter contact person's number"name="contact_person_no">
            </div> -->
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>