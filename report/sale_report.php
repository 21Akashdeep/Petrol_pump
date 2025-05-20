<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "Rajukumar@21", "vendors");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

// Get date from POST (from sales_report.html form)
$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

// Fetch Data from Database with date filter
$sql = "SELECT * FROM shift WHERE xp_close_reading IS NOT NULL AND DATE(shifta1_datetime) = '$date' ORDER BY shifta1_datetime DESC LIMIT 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$sql2 = "SELECT * FROM shifta2 WHERE xp_close_reading IS NOT NULL AND DATE(shifta1_datetime) = '$date' ORDER BY shifta1_datetime DESC LIMIT 1";
$result2 = $conn->query($sql2);
$data2 = $result2->fetch_assoc();

$sql3 = "SELECT * FROM shifta3 WHERE xp_close_reading IS NOT NULL AND DATE(shifta1_datetime) = '$date' ORDER BY shifta1_datetime DESC LIMIT 1";
$result3 = $conn->query($sql3);
$data3 = $result3->fetch_assoc();

$sql4 = "SELECT * FROM shifta4 WHERE xg1_close_reading IS NOT NULL AND DATE(datetime) = '$date' ORDER BY datetime DESC LIMIT 1";
$result4 = $conn->query($sql4);
$data4 = $result4->fetch_assoc();

$sqlrate = "SELECT * FROM rate WHERE DATE(created_at) <= '$date' ORDER BY created_at DESC LIMIT 1";
$resultrate = $conn->query($sqlrate);
$datarate = $resultrate->fetch_assoc();

$sqlliquid = "SELECT * FROM liquida1 WHERE DATE(datetime) = '$date' ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquid = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquida2 WHERE DATE(datetime) = '$date' ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida2 = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquida3 WHERE DATE(datetime) = '$date' ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida3 = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquida4 WHERE DATE(datetime) = '$date' ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida4 = $resultliquid->fetch_assoc();

$sqlbank = "SELECT * FROM bank WHERE DATE(date_time) = '$date' ORDER BY id DESC LIMIT 1";
$resultbank = $conn->query($sqlbank);
$databank = $resultbank->fetch_assoc();

$sqlbanka1 = "SELECT * FROM banka2 WHERE DATE(date_time) = '$date' ORDER BY id DESC LIMIT 1";
$resultbanka1 = $conn->query($sqlbanka1);
$databanka1 = $resultbanka1->fetch_assoc();

$sqlbanka2a = "SELECT * FROM banka3 WHERE DATE(date_time) = '$date' ORDER BY id DESC LIMIT 1";
$resultbanka2a = $conn->query($sqlbanka2a);
$databanka2a = $resultbanka2a->fetch_assoc();

$sqlbank500 = "SELECT * FROM banka4 WHERE DATE(date_time) = '$date' ORDER BY id DESC LIMIT 1";
$resultbank500 = $conn->query($sqlbank500);
$databank500 = $resultbank500->fetch_assoc();

$sqlbanka2 = "SELECT pieces, amount FROM second_shift WHERE denomination = 200 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka2 = $conn->query($sqlbanka2);
$databanka2 = $resultbanka2->fetch_assoc();

$sqlbanka2a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 200 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka2a2 = $conn->query($sqlbanka2a2);
$databanka2a2 = $resultbanka2a2->fetch_assoc();

$sqlbanka2a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 200 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka2a3 = $conn->query($sqlbanka2a3);
$databanka2a3 = $resultbanka2a3->fetch_assoc();

$sqlbanka2a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 200 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka2a4 = $conn->query($sqlbanka2a4);
$databanka2a4 = $resultbanka2a4->fetch_assoc();

$sqlbanka3 = "SELECT pieces, amount FROM second_shift WHERE denomination = 100 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka3 = $conn->query($sqlbanka3);
$databanka3 = $resultbanka3->fetch_assoc();

$sqlbanka3a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 100 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka3a2 = $conn->query($sqlbanka3a2);
$databanka3a2 = $resultbanka3a2->fetch_assoc();

$sqlbanka3a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 100 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka3a3 = $conn->query($sqlbanka3a3);
$databanka3a3 = $resultbanka3a3->fetch_assoc();

$sqlbanka3a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 100 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka3a4 = $conn->query($sqlbanka3a4);
$databanka3a4 = $resultbanka3a4->fetch_assoc();

$sqlbanka4 = "SELECT pieces, amount FROM second_shift WHERE denomination = 50 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka4 = $conn->query($sqlbanka4);
$databanka4 = $resultbanka4->fetch_assoc();

$sqlbanka4a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 50 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka4a2 = $conn->query($sqlbanka4a2);
$databanka4a2 = $resultbanka4a2->fetch_assoc();

$sqlbanka4a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 50 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka4a3 = $conn->query($sqlbanka4a3);
$databanka4a3 = $resultbanka4a3->fetch_assoc();

$sqlbanka4a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 50 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka4a4 = $conn->query($sqlbanka4a4);
$databanka4a4 = $resultbanka4a4->fetch_assoc();

$sqlbanka5 = "SELECT pieces, amount FROM second_shift WHERE denomination = 20 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka5 = $conn->query($sqlbanka5);
$databanka5 = $resultbanka5->fetch_assoc();

$sqlbanka5a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 20 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka5a2 = $conn->query($sqlbanka5a2);
$databanka5a2 = $resultbanka5a2->fetch_assoc();

$sqlbanka5a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 20 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka5a3 = $conn->query($sqlbanka5a3);
$databanka5a3 = $resultbanka5a3->fetch_assoc();

$sqlbanka5a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 20 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka5a4 = $conn->query($sqlbanka5a4);
$databanka5a4 = $resultbanka5a4->fetch_assoc();

$sqlbanka6 = "SELECT pieces, amount FROM second_shift WHERE denomination = 10 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka6 = $conn->query($sqlbanka6);
$databanka6 = $resultbanka6->fetch_assoc();

$sqlbanka6a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 10 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka6a2 = $conn->query($sqlbanka6a2);
$databanka6a2 = $resultbanka6a2->fetch_assoc();

$sqlbanka6a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 10 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka6a3 = $conn->query($sqlbanka6a3);
$databanka6a3 = $resultbanka6a3->fetch_assoc();

$sqlbanka6a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 10 AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka6a4 = $conn->query($sqlbanka6a4);
$databanka6a4 = $resultbanka6a4->fetch_assoc();

$sqlbanka7 = "SELECT pieces, amount FROM second_shift WHERE denomination = 'Coins' AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka7 = $conn->query($sqlbanka7);
$databanka7 = $resultbanka7->fetch_assoc();

$sqlbanka7a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 'Coins' AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka7a2 = $conn->query($sqlbanka7a2);
$databanka7a2 = $resultbanka7a2->fetch_assoc();

$sqlbanka7a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 'Coins' AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka7a3 = $conn->query($sqlbanka7a3);
$databanka7a3 = $resultbanka7a3->fetch_assoc();

$sqlbanka7a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 'Coins' AND DATE(date_time) = '$date' ORDER BY date_time DESC LIMIT 1";
$resultbanka7a4 = $conn->query($sqlbanka7a4);
$databanka7a4 = $resultbanka7a4->fetch_assoc();

$sqlcollection = "SELECT * FROM collection WHERE DATE(Date_And_Time) = '$date'";
$resultcollection = $conn->query($sqlcollection);

$sqlattendance = "SELECT * FROM attendance WHERE DATE(created_at) = '$date'";
$resultattendance = $conn->query($sqlattendance);

$stmt = $conn->prepare("
    SELECT expense_name, SUM(total_amount) AS total_amount
    FROM (
        SELECT expense_name, SUM(amount) AS total_amount FROM expense WHERE DATE(created_at) = ? GROUP BY expense_name
        UNION ALL
        SELECT expense_name, SUM(amount) AS total_amount FROM expensea2 WHERE DATE(created_at) = ? GROUP BY expense_name
        UNION ALL
        SELECT expense_name, SUM(amount) AS total_amount FROM expensea3 WHERE DATE(created_at) = ? GROUP BY expense_name
        UNION ALL
        SELECT expense_name, SUM(amount) AS total_amount FROM expensea4 WHERE DATE(created_at) = ? GROUP BY expense_name
    ) AS combined_expenses
    GROUP BY expense_name
");
$stmt->bind_param("ssss", $date, $date, $date, $date);
$stmt->execute();
$resultexp = $stmt->get_result();

$sqladvancea = "SELECT * FROM advancea WHERE DATE(created_at) = '$date' ORDER BY id DESC LIMIT 1";
$resultadvancea = $conn->query($sqladvancea);
$dataadvancea = $resultadvancea->fetch_assoc();
?>