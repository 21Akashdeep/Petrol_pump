<?php
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $Date_And_Time = $_POST['Date_And_Time'];
    $Employee_Name1 = $_POST['Employee_Name1'];
    $Employee_Name2 = $_POST['Employee_Name2'];
    $Collection_Name1 = $_POST['Collection_Name1'];
    $Collection_Name2 = $_POST['Collection_Name2'];
    $Amount1 = $_POST['Amount1'];
    $Amount2 = $_POST['Amount2'];

    $sql = "UPDATE Collectiona4 SET 
        Date_And_Time = '$Date_And_Time',
        Employee_Name1 = '$Employee_Name1',
        Employee_Name2 = '$Employee_Name2',
        Collection_Name1 = '$Collection_Name1',
        Collection_Name2 = '$Collection_Name2',
        Amount1 = '$Amount1',
        Amount2 = '$Amount2'
        WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data updated successfully!'); window.location.href='m4collectionReport.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>