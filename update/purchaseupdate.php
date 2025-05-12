<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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

    // Update main entry
    $sql = "UPDATE stock_entries SET 
        company_name = ?, invoice_no = ?, veh_no = ?, challan_no = ?, invoice_date = ?, 
        delivery_date = ?, challan_date = ?, firm_name = ?, remark = ?, gst_no = ?
        WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $company_name, $invoice_no, $veh_no, $challan_no, $invoice_date, $delivery_date, $challan_date, $firm_name, $remark, $gst_no, $id);
    $stmt->execute();

    // Remove old items
    $conn->query("DELETE FROM stock_items WHERE entry_id = $id");

    // Insert updated items
    foreach ($_POST['item_name'] as $index => $item_name) {
        $qty = $_POST['qty'][$index];
        $rate = $_POST['rate'][$index];
        $UOM = $_POST['UOM'][$index];
        $HSN_Code = $_POST['HSN_Code'][$index];
        $Code_No = $_POST['Code_No'][$index];
        $total = $_POST['total'][$index];
        $tank = $_POST['tank'][$index];

        $sql_item = "INSERT INTO stock_items (entry_id, item_name, qty, rate, UOM, HSN_Code, Code_No, total, tank)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_item = $conn->prepare($sql_item);
        $stmt_item->bind_param("isidssids", $id, $item_name, $qty, $rate, $UOM, $HSN_Code, $Code_No, $total, $tank);
        $stmt_item->execute();
    }

    echo "<script>
        alert('Purchase entry updated successfully!');
        window.location.href='../list/purchaselist.php';
    </script>";
}
?>