<?php
include '../db_connect.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $invoice_no = $_POST['invoice_no'];
    $veh_no = $_POST['veh_no'];
    $challan_no = $_POST['challan_no'];
    $invoice_date = $_POST['invoice_date'];
    $delivery_date = $_POST['delivery_date'];
    $challan_date = $_POST['challan_date'];
    $firm_name = $_POST['firm_name'];
    $remark = $_POST['remark'];
    $gst_no = $_POST['gst_no'];

    // Insert into stock_entries table
    $sql = "INSERT INTO stock_entries (company_name, invoice_no, veh_no, challan_no, invoice_date, delivery_date, challan_date, firm_name, remark, gst_no)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $company_name, $invoice_no, $veh_no, $challan_no, $invoice_date, $delivery_date, $challan_date, $firm_name, $remark, $gst_no);

    if ($stmt->execute()) {
        $entry_id = $stmt->insert_id; // Get last inserted ID

        // Insert multiple items into stock_items table
        foreach ($_POST['item_name'] as $index => $item_name) {
            $qty = $_POST['qty'][$index];
            $rate = $_POST['rate'][$index];
            $UOM = $_POST['UOM'][$index];
            $HSN_Code = $_POST['HSN_Code'][$index];
            $Code_No = $_POST['Code_No'][$index];
            $total = $_POST['total'][$index];
            $tank = $_POST['tank'][$index];

            $sql_item = "INSERT INTO stock_items (entry_id, item_name, qty, rate,UOM,HSN_Code,Code_No, total, tank)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt_item = $conn->prepare($sql_item);
            $stmt_item->bind_param("isidiiids", $entry_id, $item_name, $qty, $rate, $UOM, $HSN_Code, $Code_No, $total, $tank);
            $stmt_item->execute();
        }
        // echo "Data saved successfully!";
        header("Location: ../list/purchaselist.php");
    } else {
        echo "Error: " . $conn->error;
    }


}

$query = "SELECT company_name FROM vendors UNION SELECT company_name FROM customer"; // Dono tables se data fetch kar raha hai
$result = $conn->query($query);

$companies = [];
while ($row = $result->fetch_assoc()) {
    $companies[] = $row['company_name'];
}

$query = "SELECT item_name FROM item";
$result = $conn->query($query);

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row['item_name'];
}

$query = "SELECT location_name FROM locations";
$result = $conn->query($query);

$locations = [];
while ($row = $result->fetch_assoc()) {
    $locations[] = $row['location_name'];
}

$query = "SELECT UOM FROM UOM";
$result = $conn->query($query);

$UOMs = [];
while ($row = $result->fetch_assoc()) {
    $UOMs[] = $row['UOM'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav {
            gap: 30px;
            /* Space between menu items */
        }

        .dropdown-menu {
            background-color: #212529 !important;
            /* Black dropdown background */
        }

        .dropdown-menu a {
            color: white !important;
            /* White text in dropdown */
        }

        .dropdown-menu a:hover {
            background-color: #333 !important;
            /* Dark gray on hover */
        }
    </style>
</head>

<body class="bg-light">
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center text-primary mb-4">Stock Entry</h2>
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <select class="form-select" name="company_name">
                            <option value="">Select</option>
                            <?php foreach ($companies as $company) { ?>
                                <option value="<?php echo htmlspecialchars($company); ?>">
                                    <?php echo htmlspecialchars($company); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Invoice No.</label>
                        <input type="text" class="form-control" name="invoice_no">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Vehicle No.</label>
                        <input type="text" class="form-control" name="veh_no">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Challan No.</label>
                        <input type="text" class="form-control" name="challan_no">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Invoice Date</label>
                        <input type="date" class="form-control" name="invoice_date">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Delivery Date</label>
                        <input type="date" class="form-control" name="delivery_date">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Challan Date</label>
                        <input type="date" class="form-control" name="challan_date">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Firm Name</label>
                        <select class="form-select" name="firm_name">
                            <?php foreach ($companies as $company) { ?>
                                <option value="<?php echo htmlspecialchars($company); ?>">
                                    <?php echo htmlspecialchars($company); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Remark</label>
                        <input type="text" class="form-control" name="remark">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">GST No.</label>
                        <input type="text" class="form-control" name="gst_no">
                    </div>
                </div>
                <table class="table table-bordered mt-4" id="stockTable">
                    <thead class="table-primary">
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>UOM</th>
                            <th>HSN Code</th>
                            <th>Code No.</th>
                            <th>Total</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><select class="form-select" name="item_name[]">
                                    <option value="">Select Item</option>
                                    <?php foreach ($items as $item) { ?>
                                        <option value="<?php echo htmlspecialchars($item); ?>">
                                            <?php echo htmlspecialchars($item); ?>
                                        </option>
                                    <?php } ?>
                                </select></td>
                            <td><input type="number" class="form-control" name="qty[]" oninput="calculateTotal(this)">
                            </td>
                            <td><input type="number" class="form-control" name="rate[]" oninput="calculateTotal(this)">
                            </td>
                            <td><select class="form-select" name="UOM[]">
                                    <option value="">Select Item</option>
                                    <?php foreach ($UOMs as $UOM) { ?>
                                        <option value="<?php echo htmlspecialchars($UOM); ?>">
                                            <?php echo htmlspecialchars($UOM); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><input type="number" class="form-control" name="HSN_Code[]">
                            </td>
                            <td><input type="number" class="form-control" name="Code_No[]">
                            </td>
                            <td><input type="text" class="form-control" name="total[]" readonly></td>
                            <td><select class="form-select" name="tank[]">
                                    <?php foreach ($locations as $location) { ?>
                                        <option value="<?php echo htmlspecialchars($location); ?>">
                                            <?php echo htmlspecialchars($location); ?>
                                        </option>
                                    <?php } ?>
                                </select></td>
                            <td><button type="button" class="btn btn-danger btn-sm"
                                    onclick="removeRow(this)">Remove</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow()">Add Row</button>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>

                </div>
            </form>


        </div>
    </div>

    <script>
        function addRow() {
            let table = document.getElementById("stockTable").getElementsByTagName("tbody")[0];
            let newRow = table.insertRow();
            newRow.innerHTML = `
        <td><select class="form-select" name="item_name[]">
            <option value="">Select Item</option>
                            <?php foreach ($items as $item) { ?>
                                <option value="<?php echo htmlspecialchars($item); ?>"><?php echo htmlspecialchars($item); ?></option>
                            <?php } ?>
        </select></td>
        <td><input type="number" class="form-control" name="qty[]" oninput="calculateTotal(this)"></td>
        <td><input type="number" class="form-control" name="rate[]" oninput="calculateTotal(this)"></td>
        <td><select class="form-select" name="UOM[]">
                            <option value="">Select Item</option>
                            <?php foreach ($UOMs as $UOM) { ?>
                                <option value="<?php echo htmlspecialchars($UOM); ?>"><?php echo htmlspecialchars($UOM); ?></option>
                            <?php } ?>
                                </select>
                            </td>
                            <td><input type="number" class="form-control" name="HSN_Code[]">
                            </td>
                            <td><input type="number" class="form-control" name="Code_No[]">
                            </td>
        <td><input type="text" class="form-control" name="total[]" readonly></td>
        <td><select class="form-select" name="tank[]">` + locationOptions + `</select></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
    `;
        }

        function removeRow(button) {
            button.parentElement.parentElement.remove();
        }
        function calculateTotal(input) {
            let row = input.closest("tr"); // Get the current row
            let qty = row.querySelector('input[name="qty[]"]').value;
            let rate = row.querySelector('input[name="rate[]"]').value;
            let totalField = row.querySelector('input[name="total[]"]');

            let total = (qty && rate) ? (parseFloat(qty) * parseFloat(rate)).toFixed(2) : 0;
            totalField.value = total; // Set the calculated total
        }

    </script>

    <script>
        // Dynamically generate location options from PHP
        var locationOptions = `
        <?php foreach ($locations as $location) { ?>
            <option value="<?php echo htmlspecialchars($location); ?>"><?php echo htmlspecialchars($location); ?></option>
        <?php } ?>
    `;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>