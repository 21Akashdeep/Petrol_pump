<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challan Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-weight: bold;
        }
        .btn-add {
            background-color: #0d6efd;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Challan</h1>
        <form id="challanForm" action="submit.php" method="POST">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Challan No.</label>
                    <input type="text" class="form-control" name="challan_no"  readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Challan Date</label>
                    <input type="date" class="form-control" name="challan_date" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Customer</label>
                    <input type="text" class="form-control" name="customer" placeholder="Enter Customer Name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Shift</label>
                    <select class="form-select" name="shift" required>
                        <option>Select Shift</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Vehicle No.</label>
                    <input type="text" class="form-control" name="vehicle_no" placeholder="Enter Vehicle No." required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Shift Date</label>
                    <input type="date" class="form-control" name="shift_date" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Enter Employee</label>
                <input type="text" class="form-control" name="employee" placeholder="Enter employee name" required>
            </div>

            <table id="items-table" class="table table-bordered">
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
                    <tr>
                        <td>1</td>
                        <td>
                            <select class="form-select" name="product[]" required>
                                <option value="" disabled selected>Select Product</option>
                                <option>XP-95</option>
                                <option>MS</option>
                                <option>HSD</option>
                                <option>HD</option>
                                <option>XG-1</option>
                                <option>XG-2</option>
                                <option>MS-1</option>
                                <option>MS-2</option>
                            </select>                      
                        </td>
                        <td><input type="number" class="form-control qty" name="quantity[]" placeholder="Qty" oninput="calculateTotal(this)" required></td>
                        <td>
                            <select class="form-select" name="uom[]" required>
                                <option value="" disabled selected>Select UOM</option>
                                <option>Pkt</option>
                                <option>Kg</option>
                                <option>Ltr</option>
                            </select>
                        </td>
                        <td><input type="number" class="form-control rate" name="rate[]" placeholder="Rate" oninput="calculateTotal(this)" required></td>
                        <td><input type="text" class="form-control total-amt" name="total_amount[]" placeholder="Total_Amt" readonly></td>
                        <td><button type="button" class="btn-delete" onclick="removeRow(this)">❌</button></td>
                    </tr>
                </tbody>
            </table>
            
            <div class="d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-primary btn-add" onclick="addItem()">➕</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div>
                    <label class="fw-bold me-2">Grand Total:</label>
                    <input type="text" id="grandTotal" class="form-control d-inline-block w-auto" placeholder="0.00" name="grand_total" readonly>
                </div>
            </div>
        </form>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        generateChallanNo();
    });

    function generateChallanNo() {
        let currentDate = new Date();
        let challanNo = "CH" + currentDate.getFullYear() + 
                        ("0" + (currentDate.getMonth() + 1)).slice(-2) + 
                        ("0" + currentDate.getDate()).slice(-2) + 
                        currentDate.getHours() + 
                        currentDate.getMinutes() + 
                        currentDate.getSeconds();
        
        document.querySelector('input[name="challan_no"]').value = challanNo;
    }


        function addItem() {
    var table = document.getElementById("items-table").getElementsByTagName("tbody")[0];
    var rowCount = table.rows.length;
    var row = `<tr>
        <td>${rowCount + 1}</td>
        <td>
            <select class="form-select" name="product[]">
                <option value="" disabled selected>Select Product</option>
                <option>XP-95</option>
                <option>MS</option>
                <option>HSD</option>
            </select>                      
        </td>
        <td><input type="number" class="form-control qty" name="quantity[]" placeholder="Qty" oninput="calculateTotal(this)"></td>
        <td>
            <select class="form-select" name="uom[]">
                <option value="" disabled selected>Select UOM</option>
                <option>Pkt</option>
                <option>Kg</option>
                <option>Ltr</option>
            </select>
        </td>
        <td><input type="number" class="form-control rate" name="rate[]" placeholder="Rate" oninput="calculateTotal(this)"></td>
        <td><input type="text" class="form-control total-amt" name="total_amount[]" placeholder="Total_Amt" readonly></td>
        <td><button type="button" class="btn-delete" onclick="removeRow(this)">❌</button></td>
    </tr>`;
    table.insertAdjacentHTML("beforeend", row);
}

        function removeRow(button) {
            button.closest("tr").remove();
            updateGrandTotal();
        }

        function calculateTotal(input) {
            var row = input.closest("tr");
            var qty = row.querySelector(".qty").value;
            var rate = row.querySelector(".rate").value;
            var totalAmtField = row.querySelector(".total-amt");
            totalAmtField.value = qty && rate ? (qty * rate).toFixed(2) : "";
            updateGrandTotal();
        }

        function updateGrandTotal() {
            var grandTotal = Array.from(document.querySelectorAll(".total-amt"))
                .reduce((sum, field) => sum + (parseFloat(field.value) || 0), 0);
            document.getElementById("grandTotal").value = grandTotal.toFixed(2);
        }
        </script>
        
</body>
</html>
