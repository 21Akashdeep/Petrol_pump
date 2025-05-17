<?php
$host = "localhost";
$username = "root";
$password = "Rajukumar@21";
$database = "vendors";
$conn = new mysqli($host, $username, $password, $database);

$id = intval($_POST['id']);
$datetime = $_POST['datetime']; // Use the correct field name
$employee1 = $_POST['employee1'];
$employee2 = $_POST['employee2'];
$employee3 = $_POST['employee3'];
$employee4 = $_POST['employee4'];

$sql = "UPDATE liquidc1 SET datetime=?, employee1=?, employee2=?, employee3=?, employee4=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $datetime, $employee1, $employee2, $employee3, $employee4, $id);
$stmt->execute();

header("Location: liquidlist.php");
exit;