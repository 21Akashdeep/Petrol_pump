<?php
$conn = new mysqli("localhost", "root", "Rajukumar@21", "vendors");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Data from Database
$sql = "SELECT * FROM shiftb1 WHERE xp_close_reading ORDER BY shifta1_datetime DESC LIMIT 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$sql2 = "SELECT * FROM shiftb2 WHERE xp_close_reading ORDER BY shifta1_datetime DESC LIMIT 1";
$result2 = $conn->query($sql2);
$data2 = $result2->fetch_assoc();

$sql3 = "SELECT * FROM shiftb3 WHERE xp_close_reading IS NOT NULL ORDER BY shifta1_datetime DESC LIMIT 1";
$result3 = $conn->query($sql3);
$data3 = $result3->fetch_assoc();

$sql4 = "SELECT * FROM shiftb4 WHERE xg1_close_reading ORDER BY datetime DESC LIMIT 1";
$result4 = $conn->query($sql4);
$data4 = $result4->fetch_assoc();

$sqlrate = "SELECT * FROM rate ORDER BY created_at DESC LIMIT 1";
$resultrate = $conn->query($sqlrate);
$datarate = $resultrate->fetch_assoc();

$sqlliquid = "SELECT * FROM liquidb1 ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquid = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquidb2 ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida2 = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquidb3 ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida3 = $resultliquid->fetch_assoc();

$sqlliquid = "SELECT * FROM liquidb4 ORDER BY id DESC LIMIT 1";
$resultliquid = $conn->query($sqlliquid);
$dataliquida4 = $resultliquid->fetch_assoc();

$sqlbank = "SELECT * FROM bankb1 ORDER BY id DESC LIMIT 1";
$resultbank = $conn->query($sqlbank);
$databank = $resultbank->fetch_assoc();

$sqlbanka2 = "SELECT pieces, amount FROM second_shiftb1 WHERE denomination = 200 ORDER BY date_time DESC LIMIT 1";
$resultbanka2 = $conn->query($sqlbanka2);
$databanka2 = $resultbanka2->fetch_assoc();

$sqlbanka3 = "SELECT pieces, amount FROM second_shiftb1 WHERE denomination = 100 ORDER BY date_time DESC LIMIT 1";
$resultbanka3 = $conn->query($sqlbanka3);
$databanka3 = $resultbanka3->fetch_assoc();

$sqlbanka4 = "SELECT pieces, amount FROM second_shiftb1 WHERE denomination = 50 ORDER BY date_time DESC LIMIT 1";
$resultbanka4 = $conn->query($sqlbanka4);
$databanka4 = $resultbanka4->fetch_assoc();

$sqlbanka5 = "SELECT pieces, amount FROM second_shiftb1 WHERE denomination = 20 ORDER BY date_time DESC LIMIT 1";
$resultbanka5 = $conn->query($sqlbanka5);
$databanka5 = $resultbanka5->fetch_assoc();

$sqlbanka6 = "SELECT pieces, amount FROM second_shiftb1 WHERE denomination = 10 ORDER BY date_time DESC LIMIT 1";
$resultbanka6 = $conn->query($sqlbanka6);
$databanka6 = $resultbanka6->fetch_assoc();

$sqlbanka7 = "SELECT pieces, amount FROM second_shiftb1 WHERE denomination = 'Coins' ORDER BY date_time DESC LIMIT 1";
$resultbanka7 = $conn->query($sqlbanka7);
$databanka7 = $resultbanka7->fetch_assoc();

$sqlcollection = "SELECT * FROM collection";
$resultcollection = $conn->query($sqlcollection);
// $datacollection = $resultcollection->fetch_assoc();
// $total_collection = 0;
$today = date('Y-m-d'); 
$sqlsort = "SELECT * FROM shiftb1 WHERE DATE(shifta1_datetime) = '$today'";
$resultsort = $conn->query($sqlsort);

$sqladvanceb = "SELECT * FROM advanceb ORDER BY id DESC LIMIT 1";
$resultadvanceb = $conn->query($sqladvanceb);
$dataadvanceb = $resultadvanceb->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petroleum Table & Expense Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 2px solid black;
        /* margin-bottom: 20px; */
    }

    th,
    td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
    }

    .header {
        font-size: 20px;
        font-weight: bold;
        letter-spacing: 3px;
    }

    .sub-header {
        font-size: 18px;
        font-weight: bold;
    }

    .blue-row {
        background-color: #009FE3;
        color: white;
        font-weight: bold;
    }

    .bpt {
        font-weight: bold;
        font-size: 18px;
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
    }
    </style>
</head>

<body>
    <?php 
    session_start();
    // Pehle sabhi values assign karni hongi taki undefined variable error na aaye
    $bank500result = isset($databank['pieces']) ? $databank['pieces'] * 500 : 0;
    $bank200result = isset($databanka2['pieces']) ? $databanka2['pieces'] * 200 : 0;
    $bank100result = isset($databanka3['pieces']) ? $databanka3['pieces'] * 100 : 0;
    $bank50result  = isset($databanka4['pieces']) ? $databanka4['pieces'] * 50 : 0;
    $bank20result  = isset($databanka5['pieces']) ? $databanka5['pieces'] * 20 : 0;
    $bank10result  = isset($databanka6['pieces']) ? $databanka6['pieces'] * 10 : 0;
    $coinsresult   = isset($databanka7['amount']) ? $databanka7['amount'] * 1 : 0;

    // Total Calculation Pehle Karein
    $totalb = $bank200result + $bank100result + $bank50result + $bank20result + $bank10result + $coinsresult;
    $_SESSION['totalb'] = $totalb;

?>

 <!-- pdf generation -->


    <table id="expenseTable">
        <tr>
            <td colspan="10" class="header">BHARAT PETROLEUM TRADERS - DHATKIDIH</td>
        </tr>
        <tr>
            <td colspan="5" class="sub-header">SHIFT : B</td>
            <td colspan="5" class="sub-header">DATE : 21.02.2025</td>
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
            <td><?=$bank500result?></td>

        </tr>
        <tr>
            <td><strong>Closing Balance in A-shift</strong></td>
            <td></td>
            <td><?= $totalb?></td>

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
                <tr>
                    <td>BPT + SURF</td>
                    <td>280</td>
                </tr>
                <tr>
                    <td>JUMP</td>
                    <td>80</td>
                </tr>
                <tr>
                    <td>AMUL PARLOUR</td>
                    <td>3000</td>
                </tr>
                <tr>
                    <td>SHAGIR BHAI</td>
                    <td>7770</td>
                </tr>
                <tr>
                    <td>AFTAB BHAI (RAJU PANTER)</td>
                    <td>4000</td>
                </tr>
                <tr class="total-row">
                    <td>Total Expense + Creditors</td>
                    <td>15,130</td>
                </tr>
            </table>
        </div>
        <div class="col-4">
            <!-- <div>Expense & Creditors Report</div> -->
            <table>
                <tr class="blue-row">
                    <td>product</td>
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
                    <td><?= $ms_total * $datarate['ms_rate'] ?></td>

                </tr>
                <tr>
                    <td>Xp-95</td>
                    <td><?php $xp_total = $data['xp_net_sale'] + $data2['xp_net_sale'];
                    echo $xp_total;
                    ?></td>
                    <td><?= $datarate['xp95_rate'] ?></td>
                    <td><?= $xp_total * $datarate['xp95_rate'] ?></td>
                </tr>
                <tr>
                    <td>HSD</td>
                    <td><?php $hsd_total= $data3['xp_net_sale'] + $data3['xp_net_sale'];
                    echo $hsd_total;
                    ?></td>
                    <td><?= $datarate['hsd_rate'] ?></td>
                    <td><?= $hsd_total*$datarate['hsd_rate'] ?></td>
                </tr>
                <tr>
                    <td>XG</td>
                    <td><?php $hd_total= $data4['xg1_net_sale'] + $data4['xg2_net_sale'];
                    echo $hd_total;
                    ?></td>
                    <td><?= $datarate['hd_rate'] ?></td>
                    <td><?= $hd_total*$datarate['hd_rate'] ?></td>
                </tr>
                <tr>
                    <td><strong>Total Sale</strong></td>
                    <td><strong><?= $ms_total+$xp_total+$hsd_total+$hd_total ?></strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Mobile-2T</strong></td>
                    <td>
                        <?php $M2t_total= $dataliquid['xg1_net_sale']+ $dataliquida2['xg1_net_sale']+ $dataliquida3['xg1_net_sale']+ $dataliquida4['xg1_net_sale'];
                    echo $M2t_total;
                    ?></td>
                    <td><?= $dataliquida2['xg1_rate'] ?></td>
                    <td><?= $M2t_total*$dataliquida2['xg1_rate'] ?></td>
                </tr>
                <tr>
                    <td><strong>Mobile-1 Ltr.</strong></td>
                    <td><?php $M1t_total= $dataliquid['xg2_net_sale']+ $dataliquida2['xg2_net_sale']+ $dataliquida3['xg2_net_sale']+ $dataliquida4['xg2_net_sale'];
                    echo $M1t_total;
                    ?></td>
                    <td><?= $dataliquida2['xg2_rate'] ?></td>
                    <td><?=$M1t_total* $dataliquida2['xg2_rate'] ?></td>
                </tr>
                <tr>
                    <td><strong>D Water 1 Ltr.</strong></td>
                    <td><?php $D1t_total= $dataliquid['ms1_net_sale']+ $dataliquida2['ms1_net_sale']+ $dataliquida3['ms1_net_sale']+ $dataliquida4['ms1_net_sale'];
                    echo $D1t_total;
                    ?></td>
                    <td><?=$dataliquida2['ms1_rate'] ?></td>
                    <td><?=$D1t_total* $dataliquida2['ms1_rate'] ?></td>
                </tr>
                <tr>
                    <td><strong>D Water 5 Ltr.</strong></td>
                    <td><?php $D5t_total= $dataliquid['ms2_net_sale']+ $dataliquida2['ms2_net_sale']+ $dataliquida3['ms2_net_sale']+ $dataliquida4['ms2_net_sale'];
                    echo $D5t_total;
                    ?></td>
                    <td><?=$dataliquida2['ms2_rate'] ?></td>
                    <td><?=$D5t_total* $dataliquida2['ms2_rate'] ?></td>
                </tr>

                <tr class="total-row">
                    <td>Total Collections</td>
                    <td></td>
                    <td></td>
                    <td>15,130</td>
                </tr>
                <tr class="total-row">
                    <td>Opening cash+coins</td>
                    <td></td>
                    <td></td>
                    <td>15,130</td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td><strong>15,130</strong></td>
                </tr>
                <tr class="total-row">
                    <td><strong>Difference Amount</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong>15</strong></td>
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
                        <?php 
                        $bank500 = 
                            $databank['pieces'] ;

                        echo $bank500;
                    ?>
                    </td>
                    <td><?php 
                        $bank500result = 
                            $bank500*500 ;

                        echo $bank500result;
                    ?></td>
                </tr>
                <tr>
                    <td>RS.200</td>
                    <td>
                        <?php 
                        $bank200 = isset($databanka2['pieces']) ? $databanka2['pieces'] : 0;
                        echo $bank200;
                    ?>
                    </td>
                    <td>
                        <?php 
                        $bank200result = 
                            $bank200*200 ;

                        echo $bank200result;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>RS.100</td>
                    <td>
                        <?php 
                        $bank100 = 
                        $databanka3['pieces'] ;
                        echo $bank100;
                    ?>
                    </td>
                    <td>
                        <?php 
                        $bank100result = 
                            $bank100*100 ;

                        echo $bank100result;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>RS.50</td>
                    <td>
                        <?php 
                        $bank50 = 
                        $databanka4['pieces'] ;
                        echo $bank50;
                    ?>
                    </td>
                    <td>
                        <?php 
                        $bank50result = 
                            $bank50*50 ;

                        echo $bank50result;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>RS.20</td>
                    <td>
                        <?php 
                        $bank20 = 
                        $databanka5['pieces'] ;
                        echo $bank20;
                    ?>
                    </td>
                    <td>
                        <?php 
                        $bank20result = 
                            $bank20*20 ;

                        echo $bank20result;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>RS.10</td>
                    <td>
                        <?php 
                        $bank10 = 
                        $databanka6['pieces'] ;
                        echo $bank10;
                    ?>
                    </td>
                    <td>
                        <?php 
                        $bank10result = 
                            $bank10*10 ;

                        echo $bank10result;
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>Coins</td>
                    <td>
                        <?php 
                        $coins = 
                        $databanka7['amount'] ;
                        echo $coins;
                    ?>
                    </td>
                    <td>
                        <?php 
                        $coinsresult = 
                            $coins*1 ;

                        echo $coinsresult;
                    ?>
                    </td>
                </tr>
                <tr class="total-row">
                    <td>Runing coins(prev+crnt)</td>
                    <td></td>
                    <td>15,130</td>
                </tr>
                <tr class="total-row">
                    <td>Cash for Runing-shift</td>
                    <td></td>
                    <td><?= $dataadvanceb['advanceb'] ?></td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td></td>
                    <td><strong>15,130</strong></td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-4">
                <table border="1">
                    <tr class="blue-row">
                        <td>NAME</td>
                        <td>AMOUNT</td>
                    </tr>

                    <?php
                        // Total Collection Variables
                        $total_collection = [];

                        // Check if Data Exists
                        if ($resultcollection->num_rows > 0) {
                            while ($datacollection = $resultcollection->fetch_assoc()) {
                                // Employees and Amounts
                                $employees = [
                                    $datacollection['Employee_Name1'] => $datacollection['Amount1'],
                                    $datacollection['Employee_Name2'] => $datacollection['Amount2']
                                ];

                                // Loop through Employees and Display
                                foreach ($employees as $name => $amount) {
                                    if (!isset($total_collection[$name])) {
                                        $total_collection[$name] = 0;
                                    }
                                    $total_collection[$name] += $amount;
                                    ?>
                    <tr>
                        <td><?= htmlspecialchars($name); ?></td>
                        <td><?= number_format($amount); ?></td>
                    </tr>
                    <?php
                                }
                            }

                            // Total Row for Each Employee
                            foreach ($total_collection as $name => $total) {
                                ?>
                    <tr class="total-row">
                        <td><strong>TOTAL (<?= htmlspecialchars($name); ?>)</strong></td>
                        <td><strong><?= number_format($total); ?></strong></td>
                    </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='2'>No data found</td></tr>";
                        }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <table border="1">
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
                            // Employees with Shortage & Surplus
                            $employees = [
                                $datacollection['shifta1_emp1'] => [
                                    'shortage' => $datacollection['xp_sortage'],
                                    'surplus'  => $datacollection['xp_surplus']
                                ],
                                $datacollection['shifta1_emp2'] => [
                                    'shortage' => $datacollection['ms_sortage'],
                                    'surplus'  => $datacollection['ms_surplus']
                                ]
                            ];

                            // Loop through Employees and Display
                            foreach ($employees as $name => $data) {
                                if (!isset($total_shortage[$name])) {
                                    $total_shortage[$name] = 0;
                                }
                                if (!isset($total_surplus[$name])) {
                                    $total_surplus[$name] = 0;
                                }

                                $total_shortage[$name] += $data['shortage'];
                                $total_surplus[$name]  += $data['surplus'];
                                ?>
                    <tr>
                        <td><?= htmlspecialchars($name); ?></td>
                        <td><?= number_format($data['shortage']); ?></td>
                        <td><?= number_format($data['surplus']); ?></td>
                    </tr>
                    <?php
                            }
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
                    } else {
                        echo "<tr><td colspan='3'>No data found</td></tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="col-4">
                <table border="1">
                    <tr class="blue-row">
                        <td>EMPLOYEE NAME</td>
                        <td>IN TIME</td>
                        <td>OUT TIME</td>
                    </tr>

                    

                </table>
            </div>




        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

</body>

</html>