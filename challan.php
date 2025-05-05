<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $slip_no = trim($_POST["slip_no"]);
  $challan_date = trim($_POST["challan_date"]);
  $customer_name = trim($_POST["customer_name"]);
  $shift = trim($_POST["shift"]);
  $vehicle_no = trim($_POST["vehicle_no"]);
  $shift_date = trim($_POST["shift_date"]);
  $employee_name = trim($_POST["employee_name"]);
  $item = trim($_POST["item"]);
  $uom= trim($_POST["uom"]);
  $rate= trim($_POST["rate"]);
  $qty= trim($_POST["qty"]);
  $total_Amt = trim($_POST["Total_Amt"]);

  
    $link = new mysqli('localhost','root','','challan');
    if(mysqli_connect_error()){
        die("connection error");
    }
    $query = "insert into challanslip(slip_no,challan_date,customer_name,shift,vehicle_no,shift_date,employee_name,item,uom,rate,qty,Total_Amt)values('$slip_no' ,'$challan_date','$customer_name' ,'$shift', '$vehicle_no','$shift_date','$employee_name','$item','$uom','$rate','$qty','$Total Amt')";
    if($link->query($query)===TRUE){
        header("location:challan.php");  
}
else{
    echo"error: ".$query."<br>".$link->error;
}
}

   

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Challan Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .right {
      justify-items: right;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .container {
      width: 100%;
      /* margin: auto; */
      padding: 20px;
      border: 2px solid #000;
      margin-bottom: 30px;
    }


    .row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      align-items: center;
    }

    .row input,
    .row select {
      width: 60%;
      padding: 8px;
      font-size: 16px;
      border: 2px solid pink;
    }

    .checkbox-group {
      display: flex;
      gap: 10px;
      align-items: center;
      margin-bottom: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: auto;
      /* Allows table columns to resize dynamically */
      word-wrap: break-word;
      margin-top: 10px;
      min-width: 60px;
      /* Ensures table doesn't shrink below a reasonable size */
      overflow: hidden;
      /* Disable scrolling */
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
      word-wrap: break-word;
    }

    th {
      background-color: #f4f4f4;
      /* Optional: to distinguish header row */
    }


    .buttons {
      text-align: center;
      margin-top: 20px;
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .buttons button {
      margin: 5px;
      padding: 10px 20px;
      font-size: 18px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input::placeholder {
      color: blue;
    }

    h1 {
      text-align: center;
      text-decoration-color: #534caf;
    }

    #saved-records-container {
      width: 80%;
      margin: auto;
      padding: 20px;
      border: 2px solid #000;
    }

    @media (max-width: 768px) {
      table {
        font-size: 14px;
        /* Reduces font size on smaller screens */
      }

      .row input,
      .row select {
        width: 100%;
        /* Makes input fields stack vertically on smaller screens */
        margin-bottom: 10px;
      }

      .checkbox-group {
        flex-direction: column;
        /* Stack checkboxes vertically on smaller screens */
      }

    }
  </style>
</head>

<body>
  <!-- Main Form Container -->
  <form method="POST">
    <div class="container mt-4">
      <h1 class="text-center">Challan</h1>

      <div class="text-center mb-3">
        <button class="btn btn-primary" onclick="sendSMS()">Send SMS</button>
        <button class="btn btn-secondary" onclick="printPDF()">Print</button>
      </div>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="slip-no" class="form-label">Challan No.</label>
          <input type="text" id="slip-no" class="form-control" placeholder="Enter Challan No." name="slip_no">
        </div>
        <div class="col-md-6 right">
          <label for="challan_date" class="form-label">Challan Date</label>
          <input type="date" id="challan_date" class="form-control" name="challan_date">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="customer_name" class="form-label">Customer</label>
          <input type="text" id="customer_name" class="form-control" placeholder="Enter Customer Name" name="customer_name">
        </div>
        <div class="col-md-6 right">
          <label for="shift" class="form-label">Shift</label>
          <select id="shift" class="form-select" name="shift">
            <option value="" disabled selected>Select Shift</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="vehicle_no" class="form-label">Vehicle No.</label>
          <input type="text" id="vehicle_no" class="form-control" placeholder="Enter Vehicle No." name="vehicle_no">
        </div>
        <div class="col-md-6 right">
          <label for="shift_date" class="form-label">Shift Date</label>
          <input type="date" id="shift_date" class="form-control" name="shift_date">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="employee_name" class="form-label">Enter Employee</label>
          <input type="text" id="employee_name" class="form-control" placeholder="Enter employee name" name="employee_name">
        </div>
      </div>

      <div class="row">
        <table id="items-table" class="tabl">
          <thead>
            <tr>
              <th>Sno.</th>
              <th>Select</th>
              <th>Quantity</th>
              <th>UOM</th>
              <th>Rate</th>
              <th>Total Amt.</th>
              <th>Del</th>
            </tr>
          </thead>
          <tbody>
            <!-- A default row is added on load -->
          </tbody>
        </table>
      </div>
      <br><br>

      <!-- Button to add new row in items table -->
      <button type="button" onclick="addItem()"
        style="background-color: #6fcceb; color: white; padding: 2px 5px; font-size: 18px; border: none; border-radius: 5px;">
        ➕
      </button>

      <div class="row" style="float: right; margin-top: 15px;">
        <label>Grand Total:
          <!-- Grand total is computed automatically -->
          <input type="text" id="grand-total" placeholder="Grand Total" readonly
            style="display: inline-block; width: auto;" >
        </label>
      </div>
      <br>

      <div class="buttons">
        <!-- Save Button -->
        <button onclick="saveData()" style="background-color: green; color: white;">
          Save
        </button>
        
        <input type="Submit" value="submit" class="btn btn-primary"><br>
      </div>
    </div>
  </form>
  <!-- Saved Records Container -->
  <div class="container" id="saved-records-container">
    <h3>Saved Records</h3>
    <table id="savedDataTable">
      <thead>
        <tr>
          <th>S.No.</th>
          <th>Customer Name</th>
          <th>Items</th>
          <th>Grand Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <!-- Saved records will appear here -->
        </tr>
      </tbody>
    </table>
  </div>
  </div>
  <script>
    function sendSMS() {
      alert("SMS Sent!");
    }
  </script>


  <script>
    function sendSMS() {
      alert("SMS Sent Successfully!");
    }
    // Function to add a new row to the items table
    function addItem() {
      var tableBody = document.getElementById("items-table").getElementsByTagName("tbody")[0];
      var rowCount = tableBody.getElementsByTagName("tr").length + 1;

      var newRow = document.createElement("tr");

      var newSno = document.createElement("td");
      newSno.textContent = rowCount;

      var newItem = document.createElement("td");
      newItem.innerHTML = `
        <select class="item" style="width: 100px; height: 40px;" name="item">
          <option value="" disabled selected>Item</option>
          <option value="MS">MS</option>
          <option value="XP-95">XP-95</option>
          <option value="HSD">HSD</option>
          <option value="XG">XG</option>
        </select>
      `;

      var newQty = document.createElement("td");
      newQty.innerHTML = '<input type="number" class="qty" style="width: 80px; height: 40px;"placeholder="Qty" oninput="calculateTotal(this)" name="qty">';

      var newUOM = document.createElement("td");
      newUOM.innerHTML = `
        <select class="uom"style="width: 150px; height: 40px;" name="uom">
          <option value="" disabled selected>Select UOM</option>
          <option value="Ltr">Ltr</option>
          <option value="Kg">Kg</option>
          <option value="Pkt">Pkt</option>
        </select>
      `;

      var newRate = document.createElement("td");
      newRate.innerHTML = '<input type="number" class="rate" style="width: 80px; height: 40px;"placeholder="Rate" oninput="calculateTotal(this)" name="rate">';

      var newTotalAmt = document.createElement("td");
      newTotalAmt.innerHTML = '<input type="text" class="total" style="width: 85px; height: 40px;"placeholder="Total_Amt" readonly name="Total_Amt">';

      var deleteBtn = document.createElement("td");
      deleteBtn.innerHTML = '<button onclick="deleteRow(this)" style="color: red;">❌</button>';

      newRow.appendChild(newSno);
      newRow.appendChild(newItem);
      newRow.appendChild(newQty);
      newRow.appendChild(newUOM);
      newRow.appendChild(newRate);
      newRow.appendChild(newTotalAmt);
      newRow.appendChild(deleteBtn);

      tableBody.appendChild(newRow);
    }

    // Function to calculate the total amount in a row and update the grand total
    function calculateTotal(input) {
      var row = input.closest("tr");
      var qty = parseFloat(row.querySelector(".qty").value) || 0;
      var rate = parseFloat(row.querySelector(".rate").value) || 0;
      var totalAmt = row.querySelector(".total");

      totalAmt.value = (qty * rate).toFixed(2);
      updateGrandTotal();
    }

    // Function to update the grand total from all rows in the items table
    function updateGrandTotal() {
      var total = 0;
      var rows = document.querySelectorAll("#items-table tbody tr");
      rows.forEach(function (row) {
        var rowTotal = parseFloat(row.querySelector(".total").value) || 0;
        total += rowTotal;
      });
      document.getElementById("grand-total").value = total.toFixed(2);
    }

    // Function to delete a row and update serial numbers and grand total
    function deleteRow(button) {
      var row = button.parentElement.parentElement;
      row.remove();

      var tableRows = document.querySelectorAll("#items-table tbody tr");
      tableRows.forEach((row, index) => {
        row.cells[0].textContent = index + 1;
      });
      updateGrandTotal();
    }

    // Function to simulate data saving: gathers the form data and appends a new record to the Saved Records table.
    function saveData() {
      // Get the customer name from the input
      var customerName = document.getElementById("customer-name").value.trim();
      if (!customerName) {
        alert("Please enter a Customer Name.");
        return;
      }

      // Gather items data from the items table
      var itemsArray = [];
      var itemsDisplay = "";
      var grandTotal = 0;
      var tableRows = document.querySelectorAll("#items-table tbody tr");
      if (tableRows.length === 0) {
        alert("Please add at least one item.");
        return;
      }
      tableRows.forEach(function (row) {
        var itemSelect = row.querySelector(".item");
        var itemVal = itemSelect ? itemSelect.value : "";
        var qty = parseFloat(row.querySelector(".qty").value) || 0;
        var total = parseFloat(row.querySelector(".total").value) || 0;
        // Sum up grand total
        grandTotal += total;
        if (itemVal) {
          itemsDisplay += itemVal + " (Qty: " + qty + ", Total: " + total.toFixed(2) + "); ";
        }
        itemsArray.push({
          item: itemVal,
          qty: qty,
          total: total
        });
      });

      // Create new saved record row in the Saved Records table
      var savedTableBody = document.querySelector("#savedDataTable tbody");
      var newRow = document.createElement("tr");
      var rowCount = savedTableBody.getElementsByTagName("tr").length + 1;

      var snoCell = document.createElement("td");
      snoCell.textContent = rowCount;

      var customerCell = document.createElement("td");
      customerCell.textContent = customerName;

      var itemsCell = document.createElement("td");
      itemsCell.textContent = itemsDisplay;

      var grandTotalCell = document.createElement("td");
      grandTotalCell.textContent = grandTotal.toFixed(2);

      var actionCell = document.createElement("td");
      var viewEditBtn = document.createElement("button");
      viewEditBtn.textContent = "Edit";
      viewEditBtn.onclick = function () {
        viewEditRecord(this);
      };
      actionCell.appendChild(viewEditBtn);

      newRow.appendChild(snoCell);
      newRow.appendChild(customerCell);
      newRow.appendChild(itemsCell);
      newRow.appendChild(grandTotalCell);
      newRow.appendChild(actionCell);

      // Store the raw data in data attributes for later editing.
      newRow.dataset.customer = customerName;
      newRow.dataset.items = JSON.stringify(itemsArray);
      newRow.dataset.grandTotal = grandTotal.toFixed(2);

      savedTableBody.appendChild(newRow);

      alert("Data saved successfully!");

      // Clear all inputs and the items table in the main form
      document.querySelectorAll(".container input:not([type='button']), .container select").forEach(el => {
        el.value = "";
      });
      document.querySelector("#items-table tbody").innerHTML = "";
      updateGrandTotal();
      // Add one default row again
      addItem();
    }

    // Function to update the serial numbers in the Saved Records table
    function updateSavedTableSerialNumbers() {
      var savedRows = document.querySelectorAll("#savedDataTable tbody tr");
      savedRows.forEach((row, index) => {
        row.cells[0].textContent = index + 1;
      });
    }

    // Function to view/edit a saved record:
    // When the button is clicked, the data from that row is loaded back into the main form for editing,
    // and the saved record is removed from the Saved Records table.
    function viewEditRecord(button) {
      var row = button.parentElement.parentElement;
      var customer = row.dataset.customer;
      var itemsData = JSON.parse(row.dataset.items);

      // Populate the main form with the saved data
      document.getElementById("customer-name").value = customer;

      // Clear the items table and rebuild it from the saved itemsData
      var tableBody = document.querySelector("#items-table tbody");
      tableBody.innerHTML = "";
      itemsData.forEach(function (itemObj) {
        var newRow = document.createElement("tr");

        var snoCell = document.createElement("td");
        // Will update serial numbers later
        snoCell.textContent = "";

        var newItem = document.createElement("td");
        newItem.innerHTML = `
          <select class="item">
            <option value="" disabled>Select Item</option>
            <option value="MS">MS</option>
            <option value="XP-95">XP-95</option>
            <option value="HSD">HSD</option>
            <option value="XG">XG</option>
          </select>
        `;
        // Set the selected value if available
        newItem.querySelector("select").value = itemObj.item;

        var newQty = document.createElement("td");
        newQty.innerHTML = '<input type="number" class="qty" placeholder="Qty" oninput="calculateTotal(this)" >';
        newQty.querySelector("input").value = itemObj.qty;

        var newUOM = document.createElement("td");
        newUOM.innerHTML = `
          <select class="uom">
            <option value="" disabled selected>Select UOM</option>
            <option value="Ltr">Ltr</option>
            <option value="Kg">Kg</option>
            <option value="Pkt">Pkt</option>
          </select>
        `;
        // UOM is not stored, so leave as default.

        var newRate = document.createElement("td");
        newRate.innerHTML = '<input type="number" class="rate" placeholder="Rate" oninput="calculateTotal(this)" >';
        // Rate is not stored from before; user can re-enter if needed.

        var newTotalAmt = document.createElement("td");
        newTotalAmt.innerHTML = '<input type="number" class="total" placeholder="Total_Amt" readonly >';
        newTotalAmt.querySelector("input").value = itemObj.total;

        var deleteBtn = document.createElement("td");
        deleteBtn.innerHTML = '<button onclick="deleteRow(this)" style="color: red;">❌</button>';

        newRow.appendChild(snoCell);
        newRow.appendChild(newItem);
        newRow.appendChild(newQty);
        newRow.appendChild(newUOM);
        newRow.appendChild(newRate);
        newRow.appendChild(newTotalAmt);
        newRow.appendChild(deleteBtn);

        tableBody.appendChild(newRow);
      });
      // Update serial numbers for the items table
      var tableRows = document.querySelectorAll("#items-table tbody tr");
      tableRows.forEach((row, index) => {
        row.cells[0].textContent = index + 1;
      });
      updateGrandTotal();

      // Remove the saved record row from the Saved Records table since it is now being edited
      row.remove();
      updateSavedTableSerialNumbers();
    }

    // Automatically add one row on page load
    window.onload = function () {
      addItem();
    };
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script>
    function printPDF() {
      const { jsPDF } = window.jspdf;
      const pdf = new jsPDF('p', 'mm', 'a4'); // PDF का आकार A4 में सेट करें

      // HTML को canvas में कन्वर्ट करें
      html2canvas(document.querySelector(".container")).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        const imgWidth = 205; // A4 width in mm
        const pageHeight = 200; // A4 height in mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        let position = 10; // Top margin

        pdf.addImage(imgData, 'PNG', 2, position, imgWidth, imgHeight);
        pdf.save("Challan.pdf"); // फाइल को "Challan.pdf" नाम से सेव करें
      });
    }
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>