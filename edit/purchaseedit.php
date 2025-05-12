<?php
include '../db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid purchase ID.');
}
$id = intval($_GET['id']);

// Fetch main entry
$sql = "SELECT * FROM stock_entries WHERE id = $id";
$result = $conn->query($sql);
if (!$result || $result->num_rows === 0) {
    die('Purchase entry not found.');
}
$entry = $result->fetch_assoc();

// Fetch items
$sql_items = "SELECT * FROM stock_items WHERE entry_id = $id";
$result_items = $conn->query($sql_items);
$items_data = [];
while ($row = $result_items->fetch_assoc()) {
    $items_data[] = $row;
}

// Fetch dropdown data
$query = "SELECT company_name FROM vendors UNION SELECT company_name FROM customer";
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
    <title>Edit Stock Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav {
            gap: 30px;
        }

        .dropdown-menu {
            background-color: #212529 !important;
        }

        .dropdown-menu a {
            color: white !important;
        }

        .dropdown-menu a:hover {
            background-color: #333 !important;
        }
    </style>
</head>

<body class="bg-light">
    <?php include '../navbar.php'; ?>

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center text-primary mb-4">Edit Stock Entry</h2>
            <form method="post" action="../update/purchaseupdate.php">
                <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <select class="form-select" name="company_name" required>
                            <option value="">Select</option>
                            <?php foreach ($companies as $company) { ?>
                                <option value="<?= htmlspecialchars($company) ?>" <?= $entry['company_name'] == $company ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($company) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Invoice No.</label>
                        <input type="text" class="form-control" name="invoice_no"
                            value="<?= htmlspecialchars($entry['invoice_no']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Vehicle No.</label>
                        <input type="text" class="form-control" name="veh_no"
                            value="<?= htmlspecialchars($entry['veh_no']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Challan No.</label>
                        <input type="text" class="form-control" name="challan_no"
                            value="<?= htmlspecialchars($entry['challan_no']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Invoice Date</label>
                        <input type="date" class="form-control" name="invoice_date"
                            value="<?= htmlspecialchars($entry['invoice_date']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Delivery Date</label>
                        <input type="date" class="form-control" name="delivery_date"
                            value="<?= htmlspecialchars($entry['delivery_date']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Challan Date</label>
                        <input type="date" class="form-control" name="challan_date"
                            value="<?= htmlspecialchars($entry['challan_date']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Firm Name</label>
                        <select class="form-select" name="firm_name">
                            <?php foreach ($companies as $company) { ?>
                                <option value="<?= htmlspecialchars($company) ?>" <?= $entry['firm_name'] == $company ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($company) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Remark</label>
                        <input type="text" class="form-control" name="remark"
                            value="<?= htmlspecialchars($entry['remark']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">GST No.</label>
                        <input type="text" class="form-control" name="gst_no"
                            value="<?= htmlspecialchars($entry['gst_no']) ?>">
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
                        <?php foreach ($items_data as $i => $item) { ?>
                            <tr>
                                <td>
                                    <select class="form-select" name="item_name[]">
                                        <option value="">Select Item</option>
                                        <?php foreach ($items as $item_name) { ?>
                                            <option value="<?= htmlspecialchars($item_name) ?>"
                                                <?= $item['item_name'] == $item_name ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($item_name) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" name="qty[]"
                                        value="<?= htmlspecialchars($item['qty']) ?>" oninput="calculateTotal(this)"></td>
                                <td><input type="number" class="form-control" name="rate[]"
                                        value="<?= htmlspecialchars($item['rate']) ?>" oninput="calculateTotal(this)"></td>
                                <td>
                                    <select class="form-select" name="UOM[]">
                                        <option value="">Select Item</option>
                                        <?php foreach ($UOMs as $UOM) { ?>
                                            <option value="<?= htmlspecialchars($UOM) ?>" <?= $item['UOM'] == $UOM ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($UOM) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" name="HSN_Code[]"
                                        value="<?= htmlspecialchars($item['HSN_Code']) ?>"></td>
                                <td><input type="number" class="form-control" name="Code_No[]"
                                        value="<?= htmlspecialchars($item['Code_No']) ?>"></td>
                                <td><input type="text" class="form-control" name="total[]"
                                        value="<?= htmlspecialchars($item['total']) ?>" readonly></td>
                                <td>
                                    <select class="form-select" name="tank[]">
                                        <?php foreach ($locations as $location) { ?>
                                            <option value="<?= htmlspecialchars($location) ?>" <?= $item['tank'] == $location ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($location) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="removeRow(this)">Remove</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="row">
                    <button type="button" class="btn btn-primary btn-sm" onclick="addRow()">Add Row</button>
                    <button type="submit" class="btn btn-success mt-3">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Dynamically generate location options from PHP
        var locationOptions = `
        <?php foreach ($locations as $location) { ?>
            <option value="<?php echo htmlspecialchars($location); ?>"><?php echo htmlspecialchars($location); ?></option>
        <?php } ?>
        `;

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
        </select></td>
        <td><input type="number" class="form-control" name="HSN_Code[]"></td>
        <td><input type="number" class="form-control" name="Code_No[]"></td>
        <td><input type="text" class="form-control" name="total[]" readonly></td>
        <td><select class="form-select" name="tank[]">` + locationOptions + `</select></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
    `;
        }

        function removeRow(button) {
            button.parentElement.parentElement.remove();
        }
        function calculateTotal(input) {
            let row = input.closest("tr");
            let qty = row.querySelector('input[name="qty[]"]').value;
            let rate = row.querySelector('input[name="rate[]"]').value;
            let totalField = row.querySelector('input[name="total[]"]');
            let total = (qty && rate) ? (parseFloat(qty) * parseFloat(rate)).toFixed(2) : 0;
            totalField.value = total;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>