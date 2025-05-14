<?php
$host = "localhost";
$username = "root";
$password = "Rajukumar@21";
$database = "vendors";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $sql = "DELETE FROM liquidc2 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: liquidlist.php?msg=deleted");
        exit;
    } else {
        echo "Delete failed: " . $stmt->error;
    }
} else {
    echo "Invalid ID.";
}
?>