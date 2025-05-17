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
    $datetime = $conn->real_escape_string($_POST['datetime']);
    $employee1 = $conn->real_escape_string($_POST['employee1']);
    $employee2 = $conn->real_escape_string($_POST['employee2']);
    $employee3 = $conn->real_escape_string($_POST['employee3']);
    $employee4 = $conn->real_escape_string($_POST['employee4']);
    $product1 = $conn->real_escape_string($_POST['product1']);
    $product2 = $conn->real_escape_string($_POST['product2']);
    $product3 = $conn->real_escape_string($_POST['product3']);
    $product4 = $conn->real_escape_string($_POST['product4']);
    $xg1_start_reading = $conn->real_escape_string($_POST['xg1_start_reading']);
    $xg2_start_reading = $conn->real_escape_string($_POST['xg2_start_reading']);
    $ms1_start_reading = $conn->real_escape_string($_POST['ms1_start_reading']);
    $ms2_start_reading = $conn->real_escape_string($_POST['ms2_start_reading']);

    // Add all other fields you want to update here
    $fields = ["close_reading", "net_sale", "rate", "total_amount"];
    $set = "";
    foreach (["xg1_", "xg2_", "ms1_", "ms2_"] as $prefix) {
        foreach ($fields as $field) {
            $key = $prefix . $field;
            $val = $conn->real_escape_string($_POST[$key]);
            $set .= "$key='$val',";
        }
    }

    // Remove trailing comma from $set
    $set = rtrim($set, ',');

    $sql = "UPDATE liquidb3 SET 
        datetime='$datetime',
        employee1='$employee1', employee2='$employee2', employee3='$employee3', employee4='$employee4',
        product1='$product1', product2='$product2', product3='$product3', product4='$product4',
        xg1_start_reading='$xg1_start_reading', xg2_start_reading='$xg2_start_reading',
        ms1_start_reading='$ms1_start_reading', ms2_start_reading='$ms2_start_reading',
        $set
        WHERE id=$id";

    // Remove trailing comma before updated_at
    $sql = str_replace(",updated_at", "updated_at", $sql);

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