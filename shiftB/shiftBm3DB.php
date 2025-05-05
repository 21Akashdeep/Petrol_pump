<?php
// Database connection
$host = "localhost"; // Change if required
$username = "root"; // Change if required
$password = "Rajukumar@21"; // Change if required
$database = "vendors"; // Replace with your DB name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$shifta1_datetime = $_POST['shifta1_datetime'];
$shifta1_product1 = $_POST['shifta1_product1'];
$shifta1_product2 = $_POST['shifta1_product2'];
$shifta1_emp1 = $_POST['shifta1_emp1'];
$shifta1_emp2 = $_POST['shifta1_emp2'];
$shifta1_nozzle1 = $_POST['shifta1_nozzle1'];
$shifta1_nozzle2 = $_POST['shifta1_nozzle2'];

// Fields Array
$fields = ["start_reading", "close_reading", "reading_difference", "testing_less", "net_sale", "rate", "cash", "paytmM1", "paytmM2", "cardM1", "cardM2", "sortage", "surplus", "total_amount","paytm_amount","card_amount"];

// Initialize data array
$data = [];

foreach ($fields as $field) {
    $data["xp_".$field] = isset($_POST["xp_".$field]) ? (is_array($_POST["xp_".$field]) ? implode(",", $_POST["xp_".$field]) : $_POST["xp_".$field]) : '';
    $data["ms_".$field] = isset($_POST["ms_".$field]) ? (is_array($_POST["ms_".$field]) ? implode(",", $_POST["ms_".$field]) : $_POST["ms_".$field]) : '';
}

// Insert Query
$sql = "INSERT INTO shiftb3 (shifta1_datetime, shifta1_product1, shifta1_product2, shifta1_emp1, shifta1_emp2, shifta1_nozzle1, shifta1_nozzle2, 
        xp_start_reading, ms_start_reading, xp_close_reading, ms_close_reading, xp_reading_difference, ms_reading_difference, 
        xp_testing_less, ms_testing_less, xp_net_sale, ms_net_sale, xp_rate, ms_rate, xp_cash, ms_cash, xp_paytmM1, ms_paytmM2,xp_paytm_amount,ms_paytm_amount, 
        xp_cardM1, ms_cardM2,xp_card_amount,ms_card_amount, xp_sortage, ms_sortage, xp_surplus, ms_surplus, xp_total_amount, ms_total_amount) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssssssssssssssssss", 
    $shifta1_datetime, $shifta1_product1, $shifta1_product2, $shifta1_emp1, $shifta1_emp2, $shifta1_nozzle1, $shifta1_nozzle2,
    $data['xp_start_reading'], $data['ms_start_reading'], $data['xp_close_reading'], $data['ms_close_reading'],
    $data['xp_reading_difference'], $data['ms_reading_difference'], $data['xp_testing_less'], $data['ms_testing_less'],
    $data['xp_net_sale'], $data['ms_net_sale'], $data['xp_rate'], $data['ms_rate'], $data['xp_cash'], $data['ms_cash'],
    $data['xp_paytmM1'], $data['ms_paytmM2'],$data['xp_paytm_amount'],$data['ms_paytm_amount'], $data['xp_cardM1'], $data['ms_cardM2'],$data['xp_card_amount'],$data['ms_card_amount'], $data['xp_sortage'], $data['ms_sortage'],
    $data['xp_surplus'], $data['ms_surplus'], $data['xp_total_amount'], $data['ms_total_amount']
);

// Execute Query
if ($stmt->execute()) {
    echo "<script>alert('Data saved successfully!'); window.location.href='mainshiftB.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
}

// Close Connection
$stmt->close();
$conn->close();
?>

