<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $mobile_2t_rate = $_POST['mobile_2t_rate'];
    $mobile_1t_rate = $_POST['mobile_1t_rate'];
    $mobile_D1_rate = $_POST['mobile_D1_rate'];
    $mobile_D5_rate = $_POST['mobile_D5_rate'];

    $sql = "UPDATE liquidrate SET 
                mobile_2t_rate = '$mobile_2t_rate',
                mobile_1t_rate = '$mobile_1t_rate',
                mobile_D1_rate = '$mobile_D1_rate',
                mobile_D5_rate = '$mobile_D5_rate'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Liquid rate updated successfully!');
            window.location.href='../list/liquidratelist.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating liquid rate: " . mysqli_error($conn) . "');
            history.back();
        </script>";
    }
}
?>