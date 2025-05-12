<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $UOM = $_POST['UOM'];

    $sql = "UPDATE UOM SET UOM = '$UOM' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('UOM updated successfully!');
            window.location.href='../list/UOMlist.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating UOM: " . mysqli_error($conn) . "');
            history.back();
        </script>";
    }
}
?>