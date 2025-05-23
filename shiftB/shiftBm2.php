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
$sql = "SELECT * FROM shiftb2 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$latestData = $result->fetch_assoc(); // Fetch data as an associative array

// Fetch latest Shift C close reading
$sql_shiftC = "SELECT xp_close_reading FROM shifta2 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_reading = isset($shiftC_data['xp_close_reading']) ? $shiftC_data['xp_close_reading'] : "";


$sql_shiftC = "SELECT ms_close_reading FROM shifta2 ORDER BY id DESC LIMIT 1";
$result_shiftC = $conn->query($sql_shiftC);
$shiftC_data = $result_shiftC->fetch_assoc();
$shiftC_close_ms_reading = isset($shiftC_data['ms_close_reading']) ? $shiftC_data['ms_close_reading'] : "";

// Fetch latest Shift A entry (if needed)
$sql_shiftA = "SELECT * FROM shiftb2 ORDER BY id DESC LIMIT 1";
$result_shiftA = $conn->query($sql_shiftA);
$latestData = $result_shiftA->fetch_assoc();

// Employee list fetch karna
$employees = [];
$sql = "SELECT id, company_name FROM employee";  // Apni employee table ka actual naam yaha likhein
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
date_default_timezone_set('Asia/Kolkata');

?>

<div class="container-box">
    <div class="containe">
        <p class="machine-info">BPT SHIFT B</p>
        <div class="machine-info">MACHINE NO. 02</div>
        <div class="machine-info">PSN: 1299</div>
    </div>

    <form action="shiftBm2DB.php" method="POST">
        <div class="row mb-3 mt-2">
            <div class="col-12 d-flex align-items-center">
                <label class="me-2"><strong>Date & Time:</strong></label>
                <input type="datetime-local" class="form-control" name="shifta1_datetime"
                    value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
            </div>

        </div>
        <div class="row mb-3">
            <div class="col-4"><strong>Select product</strong></div>
            <div class="col-4">
                <select class="form-select" name="shifta1_product1" disabled>
                    <option value="XP-95"
                        <?php echo (isset($latestData['shifta1_product1']) && $latestData['shifta1_product1'] == "XP-95") ? "selected" : ""; ?>>
                        XP-95
                    </option>
                    <option value="MS"
                        <?php echo (isset($latestData['shifta1_product1']) && $latestData['shifta1_product1'] == "MS") ? "selected" : ""; ?>>
                        MS
                    </option>
                </select>
                <input type="hidden" name="shifta1_product1"
                    value="<?php echo isset($latestData['shifta1_product1']) ? htmlspecialchars($latestData['shifta1_product1']) : ''; ?>">
            </div>
            <div class="col-4">
                <select class="form-select" name="shifta1_product2" disabled>
                    <option value="MS"
                        <?php echo (isset($latestData['shifta1_product2']) && $latestData['shifta1_product2'] == "MS") ? "selected" : ""; ?>>
                        MS
                    </option>
                    <option value="XP-95"
                        <?php echo (isset($latestData['shifta1_product2']) && $latestData['shifta1_product2'] == "XP-95") ? "selected" : ""; ?>>
                        XP-95
                    </option>

                </select>
                <input type="hidden" name="shifta1_product2"
                    value="<?php echo isset($latestData['shifta1_product2']) ? htmlspecialchars($latestData['shifta1_product2']) : ''; ?>">
            </div>
        </div>

        <!-- Employee Selection -->
        <div class="row mb-3">
            <div class="col-4"><strong>Select Employee</strong></div>
            <div class="col-4">
                <select class="form-select" name="shifta1_emp1">
                    <option value="">Select Employee</option>
                    <?php foreach ($employees as $employee) { ?>
                    <option value="<?php echo $employee['company_name']; ?>"
                        <?php echo (isset($latestData['shifta1_emp1']) && $latestData['shifta1_emp1'] == $employee['company_name']) ? "selected" : ""; ?>>
                        <?php echo $employee['company_name']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-4">
                <select class="form-select" name="shifta1_emp2">
                    <option value="">Select Employee</option>
                    <?php foreach ($employees as $employee) { ?>
                    <option value="<?php echo $employee['company_name']; ?>"
                        <?php echo (isset($latestData['shifta1_emp2']) && $latestData['shifta1_emp2'] == $employee['company_name']) ? "selected" : ""; ?>>
                        <?php echo $employee['company_name']; ?>
                    </option>
                    <?php } ?>
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
                <input type="text" class="form-control" name="xp_start_reading" id="xpm2_start_reading"
                    value="<?php echo $shiftC_close_reading; ?>" readonly>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" name="ms_start_reading" id="msm2_start_reading"
                    value="<?php echo $shiftC_close_ms_reading; ?>" readonly>
            </div>
        </div>
        <?php
// Database connection required
// include '../db_connect.php'; 

// Rate table se data fetch karna
$xp95_rate = "";
$ms_rate = "";
$query = "SELECT xp95_rate, ms_rate FROM rate";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $xp95_rate = $row['xp95_rate'];
        $ms_rate = $row['ms_rate'];
    }
} else {
    die("Query Failed: " . mysqli_error($conn)); // Debugging ke liye
}

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

    if ($field == "Rate") {
        // Rate field - Fetch from database
        echo '<div class="col-4">
                <input type="text" class="form-control" name="xp_' . $field_db . '" id="xpm2_' . $field_db . '" 
                value="' . $xp95_rate . '" readonly>
              </div>
              <div class="col-4">
                <input type="text" class="form-control" name="ms_' . $field_db . '" id="msm2_' . $field_db . '" 
                value="' . $ms_rate . '" readonly>
              </div>';
    } elseif ($field == "Paytm machine No.") {
        // Paytm Machine No. dropdown
        echo '<div class="col-4">
                <select class="form-select" name="xp_' . $field_db . '" id="xpm2_' . $field_db . '">';
        foreach ($paytm_numbers as $number) {
            $selected = (isset($latestData['xp_' . $field_db]) && $latestData['xp_' . $field_db] == $number) ? "selected" : "";
            echo '<option value="' . $number . '" ' . $selected . '>' . $number . '</option>';
        }
        echo '</select>
            </div>';

        echo '<div class="col-4">
                <select class="form-select" name="ms_' . $field_db . '" id="msm2_' . $field_db . '">';
        foreach ($paytm_numbers as $number) {
            $selected = (isset($latestData['ms_' . $field_db]) && $latestData['ms_' . $field_db] == $number) ? "selected" : "";
            echo '<option value="' . $number . '" ' . $selected . '>' . $number . '</option>';
        }
        echo '</select>
            </div>';
    } elseif ($field == "Card Machine No.") {
        // Card Machine No. dropdown
        echo '<div class="col-4">
                <select class="form-select" name="xp_' . $field_db . '" id="xpm2_' . $field_db . '">';
        foreach ($cash_denominations as $denomination) {
            $selected = (isset($latestData['xp_' . $field_db]) && $latestData['xp_' . $field_db] == $denomination) ? "selected" : "";
            echo '<option value="' . $denomination . '" ' . $selected . '>' . $denomination . '</option>';
        }
        echo '</select>
            </div>';

        echo '<div class="col-4">
                <select class="form-select" name="ms_' . $field_db . '" id="msm2_' . $field_db . '">';
        foreach ($cash_denominations as $denomination) {
            $selected = (isset($latestData['ms_' . $field_db]) && $latestData['ms_' . $field_db] == $denomination) ? "selected" : "";
            echo '<option value="' . $denomination . '" ' . $selected . '>' . $denomination . '</option>';
        }
        echo '</select>
            </div>';
    } elseif ($is_total_amount) {
        // Total Amount
        echo '<div class="col-4">
                <input type="text" class="form-control" name="xp_' . $field_db . '" id="xpm2_' . $field_db . '" 
                value="' . (isset($latestData['xp_' . $field_db]) ? $latestData['xp_' . $field_db] : "") . '">
              </div>
              <div class="col-4">
                <input type="text" class="form-control" name="ms_' . $field_db . '" id="msm2_' . $field_db . '" 
                value="' . (isset($latestData['ms_' . $field_db]) ? $latestData['ms_' . $field_db] : "") . '">
              </div>';
    } else {
        // Normal input fields
        echo '<div class="col-4">
                <input type="text" class="form-control" 
                name="xp_' . $field_db . '" id="xpm2_' . $field_db . '" 
                value="' . (isset($latestData['xp_' . $field_db]) ? $latestData['xp_' . $field_db] : "") . '" 
                ' . ($is_reading_difference || $is_net_sale ? 'readonly' : '') . '>
              </div>
              <div class="col-4">
                <input type="text" class="form-control" 
                name="ms_' . $field_db . '" id="msm2_' . $field_db . '" 
                value="' . (isset($latestData['ms_' . $field_db]) ? $latestData['ms_' . $field_db] : "") . '" 
                ' . ($is_reading_difference || $is_net_sale ? 'readonly' : '') . '>
              </div>';
    }

    echo '</div>';
}
?>
        <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
    </form>
    <div class="row mt-3 mb-3">
    <div class="col-3">
        <a href="moneycash/m2moneyreport.php" class="btn btn-primary w-100">Add Cash</a>
    </div>
    <div class="col-3">
        <a href="m2liquid/liquidlist.php" class="btn btn-success w-100">Add Liquid</a>
    </div>
    <div class="col-3">
        <a href="expensem2/explist.php" class="btn btn-warning w-100">Expenses</a>
    </div>
    <div class="col-3">
        <a href="collection/m2collectionreport.php" class="btn btn-info w-100">Collection</a>
    </div>
</div>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    function calculateValues(prefix) {
        let startReading = parseFloat(document.getElementById(prefix + "_start_reading")?.value) || 0;
        let closeReading = parseFloat(document.getElementById(prefix + "_close_reading")?.value) || 0;
        let testingLess = parseFloat(document.getElementById(prefix + "_testing_less")?.value) || 0;
        let rate = parseFloat(document.getElementById(prefix + "_rate")?.value) || 0;

        let readingDifference = closeReading - startReading;
        let netSale = readingDifference - testingLess;
        let totalAmount = netSale * rate;

        if (document.getElementById(prefix + "_reading_difference"))
            document.getElementById(prefix + "_reading_difference").value = readingDifference.toFixed(2);

        if (document.getElementById(prefix + "_net_sale"))
            document.getElementById(prefix + "_net_sale").value = netSale.toFixed(2);

        if (document.getElementById(prefix + "_total_amount"))
            document.getElementById(prefix + "_total_amount").value = totalAmount.toFixed(2);
    }

    ["xpm2", "msm2"].forEach(function(prefix) {
        ["start_reading", "close_reading", "testing_less", "rate"].forEach(function(field) {
            let input = document.getElementById(prefix + "_" + field);
            if (input) {
                input.addEventListener("input", function() {
                    calculateValues(prefix);
                });
            }
        });
        // Initial calculation on page load
        calculateValues(prefix);
    });
});
</script>
</div>