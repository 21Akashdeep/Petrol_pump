<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $ms_rate = mysqli_real_escape_string($conn, $_POST['ms_rate']);
    $xp95_rate = mysqli_real_escape_string($conn, $_POST['xp95_rate']);
    $hsd_rate = mysqli_real_escape_string($conn, $_POST['hsd_rate']);
    $hd_rate = mysqli_real_escape_string($conn, $_POST['hd_rate']);

    $sql = "UPDATE rate SET 
                ms_rate = '$ms_rate',
                xp95_rate = '$xp95_rate',
                hsd_rate = '$hsd_rate',
                hd_rate = '$hd_rate'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Rates updated successfully!');
            window.location.href='../list/ratelist.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating rates: " . mysqli_error($conn) . "');
            history.back();
        </script>";
    }
}
?>