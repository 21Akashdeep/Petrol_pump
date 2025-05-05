<?php
include '../db_connect.php';
$id = $_GET['id'];
$id = $_POST['id'];
$password = $_POST['password'];

$sql = "UPDATE adminsignup SET password='$password' WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: ../index.php"); // Redirect back to main page
?>
