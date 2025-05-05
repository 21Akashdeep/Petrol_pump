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

// Fetch latest entry from the database
$sql = "SELECT * FROM shiftc1 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$latestData = $result->fetch_assoc(); // Fetch data as an associative array
// Fetch latest Shift C close reading
$sql_shiftC = "SELECT xp_close_reading FROM shiftb1 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_reading = isset($shiftC_data['xp_close_reading']) ? $shiftC_data['xp_close_reading'] : "";


$sql_shiftC = "SELECT ms_close_reading FROM shiftb1 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_ms_reading = isset($shiftC_data['ms_close_reading']) ? $shiftC_data['ms_close_reading'] : "";

// Fetch latest Shift A entry (if needed)
$sql_shiftA = "SELECT * FROM shiftc1 ORDER BY id DESC LIMIT 1";
$result_shiftA = $conn->query($sql_shiftA);
$latestData = $result_shiftA->fetch_assoc();

?>

<div class="container-box">
    <div class="containe">
        <p class="machine-info">BPT SHIFT C</p>
        <div class="machine-info">MACHINE NO. 01</div>
        <div class="machine-info">PSN: 1299</div>
    </div>

    <form action="shiftCm1DB.php" method="POST">
        <div class="row mb-3 mt-2">
            <div class="col-12 d-flex align-items-center">
                <label class="me-2"><strong>Date_&_Time:</strong></label>
                <input type="text" class="form-control" name="shifta1_datetime"
                    value="<?php echo isset($latestData['shifta1_datetime']) ? $latestData['shifta1_datetime'] : date('d/m/Y H:i:s'); ?>"
                    readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-4"><strong>product</strong></div>
            <div class="col-4">
                <select class="form-select" name="shifta1_product1">
                    <option>Select product</option>
                    <option value="XP-95"
                        <?php echo (isset($latestData['shifta1_product1']) && $latestData['shifta1_product1'] == "XP-95") ? "selected" : ""; ?>>
                        XP-95</option>
                    <option value="MS"
                        <?php echo (isset($latestData['shifta1_product1']) && $latestData['shifta1_product1'] == "MS") ? "selected" : ""; ?>>
                        MS</option>
                </select>
            </div>
            <div class="col-4">
                <select class="form-select" name="shifta1_product2">
                    <option>Select product</option>
                    <option value="XP-95"
                        <?php echo (isset($latestData['shifta1_product2']) && $latestData['shifta1_product2'] == "XP-95") ? "selected" : ""; ?>>
                        XP-95</option>
                    <option value="MS"
                        <?php echo (isset($latestData['shifta1_product2']) && $latestData['shifta1_product2'] == "MS") ? "selected" : ""; ?>>
                        MS</option>
                </select>
            </div>
        </div>

        <!-- Employee Selection -->
        <div class="row mb-3">
            <div class="col-4"><strong>Select Employee</strong></div>
            <div class="col-4">
                <select class="form-select" name="shifta1_emp1">
                    <option>Select Employee</option>
                    <option value="Employee 1"
                        <?php echo (isset($latestData['shifta1_emp1']) && $latestData['shifta1_emp1'] == "Employee 1") ? "selected" : ""; ?>>
                        Employee 1</option>
                    <option value="Employee 2"
                        <?php echo (isset($latestData['shifta1_emp1']) && $latestData['shifta1_emp1'] == "Employee 2") ? "selected" : ""; ?>>
                        Employee 2</option>
                </select>
            </div>
            <div class="col-4">
                <select class="form-select" name="shifta1_emp2">
                    <option>Select Employee</option>
                    <option value="Employee 1"
                        <?php echo (isset($latestData['shifta1_emp2']) && $latestData['shifta1_emp2'] == "Employee 1") ? "selected" : ""; ?>>
                        Employee 1</option>
                    <option value="Employee 2"
                        <?php echo (isset($latestData['shifta1_emp2']) && $latestData['shifta1_emp2'] == "Employee 2") ? "selected" : ""; ?>>
                        Employee 2</option>
                </select>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-4"><strong>Nozzle</strong></div>
            <div class="col-4">
                <select class="form-select" name="shifta1_nozzle1">
                    <option>Select Nozzle</option>
                    <option value="Nozzle 1"
                        <?php echo (isset($latestData['shifta1_nozzle1']) && $latestData['shifta1_nozzle1'] == "Nozzle 1") ? "selected" : ""; ?>>
                        Nozzle 1</option>
                    <option value="Nozzle 2"
                        <?php echo (isset($latestData['shifta1_nozzle1']) && $latestData['shifta1_nozzle1'] == "Nozzle 2") ? "selected" : ""; ?>>
                        Nozzle 2</option>
                </select>
            </div>

            <div class="col-4">
                <select class="form-select" name="shifta1_nozzle2">
                    <option>Select Nozzle</option>
                    <option value="Nozzle 1"
                        <?php echo (isset($latestData['shifta1_nozzle2']) && $latestData['shifta1_nozzle2'] == "Nozzle 1") ? "selected" : ""; ?>>
                        Nozzle 1</option>
                    <option value="Nozzle 2"
                        <?php echo (isset($latestData['shifta1_nozzle2']) && $latestData['shifta1_nozzle2'] == "Nozzle 2") ? "selected" : ""; ?>>
                        Nozzle 2</option>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4"><strong>Open Reading</strong></div>
            <div class="col-4">
                <input type="text" class="form-control" name="xp_start_reading"id="xp_start_reading"
                    value="<?php echo $shiftC_close_reading; ?>" readonly>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" name="ms_start_reading"id="ms_start_reading"
                    value="<?php echo $shiftC_close_ms_reading; ?>" readonly>
            </div>
        </div>
        <?php
                    $fields = ["Close Reading", "Reading Difference", "Testing Less", "Net Sale", "Rate", "Cash", "Paytm machine No.", "Paytm Amount", "Card Machine No.", "Card Amount", "Sortage", "Surplus", "Total Amount"];
                    $paytm_numbers = ["1", "2", "3", "4", "5"]; // Predefined Paytm numbers
                    $cash_denominations = ["1", "2", "3", "4", "5"]; // Predefined Card machine numbers

                    foreach ($fields as $field) {
                        $field_db = strtolower(str_replace([" ", "."], "_", $field)); // Convert field name to match database column
                        $is_reading_difference = ($field == "Reading Difference");
                        $is_net_sale = ($field == "Net Sale");
                        $is_total_amount = ($field == "Total Amount");

                        echo '<div class="row mb-2">
                                <div class="col-4">' . $field . '</div>';

                        if ($field == "Paytm machine No.") {
                            // Paytm Machine No. dropdown
                            echo '<div class="col-4">
                                    <select class="form-select" name="xp_' . $field_db . '" id="xp_' . $field_db . '">';
                            foreach ($paytm_numbers as $number) {
                                $selected = (isset($latestData['xp_' . $field_db]) && $latestData['xp_' . $field_db] == $number) ? "selected" : "";
                                echo '<option value="' . $number . '" ' . $selected . '>' . $number . '</option>';
                            }
                            echo '</select>
                                </div>';

                            echo '<div class="col-4">
                                    <select class="form-select" name="ms_' . $field_db . '" id="ms_' . $field_db . '">';
                            foreach ($paytm_numbers as $number) {
                                $selected = (isset($latestData['ms_' . $field_db]) && $latestData['ms_' . $field_db] == $number) ? "selected" : "";
                                echo '<option value="' . $number . '" ' . $selected . '>' . $number . '</option>';
                            }
                            echo '</select>
                                </div>';
                        } elseif ($field == "Card Machine No.") {
                            // Card Machine No. dropdown
                            echo '<div class="col-4">
                                    <select class="form-select" name="xp_' . $field_db . '" id="xp_' . $field_db . '">';
                            foreach ($cash_denominations as $denomination) {
                                $selected = (isset($latestData['xp_' . $field_db]) && $latestData['xp_' . $field_db] == $denomination) ? "selected" : "";
                                echo '<option value="' . $denomination . '" ' . $selected . '>' . $denomination . '</option>';
                            }
                            echo '</select>
                                </div>';

                            echo '<div class="col-4">
                                    <select class="form-select" name="ms_' . $field_db . '" id="ms_' . $field_db . '">';
                            foreach ($cash_denominations as $denomination) {
                                $selected = (isset($latestData['ms_' . $field_db]) && $latestData['ms_' . $field_db] == $denomination) ? "selected" : "";
                                echo '<option value="' . $denomination . '" ' . $selected . '>' . $denomination . '</option>';
                            }
                            echo '</select>
                                </div>';
                        } elseif ($is_total_amount) {
                            // Total Amount (READONLY)
                            echo '<div class="col-4">
                                    <input type="text" class="form-control" name="xp_' . $field_db . '" id="xp_' . $field_db . '" 
                                    value="' . (isset($latestData['xp_' . $field_db]) ? $latestData['xp_' . $field_db] : "") . '" 
                                    >
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="ms_' . $field_db . '" id="ms_' . $field_db . '" 
                                    value="' . (isset($latestData['ms_' . $field_db]) ? $latestData['ms_' . $field_db] : "") . '" 
                                    >
                                </div>';
                        } else {
                            // Normal input fields
                            echo '<div class="col-4">
                                    <input type="text" class="form-control" 
                                    name="xp_' . $field_db . '" id="xp_' . $field_db . '" 
                                    value="' . (isset($latestData['xp_' . $field_db]) ? $latestData['xp_' . $field_db] : "") . '" 
                                    ' . ($is_reading_difference || $is_net_sale ? 'readonly' : '') . '>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" 
                                    name="ms_' . $field_db . '" id="ms_' . $field_db . '" 
                                    value="' . (isset($latestData['ms_' . $field_db]) ? $latestData['ms_' . $field_db] : "") . '" 
                                    ' . ($is_reading_difference || $is_net_sale ? 'readonly' : '') . '>
                                </div>';
                        }

                        echo '</div>';
                    }
                ?>
        <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
    </form>
    <div class="row mt-2">
        <div class="row">
            <div class="col-3">
            <a href="moneycash/m1moneycash.php" class="">Add your cash</a>
            </div>
            <div class="col-3">
            <a href="addliquid/m1addliquid.php" class="">Add Liquid</a>

            </div>
            <div class="col-3">
            <a href="addexpenses/m1addExpenses.php" class="">Expenses</a>

            </div>
            <div class="col-3">
                <a href="collection/m1collectionreport.php" class="">Collection</a>

            </div>

        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        function calculateDifference(type) {
            let startReading = document.getElementById(type + "_start_reading");
            let closeReading = document.getElementById(type + "_close_reading");
            let readingDifference = document.getElementById(type + "_reading_difference");
            let testingLess = document.getElementById(type + "_testing_less");
            let netSale = document.getElementById(type + "_net_sale");

            if (startReading && closeReading && readingDifference) {
                startReading.addEventListener("input", updateValues);
                closeReading.addEventListener("input", updateValues);
            }

            if (readingDifference && testingLess && netSale) {
                readingDifference.addEventListener("input", updateNetSale);
                testingLess.addEventListener("input", updateNetSale);
            }

            function updateValues() {
                let start = parseFloat(startReading.value) || 0;
                let close = parseFloat(closeReading.value) || 0;
                readingDifference.value = (close - start).toFixed(2);
                updateNetSale();
            }

            function updateNetSale() {
                let readingDiff = parseFloat(readingDifference.value) || 0;
                let testLess = parseFloat(testingLess.value) || 0;
                netSale.value = (readingDiff - testLess).toFixed(2);
            }
        }

        calculateDifference("xp"); // For XP fields
        calculateDifference("ms"); // For MS fields

        function calculateTotalAmount(prefix) {
            let netSale = parseFloat(document.getElementById(prefix + "_net_sale").value) || 0;
            let rate = parseFloat(document.getElementById(prefix + "_rate").value) || 0;
            let totalAmount = netSale * rate;
            document.getElementById(prefix + "_total_amount").value = totalAmount.toFixed(2);

            calculateShortageSurplus(prefix);
        }

        function calculateShortageSurplus(prefix) {
            let totalAmount = parseFloat(document.getElementById(prefix + "_total_amount").value) || 0;
            let cashAmount = parseFloat(document.getElementById(prefix + "_cash").value) || 0;
            let paytmAmount = parseFloat(document.getElementById(prefix + "_paytm_amount").value) || 0;
            let cardAmount = parseFloat(document.getElementById(prefix + "_card_amount").value) || 0;

            let sumOfAmounts = cashAmount + paytmAmount + cardAmount;
            let shortage = 0,
                surplus = 0;

            if (totalAmount > sumOfAmounts) {
                shortage = totalAmount - sumOfAmounts; // When payments are less than total amount
            } else if (sumOfAmounts > totalAmount) {
                surplus = sumOfAmounts - totalAmount; // When payments exceed total amount
            }

            document.getElementById(prefix + "_shortage").value = shortage.toFixed(2);
            document.getElementById(prefix + "_surplus").value = surplus.toFixed(2);
        }

        ["xp", "ms"].forEach(prefix => {
            document.getElementById(prefix + "_net_sale").addEventListener("input", function() {
                calculateTotalAmount(prefix);
            });

            document.getElementById(prefix + "_rate").addEventListener("input", function() {
                calculateTotalAmount(prefix);
            });

            ["cash", "paytm_amount", "card_amount"].forEach(field => {
                document.getElementById(prefix + "_" + field).addEventListener("input",
                    function() {
                        calculateShortageSurplus(prefix);
                    });
            });
        });
    });
    </script>
</div>