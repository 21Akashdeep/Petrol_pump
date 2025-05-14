<?php
$host = "localhost";
$username = "root";
$password = "Rajukumar@21";
$database = "vendors";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_POST['id']);
$shifta1_datetime = $_POST['shifta1_datetime'];
$product1 = $_POST['product1'];
$product2 = $_POST['product2'];
$product3 = $_POST['product3'];
$product4 = $_POST['product4'];
$employee1 = $_POST['employee1'];
$employee2 = $_POST['employee2'];
$employee3 = $_POST['employee3'];
$employee4 = $_POST['employee4'];
$xg1_start_reading = $_POST['xg1_start_reading'];
$xg2_start_reading = $_POST['xg2_start_reading'];
$ms1_start_reading = $_POST['ms1_start_reading'];
$ms2_start_reading = $_POST['ms2_start_reading'];

// Dynamic fields
$fields = [
    "close_reading",
    "testing_less",
    "rate",
    "net_sale",
    "total_amount"
];
$prefixes = ["xg1_", "xg2_", "ms1_", "ms2_"];
$field_values = [];
foreach ($prefixes as $prefix) {
    foreach ($fields as $field) {
        $key = $prefix . $field;
        $field_values[$key] = isset($_POST[$key]) ? $_POST[$key] : '';
    }
}

// Build SQL
$sql = "UPDATE liquidc2 SET 
    shifta1_datetime=?, product1=?, product2=?, product3=?, product4=?,
    employee1=?, employee2=?, employee3=?, employee4=?,
    xg1_start_reading=?, xg2_start_reading=?, ms1_start_reading=?, ms2_start_reading=?";

foreach ($prefixes as $prefix) {
    foreach ($fields as $field) {
        $sql .= ", {$prefix}{$field}=?";
    }
}
$sql .= " WHERE id=?";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters
$params = [
    $shifta1_datetime,
    $product1,
    $product2,
    $product3,
    $product4,
    $employee1,
    $employee2,
    $employee3,
    $employee4,
    $xg1_start_reading,
    $xg2_start_reading,
    $ms1_start_reading,
    $ms2_start_reading
];
foreach ($prefixes as $prefix) {
    foreach ($fields as $field) {
        $params[] = $field_values[$prefix . $field];
    }
}
$params[] = $id;

// Generate types string
$types = str_repeat('s', count($params) - 1) . 'i';

// Bind dynamically
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    header("Location: liquidlist.php?msg=updated");
    exit;
} else {
    echo "Update failed: " . $stmt->error;
}
?>