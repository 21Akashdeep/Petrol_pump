<?php
$host = "localhost";
$username = "root";
$password = "Rajukumar@21";
$database = "vendors";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM liquidb3 WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: liquidlist.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>