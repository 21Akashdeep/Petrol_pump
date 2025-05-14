
<?php
$host = "localhost";
$username = "root";
$password = "Rajukumar@21";
$database = "vendors";
$conn = new mysqli($host, $username, $password, $database);

$id = intval($_GET['id']);
$conn->query("DELETE FROM liquidc1 WHERE id=$id");
header("Location: liquidlist.php");
exit;