<?php
$conn = new mysqli("localhost", "root", "Rajukumar@21", "vendors");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Data from Database
$sql = "SELECT * FROM shift WHERE xp_close_reading ORDER BY shifta1_datetime DESC LIMIT 1";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$sql2 = "SELECT * FROM shifta2 WHERE xp_close_reading ORDER BY shifta1_datetime DESC LIMIT 1";
$result2 = $conn->query($sql2);
$data2 = $result2->fetch_assoc();

$sql3 = "SELECT * FROM shifta3 WHERE xp_close_reading ORDER BY shifta1_datetime DESC LIMIT 1";
$result3 = $conn->query($sql3);
$data3 = $result3->fetch_assoc();

$sql4 = "SELECT * FROM shifta4 WHERE xg1_close_reading ORDER BY datetime DESC LIMIT 1";
$result4 = $conn->query($sql4);
$data4 = $result4->fetch_assoc();

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

    <table>
        <tr>
            <td colspan="10" class="header">BHARAT PETROLEUM TRADERS - DHATKIDIH</td>
        </tr>
        <tr>
            <td colspan="5" class="sub-header">SHIFT : A</td>
            <td colspan="5" class="sub-header">DATE : 23.01.2025</td>
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
            <td>323.32</td>
            
        </tr>
        <tr>
            <td><strong>Closing Balance in A-shift</strong></td>
            <td></td>
            <td>5944</td>
            
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
                    <td><?= $data['ms_net_sale'] + $data2['ms_net_sale'] + $data3['ms_net_sale'] + $data4['ms1_net_sale'] + $data4['ms2_net_sale'] ?></td>
                    <td>97.8</td>
                    <td>4645465</td>

                </tr>
                <tr>
                    <td>Xp-95</td>
                    <td><?= $data['xp_net_sale'] + $data2['xp_net_sale']?></td>
                    <td>80</td>
                    <td>80</td>
                </tr>
                <tr>
                    <td>HSD</td>
                    <td><?= $data3['xp_net_sale'] + $data3['xp_net_sale']?></td>
                    <td>300</td>
                    <td>300</td>
                </tr>
                <tr>
                    <td>XG</td>
                    <td><?= $data4['xg1_net_sale'] + $data4['xg2_net_sale']?></td>
                    <td>70</td>
                    <td>70</td>
                </tr>
                <tr>
                    <td><strong>Total Sale</strong></td>
                    <td></td>
                    <td></td>
                    <td>4000</td>
                </tr>
                <tr>
                    <td><strong>Mobile-2T</strong></td>
                    <td>40</td>
                    <td>40</td>
                    <td>40</td>
                </tr>
                <tr>
                    <td><strong>Mobile-1 Ltr.</strong></td>
                    <td>4000</td>
                    <td>4000</td>
                    <td>4000</td>
                </tr>
                <tr>
                    <td><strong>D Water 1 Ltr.</strong></td>
                    <td>4000</td>
                    <td>4000</td>
                    <td>4000</td>
                </tr>
                <tr>
                    <td><strong>D Water 5 Ltr.</strong></td>
                    <td>4000</td>
                    <td>4000</td>
                    <td>4000</td>
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
                    <td>1555.96</td>
                </tr>
                <tr>
                    <td>PAYTM</td>
                    <td></td>
                    <td>8022</td>
                </tr>
                <tr>
                    <td>SUB.TOTAL</td>
                    <td></td>
                    <td>3020</td>
                </tr>
                <tr class="blue-row">
                    <td>Notes</td>
                    <td>Pieces</td>
                    <td>Amount</td>
                </tr>
                <tr>
                    <td>RS.70</td>
                    <td>70</td>
                    <td>70</td>
                </tr>
                <tr>
                    <td>RS.70</td>
                    <td>70</td>
                    <td>70</td>
                </tr>
                <tr>
                    <td>RS.70</td>
                    <td>70</td>
                    <td>70</td>
                </tr>
                <tr>
                    <td>RS.70</td>
                    <td>70</td>
                    <td>70</td>
                </tr>

                <tr class="total-row">
                    <td>Runing coins(prev+crnt)</td>
                    <td></td>
                    <td>15,130</td>
                </tr>
                <tr class="total-row">
                    <td>Cash for Runing-shift</td>
                    <td></td>
                    <td>15,130</td>
                </tr>
                <tr class="total-row">
                    <td>Total</td>
                    <td></td>
                    <td><strong>15,130</strong></td>
                </tr>
            </table>
        </div>

        <table>
            <tr class="blue-row">
                <td>COLLECTIONS REPORTS</td>
                <td>AMOUNT</td>
                <td>NAME</td>
                <td>SHORTAGE</td>
                <td>SURPLUS</td>
                
            </tr>
            <tr>
                <td>EXTRA HOURS</td>
                <td>34233</td>
                <td>AKASHDEEP</td>
                <td>34</td>
                <td>3</td>
                
            </tr>
            <tr>
                <td>EXTRA HOURS</td>
                <td>34233</td>
                <td>AKASHDEEP</td>
                <td>34</td>
                <td>3</td>
                
            </tr>
            <tr>
                <td>EXTRA HOURS</td>
                <td>34233</td>
                <td>AKASHDEEP</td>
                <td>34</td>
                <td>3</td>
                
            </tr>
            <tr>
                <td>EXTRA HOURS</td>
                <td>34233</td>
                <td>AKASHDEEP</td>
                <td>34</td>
                <td>3</td>
                
            </tr>


            <tr class="total-row">
                <td>TOTAL COLLECTIONS</td>
                <td>15,130</td>
                <td>TOTAL SHORTAGE AMOUNT</td>
                <td>4</td>
                <td>14</td>
            </tr>
        </table>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>