<?php
$servername = "localhost"; // Database server
$username = "root"; // Database username
$password = "Rajukumar@21"; // Database password
$dbname = "vendors"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from form
$denominations = [500, 200, 100, 50, 20, 10];
$coins = isset($_POST['coins']) ? floatval($_POST['coins']) : 0;
$grand_total = isset($_POST['grand_total']) ? floatval($_POST['grand_total']) : 0;
$date_time = date("Y-m-d H:i:s"); // Current timestamp

// Insert ₹500 notes into 'bank' table
$qty_500 = isset($_POST['qty-500']) ? intval($_POST['qty-500']) : 0;
$amount_500 = $qty_500 * 500;

if ($qty_500 > 0) {
    $sql_bank = "INSERT INTO bankc1 (denomination, pieces, amount, date_time) VALUES (500, $qty_500, $amount_500, '$date_time')";
    $conn->query($sql_bank);
}

// Insert other notes into 'second_shift' table
foreach ($denominations as $value) {
    if ($value != 500) { // Skip ₹500 as it is already inserted into bank
        $qty = isset($_POST["qty-$value"]) ? intval($_POST["qty-$value"]) : 0;
        $amount = $qty * $value;

        if ($qty > 0) {
            $sql_shift = "INSERT INTO second_shiftc1 (denomination, pieces, amount, date_time) VALUES ($value, $qty, $amount, '$date_time')";
            if (!$conn->query($sql_shift)) {
                die("Error: " . $conn->error);
            }
        }
    }
}

// Insert coins in second shift
if ($coins > 0) {
    $sql_coins = "INSERT INTO second_shiftc1 (denomination, pieces, amount, date_time) VALUES ('Coins', 1, $coins, '$date_time')";
    if (!$conn->query($sql_coins)) {
        die("Error: " . $conn->error);
    }
}

// Insert grand total into 'transactions' table
$sql_transaction = "INSERT INTO transactionsc1 (total_amount, date_time) VALUES ($grand_total, '$date_time')";
if (!$conn->query($sql_transaction)) {
    die("Error: " . $conn->error);
}

// Close connection
$conn->close();

echo "<script>alert('Data saved successfully!'); window.location.href='m1moneycash.php';</script>";
?>
