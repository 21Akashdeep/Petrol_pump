<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

if (!isset($_SESSION['username'])) {
    header("Location: userlogin.php");
    exit();
}

$username = $_SESSION['username'];

// Database connection
$link = new mysqli('localhost', 'root', '', 'pcatswzu_complains');
if (mysqli_connect_error()) {
    die("Connection error");
}

if ($_POST) {
    $work_order_no = $_POST["work_order_no"];
    $Job_type = $_POST["Job_type"];
    $workDetails = $_POST["workDetails"];
    $work_Reason = $_POST["work_Reason"];
    $User_complain = $_POST["User_complain"];
    $user_Reason = $_POST["user_Reason"];
    $dateTimeField = $_POST["dateTimeField"];
    $location = $_POST["location"];
    
    $targetDir = "uploads/";
    $inpdfFile = $_FILES["inpdfFile"]["name"];
    $inpdfFilePath = $targetDir . basename($inpdfFile);
    move_uploaded_file($_FILES["inpdfFile"]["tmp_name"], $inpdfFilePath);

    $query = "INSERT INTO ad_m (work_order_no, Job_type, workDetails, work_Reason, User_complain, user_Reason, dateTimeField, location, username, inpdfFile) 
              VALUES ('$work_order_no', '$Job_type', '$workDetails', '$work_Reason', '$User_complain', '$user_Reason', '$dateTimeField', '$location', '$username', '$inpdfFilePath')";

    if ($link->query($query) === TRUE) {
        echo "<script>alert('Your job status is submitted successfully'); window.location.href = 'user.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . $link->error;
    }
}

// Retrieve user's previous uploads
$userUploadsQuery = "SELECT * FROM ad_m WHERE username = '$username'";
$userUploadsResult = $link->query($userUploadsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
        .scrollable-table-container {
            height: 400px; /* Adjust height as needed */
            overflow-y: scroll;
        }
        
    </style>
</head>
<body>
  <nav class="navbar bg-primary">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">
        <a href="userlogin.php"><button type="button" class="btn btn-primary">LOGOUT</button></a>
      </span>
    </div>
  </nav>
  <h1>User Account</h1>
  <div>
    <?php echo 'Hello, ' . htmlspecialchars($_SESSION['username']); ?>

    <!-- Form for submitting a new job -->
    <!-- (Your existing form code goes here) -->

    <!-- Display previous uploads in a table format -->
    <h2>Your Previous Submissions</h2>
    <?php if ($userUploadsResult->num_rows > 0): ?>
      <div class="scrollable-table-container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Work Order No</th>
                        <th>Job Type</th>
                        <th>Work Details</th>
                        <th>Work Reason</th>
                        <th>User Complain</th>
                        <th>User Reason</th>
                        <th>Date and Time</th>
                        <th>Location</th>
                        <th>Uploaded PDF</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $userUploadsResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['work_order_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['Job_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['workDetails']); ?></td>
                            <td><?php echo htmlspecialchars($row['work_Reason']); ?></td>
                            <td><?php echo htmlspecialchars($row['User_complain']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_Reason']); ?></td>
                            <td><?php echo htmlspecialchars($row['dateTimeField']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td>
                                <?php if ($row['inpdfFile']): ?>
                                    <a href="<?php echo htmlspecialchars($row['inpdfFile']); ?>" target="_blank">View PDF</a>
                                <?php else: ?>
                                    No PDF uploaded
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        </div>
    <?php else: ?>
        <p>No previous submissions found.</p>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
