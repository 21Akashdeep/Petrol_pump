<?php
include '../db_connect.php';

$id = $_POST['id'];
$company_name = $_POST['company_name'];

$sql = "UPDATE stock_entries SET company_name='$company_name' WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: ../list/purchaselist.php"); // Redirect back to main page
?>
