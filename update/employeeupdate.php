<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $company_name = $_POST['company_name'];
    $pan_no = $_POST['pan_no'];
    $contact_no = $_POST['contact_no'];

    $sql = "UPDATE employee SET 
                company_name = '$company_name',
                pan_no = '$pan_no',
                contact_no = '$contact_no'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Employee updated successfully!');
            window.location.href='../list/employeelist.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating employee: " . mysqli_error($conn) . "');
            history.back();
        </script>";
    }
}
?>