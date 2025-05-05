<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = "Rajukumar@21"; // Change if needed
$dbname = "vendors";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function db_connect() {
    $host = "localhost"; // Change if different
    $user = "root"; // Database username
    $password = "Rajukumar@21"; // Database password
    $dbname = "vendors"; // Change to your DB name

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
