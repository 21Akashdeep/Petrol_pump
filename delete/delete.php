<?php
include '../db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM stock_entries WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: ../list/purchaselist.php");
?>
