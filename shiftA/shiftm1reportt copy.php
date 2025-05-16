<?php

$conn = new mysqli("localhost", "root", "Rajukumar@21", "vendors");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $totalb = isset($_SESSION['totalb']) ? $_SESSION['totalb'] : 0;
// Fetch Data from Database
$sql = "SELECT * FROM shift WHERE xp_close_reading IS NOT NULL ORDER BY shifta1_datetime DESC LIMIT 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$sql2 = "SELECT * FROM shifta2 WHERE xp_close_reading IS NOT NULL ORDER BY shifta1_datetime DESC LIMIT 1";
$result2 = $conn->query($sql2);
$data2 = $result2->fetch_assoc();

$sql3 = "SELECT * FROM shifta3 WHERE xp_close_reading IS NOT NULL ORDER BY shifta1_datetime DESC LIMIT 1";
$result3 = $conn->query($sql3);
$data3 = $result3->fetch_assoc();

$sql4 = "SELECT * FROM shifta4 WHERE xg1_close_reading IS NOT NULL ORDER BY datetime DESC LIMIT 1";
$result4 = $conn->query($sql4);
$data4 = $result4->fetch_assoc();

$sqlrate = "SELECT * FROM rate ORDER BY created_at DESC LIMIT 1";
$resultrate = $conn->query($sqlrate);
$datarate = $resultrate->fetch_assoc();

$sqlliquid = "SELECT * FROM liquida1 ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquid = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquida2 ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida2 = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquida3 ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida3 = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquida4 ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida4 = $resultliquid->fetch_assoc();

$sqlbank = "SELECT * FROM bank ORDER BY id DESC LIMIT 1";
$resultbank = $conn->query($sqlbank);
$databank = $resultbank->fetch_assoc();

$sqlbanka1 = "SELECT * FROM banka2 ORDER BY id DESC LIMIT 1";
$resultbanka1 = $conn->query($sqlbanka1);
$databanka1 = $resultbanka1->fetch_assoc();

$sqlbanka2 = "SELECT * FROM banka3 ORDER BY id DESC LIMIT 1";
$resultbanka2 = $conn->query($sqlbanka2);
$databanka2 = $resultbanka2->fetch_assoc();

$sqlbanka3 = "SELECT * FROM banka4 ORDER BY id DESC LIMIT 1";
$resultbanka3 = $conn->query($sqlbanka3);
$databanka3 = $resultbanka3->fetch_assoc();

// $sqlbanka4 = "SELECT * FROM banka4 ORDER BY id DESC LIMIT 1";
// $resultbanka4 = $conn->query($sqlbanka4);
// $databanka4 = $resultbanka4->fetch_assoc();

$sqlbanka2 = "SELECT pieces, amount FROM second_shift WHERE denomination = 200 ORDER BY date_time DESC LIMIT 1";
$resultbanka2 = $conn->query($sqlbanka2);
$databanka2 = $resultbanka2->fetch_assoc();

$sqlbanka2a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 200 ORDER BY date_time DESC LIMIT 1";
$resultbanka2a2 = $conn->query($sqlbanka2a2);
$databanka2a2 = $resultbanka2a2->fetch_assoc();

$sqlbanka2a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 200 ORDER BY date_time DESC LIMIT 1";
$resultbanka2a3 = $conn->query($sqlbanka2a3);
$databanka2a3 = $resultbanka2a3->fetch_assoc();

$sqlbanka2a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 200 ORDER BY date_time DESC LIMIT 1";
$resultbanka2a4 = $conn->query($sqlbanka2a4);
$databanka2a4 = $resultbanka2a4->fetch_assoc();

$sqlbanka3 = "SELECT pieces, amount FROM second_shift WHERE denomination = 100 ORDER BY date_time DESC LIMIT 1";
$resultbanka3 = $conn->query($sqlbanka3);
$databanka3 = $resultbanka3->fetch_assoc();

$sqlbanka3a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 100 ORDER BY date_time DESC LIMIT 1";
$resultbanka3a2 = $conn->query($sqlbanka3a2);
$databanka3a2 = $resultbanka3a2->fetch_assoc();

$sqlbanka3a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 100 ORDER BY date_time DESC LIMIT 1";
$resultbanka3a3 = $conn->query($sqlbanka3a3);
$databanka3a3 = $resultbanka3a3->fetch_assoc();

$sqlbanka3a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 100 ORDER BY date_time DESC LIMIT 1";
$resultbanka3a4 = $conn->query($sqlbanka3a4);
$databanka3a4 = $resultbanka3a4->fetch_assoc();

$sqlbanka4 = "SELECT pieces, amount FROM second_shift WHERE denomination = 50 ORDER BY date_time DESC LIMIT 1";
$resultbanka4 = $conn->query($sqlbanka4);
$databanka4 = $resultbanka4->fetch_assoc();

$sqlbanka4a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 50 ORDER BY date_time DESC LIMIT 1";
$resultbanka4a2 = $conn->query($sqlbanka4a2);
$databanka4a2 = $resultbanka4a2->fetch_assoc();

$sqlbanka4a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 50 ORDER BY date_time DESC LIMIT 1";
$resultbanka4a3 = $conn->query($sqlbanka4a3);
$databanka4a3 = $resultbanka4a3->fetch_assoc();

$sqlbanka4a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 50 ORDER BY date_time DESC LIMIT 1";
$resultbanka4a4 = $conn->query($sqlbanka4a4);
$databanka4a4 = $resultbanka4a4->fetch_assoc();

$sqlbanka5 = "SELECT pieces, amount FROM second_shift WHERE denomination = 20 ORDER BY date_time DESC LIMIT 1";
$resultbanka5 = $conn->query($sqlbanka5);
$databanka5 = $resultbanka5->fetch_assoc();

$sqlbanka5a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 20 ORDER BY date_time DESC LIMIT 1";
$resultbanka5a2 = $conn->query($sqlbanka5a2);
$databanka5a2 = $resultbanka5a2->fetch_assoc();

$sqlbanka5a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 20 ORDER BY date_time DESC LIMIT 1";
$resultbanka5a3 = $conn->query($sqlbanka5a3);
$databanka5a3 = $resultbanka5a3->fetch_assoc();

$sqlbanka5a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 20 ORDER BY date_time DESC LIMIT 1";
$resultbanka5a3 = $conn->query($sqlbanka5a3);
$databanka5a3 = $resultbanka5a3->fetch_assoc();

$sqlbanka5a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 20 ORDER BY date_time DESC LIMIT 1";
$resultbanka5a4 = $conn->query($sqlbanka5a4);
$databanka5a4 = $resultbanka5a4->fetch_assoc();

$sqlbanka6 = "SELECT pieces, amount FROM second_shift WHERE denomination = 10 ORDER BY date_time DESC LIMIT 1";
$resultbanka6 = $conn->query($sqlbanka6);
$databanka6 = $resultbanka6->fetch_assoc();

$sqlbanka6a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 10 ORDER BY date_time DESC LIMIT 1";
$resultbanka6a2 = $conn->query($sqlbanka6a2);
$databanka6a2 = $resultbanka6a2->fetch_assoc();

$sqlbanka6a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 10 ORDER BY date_time DESC LIMIT 1";
$resultbanka6a3 = $conn->query($sqlbanka6a3);
$databanka6a3 = $resultbanka6a3->fetch_assoc();

$sqlbanka6a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 10 ORDER BY date_time DESC LIMIT 1";
$resultbanka6a4 = $conn->query($sqlbanka6a4);
$databanka6a4 = $resultbanka6a4->fetch_assoc();

$sqlbanka7 = "SELECT pieces, amount FROM second_shift WHERE denomination = 'Coins' ORDER BY date_time DESC LIMIT 1";
$resultbanka7 = $conn->query($sqlbanka7);
$databanka7 = $resultbanka7->fetch_assoc();

$sqlbanka7a2 = "SELECT pieces, amount FROM second_shifta2 WHERE denomination = 'Coins' ORDER BY date_time DESC LIMIT 1";
$resultbanka7a2 = $conn->query($sqlbanka7a2);
$databanka7a2 = $resultbanka7a2->fetch_assoc();

$sqlbanka7a3 = "SELECT pieces, amount FROM second_shifta3 WHERE denomination = 'Coins' ORDER BY date_time DESC LIMIT 1";
$resultbanka7a3 = $conn->query($sqlbanka7a3);
$databanka7a3 = $resultbanka7a3->fetch_assoc();

$sqlbanka7a4 = "SELECT pieces, amount FROM second_shifta4 WHERE denomination = 'Coins' ORDER BY date_time DESC LIMIT 1";
$resultbanka7a4 = $conn->query($sqlbanka7a4);
$databanka7a4 = $resultbanka7a4->fetch_assoc();

$current_date = date("Y-m-d");
$sqlcollection = "SELECT * FROM collection";
$resultcollection = $conn->query($sqlcollection);

// $today = date('Y-m-d'); 
// $sqlsort = "SELECT * FROM shift WHERE DATE(shifta1_datetime) = '$today'";
// $resultsort = $conn->query($sqlsort);

$sqlcollection = "SELECT * FROM attendance";
$resultattendance = $conn->query($sqlcollection);

date_default_timezone_set('Asia/Kolkata'); // Ensure correct timezone
$today = date('Y-m-d');
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
$stmt->bind_param("ssss", $today, $today, $today, $today);
$stmt->execute();
$resultexp = $stmt->get_result();


$sqladvancea = "SELECT * FROM advancea ORDER BY id DESC LIMIT 1";
$resultadvancea = $conn->query($sqladvancea);
$dataadvancea = $resultadvancea->fetch_assoc();

// $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petroleum Table & Expense Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-left: 10px;
        }

        table {
            width: 98%;
            border-collapse: collapse;
            border: 2px solid black;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }

        .header {
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 5px;
        }


        .sub-header {
            font-size: 18px;
            font-weight: 700;
        }

        .blue-row {
            background-color: rgb(124, 216, 255);
            color: black;
            font-weight: 700;
            border-radius: 50;
        }

        .bpt {
            font-weight: 600;
            font-size: 28px;
        }

        .expense-section {
            /* margin-top: 10px; */
        }

        .expense-header {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
            font-size: 20px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #212529;
            color: #6c757d;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
        }

        footer a.brand {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        footer a.brand:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $totalb = isset($_SESSION['totalb']) ? $_SESSION['totalb'] : 0;
    $totalc = isset($_SESSION['totalc']) ? $_SESSION['totalc'] : 0;
    // $closingc = isset($_SESSION['closingc']) ? $_SESSION['closingc'] : 0;
    
    // Pehle sabhi values assign karni hongi taki undefined variable error na aaye
    $bank500 = (isset($databank['pieces']) ? $databank['pieces'] : 0) +
        (isset($databanka1['pieces']) ? $databanka1['pieces'] : 0) +
        (isset($databanka2['pieces']) ? $databanka2['pieces'] : 0) +
        (isset($databanka3['pieces']) ? $databanka3['pieces'] : 0);

    $bank200 = (isset($databanka2['pieces']) ? $databanka2['pieces'] : 0) +
        (isset($databanka3['pieces']) ? $databanka3['pieces'] : 0) +
        (isset($databanka4['pieces']) ? $databanka4['pieces'] : 0);

    $bank100 = (isset($databanka3['pieces']) ? $databanka3['pieces'] : 0) +
        (isset($databanka4['pieces']) ? $databanka4['pieces'] : 0) +
        (isset($databanka5['pieces']) ? $databanka5['pieces'] : 0);

    $bank50 = (isset($databanka4['pieces']) ? $databanka4['pieces'] : 0) +
        (isset($databanka5['pieces']) ? $databanka5['pieces'] : 0) +
        (isset($databanka6['pieces']) ? $databanka6['pieces'] : 0);

    $bank20 = (isset($databanka5['pieces']) ? $databanka5['pieces'] : 0) +
        (isset($databanka6['pieces']) ? $databanka6['pieces'] : 0);

    $bank10 = (isset($databanka6['pieces']) ? $databanka6['pieces'] : 0) +
        (isset($databanka7['pieces']) ? $databanka7['pieces'] : 0);

    // Coins amount
    $coins = isset($databanka7['amount']) ? $databanka7['amount'] : 0;

    // Calculate total amount for each note
    $bank500result = $bank500 * 500;
    $bank200result = $bank200 * 200;
    $bank100result = $bank100 * 100;

    $bank50result = $bank50 * 50;
    $bank20result = $bank20 * 20;
    $bank10result = $bank10 * 10;

    // Total Calculation Pehle Karein
    $totala = $bank200result + $bank100result + $bank50result + $bank20result + $bank10result + $coins;
    // $_SESSION = $totala;
    
    // Initialize Total Collection Variables
    if (!isset($_SESSION['total_collection'])) {
        $_SESSION['total_collection'] = [];
    }
    $grand_total = isset($_SESSION['grand_total']) ? $_SESSION['grand_total'] : 0;
    $total_pic = isset($_SESSION['total_pic']) ? $_SESSION['total_pic'] : 0;

    // Reset session values before calculation
    $_SESSION['total_collection'] = [];
    $_SESSION['grand_total'] = 0;
    $_SESSION['total_pic'] = 0;

    ?>


    <table style="margin-top: 50px;">
        <tr>
            <td style="font-weight: 900;" colspan="10" class="header">BHARAT PETROLEUM TRADERS - DHATKIDIH</td>
            <td rowspan="2" class="sub-header">REPORT</td>

        </tr>
        <tr>
            <td colspan="5" class="sub-header">SHIFT : A</td>
            <td colspan="5" class="sub-header">DATE : <?php echo date('d.m.Y'); ?></td>

        </tr>
        <tr>
            <td rowspan="2" class="bpt">BPT</td>
            <td colspan="2"><b>MACHINE NO. 01<br>PSN : 1299</b></td>
            <td colspan="2"><b>MACHINE NO. 02<br>PSN : 821V</b></td>
            <td colspan="2"><b>MACHINE NO. 03<br>PSN : 822V</b></td>
            <td colspan="4"><b>MACHINE NO. 04<br>PSN : M2311295</b></td>
        </tr>
        <tr>
            <td>NOZZLE - 01</td>
            <td>NOZZLE - 02</td>
            <td>NOZZLE - 01</td>
            <td>NOZZLE - 02</td>
            <td>NOZZLE - 01</td>
            <td>NOZZLE - 02</td>
            <td>FIP NO - 01</td>
            <td>FIP NO - 02</td>
            <td>FIP NO - 03</td>
            <td>FIP NO - 04</td>
        </tr>
        <tr class="blue-row">
            <td>PRODUCT</td>
            <td>XP - 95</td>
            <td>MS</td>
            <td>XP - 95</td>
            <td>MS</td>
            <td>HSD</td>
            <td>HD</td>
            <td>XG - 1</td>
            <td>XG - 2</td>
            <td>MS - 1</td>
            <td>MS - 2</td>
        </tr>
        <tr>
            <td>Closing Meter</td>
            <td><?= $data['xp_close_reading'] ?></td>
            <td><?= $data['ms_close_reading'] ?></td>
            <td><?= $data2['xp_close_reading'] ?></td>
            <td><?= $data2['ms_close_reading'] ?></td>
            <td><?= $data3['xp_close_reading'] ?></td>
            <td><?= $data3['ms_close_reading'] ?></td>
            <td><?= $data4['xg1_close_reading'] ?></td>
            <td><?= $data4['xg2_close_reading'] ?></td>
            <td><?= $data4['ms1_close_reading'] ?></td>
            <td><?= $data4['ms2_close_reading'] ?></td>
        </tr>
        <tr>
            <td>Opening Meter</td>
            <td><?= $data['xp_start_reading'] ?></td>
            <td><?= $data['ms_start_reading'] ?></td>
            <td><?= $data2['xp_start_reading'] ?></td>
            <td><?= $data2['ms_start_reading'] ?></td>
            <td><?= $data3['xp_start_reading'] ?></td>
            <td><?= $data3['ms_start_reading'] ?></td>
            <td><?= $data4['xg1_start_reading'] ?></td>
            <td><?= $data4['xg2_start_reading'] ?></td>
            <td><?= $data4['ms1_start_reading'] ?></td>
            <td><?= $data4['ms2_start_reading'] ?></td>
        </tr>
        <tr>
            <td>Sub Total</td>
            <td><?= $data['xp_reading_difference'] ?></td>
            <td><?= $data['ms_reading_difference'] ?></td>
            <td><?= $data2['xp_reading_difference'] ?></td>
            <td><?= $data2['ms_reading_difference'] ?></td>
            <td><?= $data3['xp_reading_difference'] ?></td>
            <td><?= $data3['ms_reading_difference'] ?></td>
            <td><?= $data4['xg1_reading_difference'] ?></td>
            <td><?= $data4['xg2_reading_difference'] ?></td>
            <td><?= $data4['ms1_reading_difference'] ?></td>
            <td><?= $data4['ms2_reading_difference'] ?></td>
        </tr>
        <tr>
            <td>Testing Less</td>
            <td><?= $data['xp_testing_less'] ?></td>
            <td><?= $data['ms_testing_less'] ?></td>
            <td><?= $data2['xp_testing_less'] ?></td>
            <td><?= $data2['ms_testing_less'] ?></td>
            <td><?= $data3['xp_testing_less'] ?></td>
            <td><?= $data3['ms_testing_less'] ?></td>
            <td><?= $data4['xg1_testing_less'] ?></td>
            <td><?= $data4['xg2_testing_less'] ?></td>
            <td><?= $data4['ms1_testing_less'] ?></td>
            <td><?= $data4['ms2_testing_less'] ?></td>
        </tr>
        <tr>
            <td>Net. Total Litre</td>
            <td><?= $data['xp_net_sale'] ?></td>
            <td><?= $data['ms_net_sale'] ?></td>
            <td><?= $data2['xp_net_sale'] ?></td>
            <td><?= $data2['ms_net_sale'] ?></td>
            <td><?= $data3['xp_net_sale'] ?></td>
            <td><?= $data3['ms_net_sale'] ?></td>
            <td><?= $data4['xg1_net_sale'] ?></td>
            <td><?= $data4['xg2_net_sale'] ?></td>
            <td><?= $data4['ms1_net_sale'] ?></td>
            <td><?= $data4['ms2_net_sale'] ?></td>
        </tr>
        <tr>
            <td><strong>Cash For B/D in A-shift</strong></td>
            <td></td>
            <td><?= $bank500result ?></td>

        </tr>
        <?php
        $_SESSION['closing_balance_a'] = $totala;
        ?>
        <tr>
            <td><strong>Closing Balance in A-shift</strong></td>
            <td></td>
            <td><?= $totala ?></td>

        </tr>
    </table>

    <!-- Expense & Creditors Section -->
    <div class="row">
        <div class="col-4">

            <!-- <div>Expense & Creditors Report</div> -->
            <table>
                <tr class="blue-row">
                    <td>Expense Type</td>
                    <td>Amount (INR)</td>
                </tr>
                <?php
                $total_expense = 0;
                if ($resultexp->num_rows > 0) {
                    while ($row = $resultexp->fetch_assoc()) {
                        $expense_name = htmlspecialchars($row['expense_name'], ENT_QUOTES, 'UTF-8');
                        $amount = number_format($row['total_amount'], 2, '.', ',');
                        $total_expense += $row['total_amount'];
                        echo "<tr>
                <td>{$expense_name}</td>
                <td>{$amount}</td>
              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No expenses found for today!</td></tr>";
                }
                $formatted_total = number_format($total_expense, 2, '.', ',');
                ?>
                <tr class="total-row">
                    <td>Total Expense + Creditors</td>
                    <td><?= $formatted_total ?></td>
                </tr>

            </table>
        </div>
        <div class="col-4">
            <!-- <div>Expense & Creditors Report</div> -->
            <table>
                <tr class="blue-row">
                    <td>Product</td>
                    <td>Total Ltr</td>
                    <td>Rate (Rs)</td>
                    <td>Amount</td>

                </tr>
                <tr>
                    <td>Ms</td>
                    <td>
                        <?php
                        $ms_total = $data['ms_net_sale'] + $data2['ms_net_sale'] + $data3['ms_net_sale'] + $data4['ms1_net_sale'] + $data4['ms2_net_sale'];
                        echo $ms_total;
                        ?>
                    </td>
                    <td><?= $datarate['ms_rate'] ?></td>
                    <td><?php $ms = $ms_total * $datarate['ms_rate'];
                    echo $ms;
                    ?></td>

                </tr>
                <tr>
                    <td>Xp-95</td>
                    <td><?php $xp_total = $data['xp_net_sale'] + $data2['xp_net_sale'];
                    echo $xp_total;
                    ?></td>
                    <td><?= $datarate['xp95_rate'] ?></td>
                    <td><?php $xp = $xp_total * $datarate['xp95_rate'];
                    echo $xp;
                    ?></td>
                </tr>
                <tr>
                    <td>HSD</td>
                    <td><?php $hsd_total = $data3['xp_net_sale'] + $data3['xp_net_sale'];
                    echo $hsd_total;
                    ?></td>
                    <td><?= $datarate['hsd_rate'] ?></td>
                    <td><?php $hsd = $hsd_total * $datarate['hsd_rate'];
                    echo $hsd; ?></td>
                </tr>
                <tr>
                    <td>XG</td>
                    <td><?php $hd_total = $data4['xg1_net_sale'] + $data4['xg2_net_sale'];
                    echo $hd_total;
                    ?></td>
                    <td><?= $datarate['hd_rate'] ?></td>
                    <td><?php $hd = $hd_total * $datarate['hd_rate'];
                    echo $hd; ?></td>
                </tr>
                <tr>
                    <td><strong>Total Sale</strong></td>
                    <td><strong><?php $total_sale = $ms_total + $xp_total + $hsd_total + $hd_total;
                    echo $total_sale; ?></strong>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Mobile-2T</strong></td>
                    <td>
                        <?php $M2t_total = $dataliquid['xg1_net_sale'] + $dataliquida2['xg1_net_sale'] + $dataliquida3['xg1_net_sale'] + $dataliquida4['xg1_net_sale'];
                        echo $M2t_total;
                        ?>
                    </td>
                    <td><?= $dataliquida2['xg1_rate'] ?></td>
                    <td><?php $m2 = $M2t_total * $dataliquida2['xg1_rate'];
                    echo $m2; ?></td>
                </tr>
                <tr>
                    <td><strong>Mobile-1 Ltr.</strong></td>
                    <td><?php $M1t_total = $dataliquid['xg2_net_sale'] + $dataliquida2['xg2_net_sale'] + $dataliquida3['xg2_net_sale'] + $dataliquida4['xg2_net_sale'];
                    echo $M1t_total;
                    ?></td>
                    <td><?= $dataliquida2['xg2_rate'] ?></td>
                    <td><?php $m1 = $M1t_total * $dataliquida2['xg2_rate'];
                    echo $m1; ?></td>
                </tr>
                <tr>
                    <td><strong>D Water 1 Ltr.</strong></td>
                    <td><?php $D1t_total = $dataliquid['ms1_net_sale'] + $dataliquida2['ms1_net_sale'] + $dataliquida3['ms1_net_sale'] + $dataliquida4['ms1_net_sale'];
                    echo $D1t_total;
                    ?></td>
                    <td><?= $dataliquida2['ms1_rate'] ?></td>
                    <td><?php $d1 = $D1t_total * $dataliquida2['ms1_rate'];
                    echo $d1; ?></td>
                </tr>
                <tr>
                    <td><strong>D Water 5 Ltr.</strong></td>
                    <td><?php $D5t_total = $dataliquid['ms2_net_sale'] + $dataliquida2['ms2_net_sale'] + $dataliquida3['ms2_net_sale'] + $dataliquida4['ms2_net_sale'];
                    echo $D5t_total;
                    ?></td>
                    <td><?= $dataliquida2['ms2_rate'] ?></td>
                    <td><?php $d5 = $D5t_total * $dataliquida2['ms2_rate'];
                    echo $d5; ?></td>
                </tr>
                <?php
                // ✅ Ensure `$grand_total` is initialized before usage
                // $grand_total = 0;
                ?>
                <tr class="total-row">
                    <td>Total Collections</td>
                    <td></td>
                    <td></td>
                    <td><?= $grand_total + $totalb ?></td>
                </tr>
                <tr class="total-row">
                    <td>Opening cash+coins</td>
                    <td></td>
                    <td></td>
                    <td><?= $totalb ?></td>
                </tr>
                <tr class="total-row">
                    <?php
                    $exp = $ms + $xp + $hsd + $hd + $m2 + $m1 + $d1 + $d5 + $grand_total + $totalb;
                    $totalli = $exp - $total_expense
                        ?>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td><strong>
                            <?= $totalli ?>
                        </strong></td>
                </tr>
                <tr class="total-row">
                    <td><strong>Difference Amount</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong><?= $total_pic - $totalli ?></strong></td>
                </tr>
            </table>
        </div>
        <div class="col-4">
            <!-- <div>Expense & Creditors Report</div> -->
            <table>
                <tr class="blue-row">
                    <td>MOP</td>
                    <td></td>
                    <td>AMOUNT</td>
                </tr>
                <tr>
                    <td>(ICICI+BOB)BANK</td>
                    <td></td>
                    <td>
                        <?php
                        $icici_bob_total =
                            $data['xp_card_amount'] + $data['ms_card_amount'] +
                            $data2['xp_card_amount'] + $data2['ms_card_amount'] +
                            $data3['xp_card_amount'] + $data3['ms_card_amount'] +
                            $data4['xg1_card_amount'] + $data4['xg2_card_amount'] +
                            $data4['ms1_card_amount'] + $data4['ms2_card_amount'];

                        echo $icici_bob_total;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>PAYTM</td>
                    <td></td>
                    <td>
                        <?php
                        $paytm_total =
                            $data['xp_paytm_amount'] + $data['ms_paytm_amount'] +
                            $data2['xp_paytm_amount'] + $data2['ms_paytm_amount'] +
                            $data3['xp_paytm_amount'] + $data3['ms_paytm_amount'] +
                            $data4['xg1_paytm_amount'] + $data4['xg2_paytm_amount'] +
                            $data4['ms1_paytm_amount'] + $data4['ms2_paytm_amount'];

                        echo $paytm_total;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>SUB.TOTAL</td>
                    <td></td>
                    <td>
                        <?php
                        $subtotal = $icici_bob_total + $paytm_total;
                        echo $subtotal;
                        ?>
                    </td>
                </tr>
                <tr class="blue-row">
                    <td>Notes</td>
                    <td>Pieces</td>
                    <td>Amount</td>
                </tr>
                <tr>
                    <td>RS.500</td>
                    <td>
                        <?php echo $bank500; ?>
                    </td>
                    <td><?php echo $bank500result; ?></td>
                </tr>
                <tr>
                    <td>RS.200</td>
                    <td>
                        <?php echo $bank200; ?>
                    </td>
                    <td>
                        <?php echo $bank200result; ?>
                    </td>
                </tr>
                <tr>
                    <td>RS.100</td>
                    <td>
                        <?php echo $bank100; ?>
                    </td>
                    <td>
                        <?php echo $bank100result; ?>
                    </td>
                </tr>
                <tr>
                    <td>RS.50</td>
                    <td>
                        <?php echo $bank50; ?>
                    </td>
                    <td>
                        <?php echo $bank50result; ?>
                    </td>
                </tr>
                <tr>
                    <td>RS.20</td>
                    <td>
                        <?php echo $bank20; ?>
                    </td>
                    <td>
                        <?php echo $bank20result; ?>
                    </td>
                </tr>
                <tr>
                    <td>RS.10</td>
                    <td>
                        <?php echo $bank10; ?>
                    </td>
                    <td>
                        <?php echo $bank10result; ?>
                    </td>
                </tr>
                <tr>
                    <td>Coins</td>
                    <td>
                        <?php echo $coins; ?>
                    </td>
                    <td>
                        <?php echo $coins; ?>
                    </td>
                </tr>
                <?php
                $advance = $dataadvancea['advancea'];
                $_SESSION['cashruning_sift_a'] = $advance; // Store value in session
                ?>
                <tr class="total-row">
                    <td>Cash for Runing-shift</td>
                    <td></td>

                    <td><?php echo $advance; ?></td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td></td>
                    <td><strong><?php $total_pic = $subtotal + $totala + $advance + $bank500result;
                    echo $total_pic; ?></strong>
                    </td>
                </tr>
                <?php
                $_SESSION['total_pic'] = $total_pic;

                ?>
            </table>
        </div>
        <div class="row">
            <div class="col-4">
                <?php
                $current_date = date("Y-m-d");

                // List of all collection tables
                $tables = ["collection", "collectiona2", "collectiona3", "collectiona4", "collectionb1", "collectionb2", "collectionb3", "collectionb4", "collectionc1", "collectionc2", "collectionc3", "collectionc4"];

                $total_collection = [];
                $grand_total = 0;

                echo '<table border="1"> 
        <tr class="blue-row">
            <td> COLLECTION NAME</td>
            <td>AMOUNT</td>
        </tr>';

                foreach ($tables as $table) {
                    $sql = "SELECT * FROM $table WHERE DATE(Date_And_Time) = '$current_date'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($datacollection = $result->fetch_assoc()) {
                            $employees = [
                                $datacollection['Employee_Name1'] => $datacollection['Amount1'],
                                $datacollection['Employee_Name2'] => $datacollection['Amount2']
                            ];

                            foreach ($employees as $name => $amount) {
                                if (!isset($total_collection[$name])) {
                                    $total_collection[$name] = 0;
                                }
                                $total_collection[$name] += $amount;
                                $grand_total += $amount;

                                echo "<tr>
                        <td>" . htmlspecialchars($name) . "</td>
                        <td>" . number_format($amount) . "</td>
                      </tr>";
                            }
                        }
                    }
                }

                // Total per employee
                foreach ($total_collection as $name => $total) {
                    echo "<tr class='total-row'>
            <td><strong>TOTAL (" . htmlspecialchars($name) . ")</strong></td>
            <td><strong>" . number_format($total) . "</strong></td>
          </tr>";
                }

                // Extra Hours
                $closingc = isset($_SESSION['closingc']) ? $_SESSION['closingc'] : 0;
                $grand_total += $closingc;

                echo "<tr>
        <td><strong>Extra Hours</strong></td>
        <td><strong>" . number_format($totalb) . "</strong></td>
      </tr>";

                echo "<tr class='grand-total-row'>
        <td><strong>GRAND TOTAL</strong></td>
        <td><strong>" . number_format($grand_total + $totalb) . "</strong></td>
      </tr>";

                $_SESSION['grand_total'] = $grand_total;

                echo '</table>';
                ?>


            </div>
            <div class="col-4">
                <?php
                $today = date('Y-m-d');
                $tables = ["shift", "shifta2", "shifta3", "shifta4"];
                $sqlQueries = [];

                foreach ($tables as $table) {
                    if ($table == "shifta4") {
                        $sqlQueries[] = "SELECT employee1 AS emp, xg1_sortage AS shortage, xg1_surplus AS surplus, datetime FROM $table WHERE DATE(datetime) = '$today'
                                     UNION ALL
                                     SELECT employee2, ms1_sortage, ms1_surplus, datetime FROM $table WHERE DATE(datetime) = '$today'
                                     UNION ALL
                                     SELECT employee3, ms2_sortage, ms2_surplus, datetime FROM $table WHERE DATE(datetime) = '$today'
                                     UNION ALL
                                     SELECT employee4, xg2_sortage, xg2_surplus, datetime FROM $table WHERE DATE(datetime) = '$today'";
                    } else {
                        $sqlQueries[] = "SELECT shifta1_emp1 AS emp, xp_sortage AS shortage, xp_surplus AS surplus, shifta1_datetime FROM $table WHERE DATE(shifta1_datetime) = '$today'
                                     UNION ALL
                                     SELECT shifta1_emp2, ms_sortage, ms_surplus, shifta1_datetime FROM $table WHERE DATE(shifta1_datetime) = '$today'";
                    }
                }

                $sqlsort = implode(" UNION ALL ", $sqlQueries);
                $resultsort = $conn->query($sqlsort);
                ?>

                <table border="1" style="margin-bottom: 45px;">
                    <tr class="blue-row">
                        <td>NAME</td>
                        <td>SHORTAGE</td>
                        <td>SURPLUS</td>
                    </tr>

                    <?php
                    // Total Shortage and Surplus Variables
                    $total_shortage = [];
                    $total_surplus = [];

                    // Check if Data Exists
                    if ($resultsort->num_rows > 0) {
                        while ($datacollection = $resultsort->fetch_assoc()) {
                            $name = $datacollection['emp'];
                            $shortage = $datacollection['shortage'];
                            $surplus = $datacollection['surplus'];

                            if (!isset($total_shortage[$name])) {
                                $total_shortage[$name] = 0;
                            }
                            if (!isset($total_surplus[$name])) {
                                $total_surplus[$name] = 0;
                            }

                            $total_shortage[$name] += $shortage;
                            $total_surplus[$name] += $surplus;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($name); ?></td>
                                <td><?= number_format($shortage); ?></td>
                                <td><?= number_format($surplus); ?></td>
                            </tr>
                            <?php
                        }

                        // Total Row for Each Employee
                        foreach ($total_shortage as $name => $shortage_total) {
                            $surplus_total = $total_surplus[$name] ?? 0;
                            ?>
                            <tr class="total-row">
                                <td><strong>TOTAL (<?= htmlspecialchars($name); ?>)</strong></td>
                                <td><strong><?= number_format($shortage_total); ?></strong></td>
                                <td><strong><?= number_format($surplus_total); ?></strong></td>
                            </tr>
                            <?php
                        }

                        // Grand total for all
                        $grand_shortage = array_sum($total_shortage);
                        $grand_surplus = array_sum($total_surplus);
                        ?>
                        <tr class="total-row"">
                            <td><strong>GRAND TOTAL</strong></td>
                            <td><strong><?= number_format($grand_shortage); ?></strong></td>
                            <td><strong><?= number_format($grand_surplus); ?></strong></td>
                        </tr>
                        <?php
                    } else {
                        echo "<tr><td colspan='3'>No data found</td></tr>";
                    }
                    ?>
                </table>


            </div>
            <div class=" col-4">
                        <table border="1">
                            <tr class="blue-row">
                                <td>EMPLOYEE NAME</td>
                                <td>IN TIME</td>
                                <td>OUT TIME</td>
                            </tr>

                            <?php
                            if ($resultattendance->num_rows > 0) {
                                while ($datacollection = $resultattendance->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($datacollection['employee_name']); ?></td>
                                        <td><?= htmlspecialchars($datacollection['in_time']); ?></td>
                                        <td><?= htmlspecialchars($datacollection['out_time']); ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'>No data found</td></tr>";
                            }
                            ?>

                        </table>
            </div>




        </div>
        <footer>
            <p><strong>Copyright © 2025 <a href="https://pcats.co.in/" class="brand" target="_blank">P-Cats,
                        Jamshedpur</a>.</strong> All
                rights reserved.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>


</body>

</html>