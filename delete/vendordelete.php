<?php
include '../db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM vendors WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: ../list/vendorlist.php");
?>
