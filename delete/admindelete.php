<?php
include '../db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM adminsignup WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: ../list/adminlist.php");
?>
