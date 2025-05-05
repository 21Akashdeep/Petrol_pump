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
$shifta1_datetime = $_POST['datetime'];
$shifta1_product1 = $_POST['product1'];
$shifta1_product2 = $_POST['product2'];
$shifta1_product3 = $_POST['product3'];
$shifta1_product4 = $_POST['product4'];
$shifta1_emp1 = $_POST['employee1'];
$shifta1_emp2 = $_POST['employee2'];
$shifta1_emp3 = $_POST['employee3'];
$shifta1_emp4 = $_POST['employee4'];
$shifta1_nozzle1 = $_POST['nozzle1'];
$shifta1_nozzle2 = $_POST['nozzle2'];
$shifta1_nozzle3 = $_POST['nozzle3'];
$shifta1_nozzle4 = $_POST['nozzle4'];
$shifta1_nozzle4 = $_POST['nozzle4'];
$paytm_0=$_POST['paytm_0'];
$paytm_1=$_POST['paytm_1'];
$paytm_2=$_POST['paytm_2'];
$paytm_3=$_POST['paytm_3'];
$card_0=$_POST['card_0'];
$card_1=$_POST['card_1'];
$card_2=$_POST['card_2'];
$card_3=$_POST['card_3'];

// Fields Array
$fields = ["start_reading", "close_reading", "reading_difference", "testing_less", "net_sale", "rate", "cash", "paytm_amount", "card_amount", "sortage", "surplus", "total_amount"];

// Initialize data array
$data = [];

foreach ($fields as $field) {
    $data["xg1_".$field] = isset($_POST["xg1_".$field]) ? (is_array($_POST["xg1_".$field]) ? implode(",", $_POST["xg1_".$field]) : $_POST["xg1_".$field]) : '';
    $data["xg2_".$field] = isset($_POST["xg2_".$field]) ? (is_array($_POST["xg2_".$field]) ? implode(",", $_POST["xg2_".$field]) : $_POST["xg2_".$field]) : '';
    $data["ms1_".$field] = isset($_POST["ms1_".$field]) ? (is_array($_POST["ms1_".$field]) ? implode(",", $_POST["ms1_".$field]) : $_POST["ms1_".$field]) : '';
    $data["ms2_".$field] = isset($_POST["ms2_".$field]) ? (is_array($_POST["ms2_".$field]) ? implode(",", $_POST["ms2_".$field]) : $_POST["ms2_".$field]) : '';
}

// Insert Query
$sql = "INSERT INTO shiftc4 (datetime,product1,product2,product3,product4,employee1, employee2,employee3,employee4,nozzle1,nozzle2,nozzle3,nozzle4,card_0,card_1,card_2,card_3,
        xg1_start_reading, xg2_start_reading,ms1_start_reading,ms2_start_reading, xg1_close_reading, xg2_close_reading,ms1_close_reading,ms2_close_reading, xg1_reading_difference, xg2_reading_difference,ms1_reading_difference,ms2_reading_difference, 
        xg1_testing_less, xg2_testing_less,ms1_testing_less,ms2_testing_less, xg1_net_sale, xg2_net_sale,ms1_net_sale,ms2_net_sale, xg1_rate, xg2_rate,ms1_rate,ms2_rate, xg1_cash, xg2_cash,ms1_cash,ms2_cash, paytm_0,paytm_1,paytm_2,paytm_3,xg1_paytm_amount, xg2_paytm_amount,ms1_paytm_amount,ms2_paytm_amount,
        xg1_card_amount, xg2_card_amount,ms1_card_amount,ms2_card_amount, xg1_sortage, xg2_sortage,ms1_sortage,ms2_sortage, xg1_surplus, xg2_surplus,ms1_surplus,ms2_surplus, xg1_total_amount, xg2_total_amount,ms1_total_amount,ms2_total_amount) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", 
    $shifta1_datetime, $shifta1_product1, $shifta1_product2, $shifta1_product3, $shifta1_product4, $shifta1_emp1, $shifta1_emp2,$shifta1_emp3,$shifta1_emp4, $shifta1_nozzle1, $shifta1_nozzle2,$shifta1_nozzle3,$shifta1_nozzle4,$card_0,$card_1,$card_2,$card_3,
    $data['xg1_start_reading'], $data['xg2_start_reading'],$data['ms1_start_reading'], $data['ms2_start_reading'],$data['xg1_close_reading'], $data['xg2_close_reading'],$data['ms1_close_reading'],$data['ms2_close_reading'],
    $data['xg1_reading_difference'], $data['xg2_reading_difference'],$data['ms1_reading_difference'],$data['ms2_reading_difference'], $data['xg1_testing_less'], $data['xg2_testing_less'],$data['ms1_testing_less'],$data['ms2_testing_less'],
    $data['xg1_net_sale'], $data['xg2_net_sale'],$data['ms1_net_sale'],$data['ms2_net_sale'], $data['xg1_rate'], $data['xg2_rate'],$data['ms1_rate'],$data['ms2_rate'], $data['xg1_cash'], $data['xg2_cash'],$data['ms1_cash'],$data['ms2_cash'],
    $paytm_0, $paytm_1,$paytm_2,$paytm_3, $data['xg1_paytm_amount'],$data['xg2_paytm_amount'],$data['ms1_paytm_amount'],$data['ms2_paytm_amount'],$data['xg1_card_amount'], $data['xg2_card_amount'],$data['ms1_card_amount'],$data['ms2_card_amount'], $data['xg1_sortage'], $data['xg2_sortage'],$data['ms1_sortage'],$data['ms2_sortage'],$data['ms1_surplus'],$data['ms2_surplus'],
    $data['xg1_surplus'], $data['xg2_surplus'], $data['xg1_total_amount'], $data['xg2_total_amount'],$data['ms1_total_amount'],$data['ms2_total_amount']
);

// Execute Query
if ($stmt->execute()) {
    echo "<script>alert('Data saved successfully!'); window.location.href='mainshiftc.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
}

// Close Connection
$stmt->close();
$conn->close();
?>

