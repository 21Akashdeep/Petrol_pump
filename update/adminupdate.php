<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $aadhaar = $_POST['aadhaar'];
    $password = $_POST['password'];

    $sql = "UPDATE adminsignup SET 
                username = '$username',
                phone = '$phone',
                email = '$email',
                aadhaar = '$aadhaar',
                password = '$password'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Admin updated successfully!');
            window.location.href='../list/adminlist.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating admin: " . mysqli_error($conn) . "');
            history.back();
        </script>";
    }
}
?>