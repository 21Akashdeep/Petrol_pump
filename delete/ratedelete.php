<?php
include '../db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM rate WHERE id = $id";
    mysqli_query($conn, $sql);
}

header("Location: ../list/ratelist.php");
exit();
?>