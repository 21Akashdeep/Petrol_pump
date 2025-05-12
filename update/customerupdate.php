<?php
include '../db_connect.php';

$id = $_POST['id'];
$company_name = $_POST['company_name'];
$gst_no = $_POST['gst_no'];
$pan_no = $_POST['pan_no'];
$contact_no = $_POST['contact_no'];
$contact_person_no = $_POST['contact_person_no'];

$sql = "UPDATE customer SET 
    company_name = '$company_name',
    gst_no = '$gst_no',
    pan_no = '$pan_no',
    contact_no = '$contact_no',
    contact_person_no = '$contact_person_no'
    WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../list/customerlist.php"); // Redirect back to customer list
    exit();
} else {
    echo "<script>alert('Error updating customer: " . mysqli_error($conn) . "');history.back();</script>";
}
?>