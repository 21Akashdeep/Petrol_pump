<?php
include '../db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    // Delete related items first
    $conn->query("DELETE FROM stock_items WHERE entry_id = $id");
    // Delete the main entry
    $conn->query("DELETE FROM stock_entries WHERE id = $id");
}

header("Location: ../list/purchaselist.php");
exit();
?>