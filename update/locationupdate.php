<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $location_name = $_POST['location_name'];

    $sql = "UPDATE locations SET location_name = '$location_name' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Location updated successfully!');
            window.location.href='../list/locationlist.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating location: " . mysqli_error($conn) . "');
            history.back();
        </script>";
    }
}
?>