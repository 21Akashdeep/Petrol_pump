<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $item_name = $_POST['item_name'];

    $sql = "UPDATE item SET item_name = '$item_name' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Item updated successfully!');
            window.location.href='../list/itemlist.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating item: " . mysqli_error($conn) . "');
            history.back();
        </script>";
    }
}
?>