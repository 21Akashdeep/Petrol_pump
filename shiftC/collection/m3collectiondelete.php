<?php
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM Collectionc3 WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='m3collectionReport.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>