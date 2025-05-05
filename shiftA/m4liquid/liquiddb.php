<?php
include '../../db_connect.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "Rajukumar@21", "vendors");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to check and convert empty values to NULL
    function sanitizeInput($value) {
        return ($value === "" || $value === null) ? NULL : $value;
    }

    // Fetch and sanitize inputs
    $datetime = $_POST['datetime'];
    $product1 = $_POST['product1'];
    $product2 = $_POST['product2'];
    $product3 = $_POST['product3'];
    $product4 = $_POST['product4'];
    $employee1 = $_POST['employee1'];
    $employee2 = $_POST['employee2'];
    $employee3 = $_POST['employee3'];
    $employee4 = $_POST['employee4'];
    $xg1_start_reading = sanitizeInput($_POST['xg1_start_reading']);
    $xg2_start_reading = sanitizeInput($_POST['xg2_start_reading']);
    $ms1_start_reading = sanitizeInput($_POST['ms1_start_reading']);
    $ms2_start_reading = sanitizeInput($_POST['ms2_start_reading']);
    $xg1_close_reading = sanitizeInput($_POST['xg1_close_reading']);
    $xg2_close_reading = sanitizeInput($_POST['xg2_close_reading']);
    $ms1_close_reading = sanitizeInput($_POST['ms1_close_reading']);
    $ms2_close_reading = sanitizeInput($_POST['ms2_close_reading']);
    $xg1_net_sale = sanitizeInput($_POST['xg1_net_sale']);
    $xg2_net_sale = sanitizeInput($_POST['xg2_net_sale']);
    $ms1_net_sale = sanitizeInput($_POST['ms1_net_sale']);
    $ms2_net_sale = sanitizeInput($_POST['ms2_net_sale']);
    $xg1_rate = sanitizeInput($_POST['xg1_rate']);
    $xg2_rate = sanitizeInput($_POST['xg2_rate']);
    $ms1_rate = sanitizeInput($_POST['ms1_rate']);
    $ms2_rate = sanitizeInput($_POST['ms2_rate']);
    $xg1_total_amount = sanitizeInput($_POST['xg1_total_amount']);
    $xg2_total_amount = sanitizeInput($_POST['xg2_total_amount']);
    $ms1_total_amount = sanitizeInput($_POST['ms1_total_amount']);
    $ms2_total_amount = sanitizeInput($_POST['ms2_total_amount']);

    // Prepare SQL statement
    $sql = "INSERT INTO liquida4 (datetime, product1, product2, product3, product4, employee1, employee2, employee3, employee4, 
            xg1_start_reading, xg2_start_reading, ms1_start_reading, ms2_start_reading, 
            xg1_close_reading, xg2_close_reading, ms1_close_reading, ms2_close_reading, 
            xg1_net_sale, xg2_net_sale, ms1_net_sale, ms2_net_sale, 
            xg1_rate, xg2_rate, ms1_rate, ms2_rate, 
            xg1_total_amount, xg2_total_amount, ms1_total_amount, ms2_total_amount) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssddddddddddddddddddddd", 
        $datetime, $product1, $product2, $product3, $product4, 
        $employee1, $employee2, $employee3, $employee4, 
        $xg1_start_reading, $xg2_start_reading, $ms1_start_reading, $ms2_start_reading, 
        $xg1_close_reading, $xg2_close_reading, $ms1_close_reading, $ms2_close_reading, 
        $xg1_net_sale, $xg2_net_sale, $ms1_net_sale, $ms2_net_sale, 
        $xg1_rate, $xg2_rate, $ms1_rate, $ms2_rate, 
        $xg1_total_amount, $xg2_total_amount, $ms1_total_amount, $ms2_total_amount
    );

    // Execute query
    if ($stmt->execute()) {
        echo "<script>alert('Data saved successfully!'); window.location.href='liquid.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
