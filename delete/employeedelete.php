<?php
include '../db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM employee WHERE id = $id";
    mysqli_query($conn, $sql);
}

header("Location: ../list/employeelist.php");
exit();
?>