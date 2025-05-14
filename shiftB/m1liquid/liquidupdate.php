<?php
$host = "localhost";
$username = "root";
$password = "Rajukumar@21";
$database = "vendors";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $employee1 = $conn->real_escape_string($_POST['employee1']);
    $product1 = $conn->real_escape_string($_POST['product1']);
    $xg1_start_reading = $conn->real_escape_string($_POST['xg1_start_reading']);
    $xg1_close_reading = $conn->real_escape_string($_POST['xg1_close_reading']);
    $xg1_net_sale = $conn->real_escape_string($_POST['xg1_net_sale']);
    $xg1_total_amount = $conn->real_escape_string($_POST['xg1_total_amount']);

    $sql = "UPDATE liquidb1 SET 
        employee1='$employee1',
        product1='$product1',
        xg1_start_reading='$xg1_start_reading',
        xg1_close_reading='$xg1_close_reading',
        xg1_net_sale='$xg1_net_sale',
        xg1_total_amount='$xg1_total_amount'
        WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: liquidlist.php?msg=updated");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>