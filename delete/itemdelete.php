<?php
include '../db_connect.php';

$id = $_GET['id'];
$sql = "DELETE FROM item WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: ../list/itemlist.php");
exit();
?>