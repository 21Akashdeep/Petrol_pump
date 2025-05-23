<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = "Rajukumar@21"; // Change if needed
$dbname = "vendors"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination Variables
$limit = 10; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$sql = "SELECT * FROM stock_entries WHERE 1";

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM stock_entries";
$count_result = $conn->query($sql_count);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);


// Base SQL Query
$sql = "SELECT * FROM stock_entries WHERE 1";


// Apply Search Filter
if (!empty($search)) {
    $sql .= " AND (company_name LIKE '%$search%' OR invoice_no LIKE '%$search%' OR veh_no LIKE '%$search%' OR gst_no LIKE '%$search%')";
}
// Apply Pagination
$sql .= " LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM stock_entries WHERE 1";

if (!empty($search)) {
    $sql_count .= " AND (company_name LIKE '%$search%' OR invoice_no LIKE '%$search%' OR veh_no LIKE '%$search%' OR gst_no LIKE '%$search%')";
}
$count_result = $conn->query($sql_count);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/car.jpg');
            /* Use your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .navbar {
            padding: 15px;
        }

        .container-content {
            margin-top: 3%;
        }

      .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
        }

        .table {
            border: 2px solid #212529;
            width: 98%;
        }

        .btn-custom {
            display: flex;
            justify-content: flex-end;
        }

        .btn-success {
            padding: 10px 20px;
            font-size: 16px;
        }

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

        .btn-export {
            background-color: #28a745;
            color: white;
        }

        .btn-export:hover {
            background-color: #218838;
        }

        .text-danger {
            font-weight: bold;
        }

        .text-danger {
            font-weight: bold;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #212529;
            color: #6c757d;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
        }

        footer a.brand {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        footer a.brand:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include '../create/navbar.php'; ?>
    <!-- Main Content -->
    <div class="container container-content">
        <div class="bg-white p-4 shadow-sm rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- <button class="btn btn-dark">View/Close Job</button> -->
                <h4>Purchase List</h4>

                <div class="d-flex gap-2">
                    <label class="form-label fw-bold">Search</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Type to search">
                </div>
                <div class="d-flex gap-2">
                    <label class="form-label fw-bold">start</label>
                    <input type="date" id="startDate" class="form-control">
                </div>
                <div class="d-flex gap-2">
                    <label class="form-label fw-bold">End</label>
                    <input type="date" id="endDate" class="form-control">
                </div>
                <div>
                    <button class="btn btn-export" onclick="generatePDF()">Generate PDF</button>
                    <button class="btn btn-export" onclick="exportToExcel()">Excel Export</button>
                </div>
            </div>

            <table id="purchaseTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>SNo.</th>
                        <th>Company Name</th>
                        <th>Invoice No.</th>
                        <th>Vehicle No.</th>
                        <th>Challan No.</th>
                        <th>Invoice Date</th>
                        <th>Delivery Date</th>
                        <th>Challan Date</th>
                        <th>GST No.</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                    include '../db_connect.php'; // Database connection
                    
                    $sno = 1;
                    $result = $conn->query($sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <th>" . $sno . "</th>
                            <td>" . $row['company_name'] . "</td>
                            <td>" . $row['invoice_no'] . "</td>
                            <td>" . $row['veh_no'] . "</td>
                            <td>" . $row['challan_no'] . "</td>
                            <td>" . $row['invoice_date'] . "</td>
                            <td>" . $row['delivery_date'] . "</td>
                            <td>" . $row['challan_date'] . "</td>
                            <td>" . $row['gst_no'] . "</td>
                            <td>" . $row['remark'] . "</td>
                            <td>
                                <a href='../edit/purchaseedit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='../delete/purchasedelete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                            </td>
                        </tr>";
                        $sno++;
                    }
                    ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link"
                                href="?page=<?php echo ($page - 1); ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>&search=<?php echo $search; ?>">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link"
                                href="?page=<?php echo $i; ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>&search=<?php echo $search; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item"><a class="page-link"
                                href="?page=<?php echo ($page + 1); ?>&start_date=<?php echo $start_date; ?>&end_date=<?php echo $end_date; ?>&search=<?php echo $search; ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    <footer>
        <p><strong>Copyright © 2025 <a href="https://pcats.co.in/" class="brand" target="_blank">P-Cats,
                    Jamshedpur</a>.</strong> All
            rights reserved.</p>
    </footer>
    <script>
        function filterTable() {
            let searchInput = document.getElementById("searchInput").value.toLowerCase();
            let startDate = document.getElementById("startDate").value;
            let endDate = document.getElementById("endDate").value;
            let rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(row => {
                let textMatch = row.textContent.toLowerCase().includes(searchInput);
                let invoiceDate = row.cells[4].textContent.trim();

                let dateMatch = true;
                if (startDate && invoiceDate < startDate) dateMatch = false;
                if (endDate && invoiceDate > endDate) dateMatch = false;

                row.style.display = (textMatch && dateMatch) ? "" : "none";
            });
        }

        document.getElementById("searchInput").addEventListener("keyup", filterTable);
        document.getElementById("startDate").addEventListener("change", filterTable);
        document.getElementById("endDate").addEventListener("change", filterTable);
    </script>
    <script>
        function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: "landscape" });

            doc.text("Purchase List (Filtered Data)", 14, 15);

            let table = document.getElementById("tableBody");
            if (!table) {
                console.error("Table not found!");
                return;
            }

            let headers = [];
            let data = [];

            // Extract headers
            let headerCells = document.querySelector("thead").querySelectorAll("th");
            headerCells.forEach(th => headers.push(th.innerText));

            // Extract only visible (filtered) rows
            let rows = table.querySelectorAll("tr");
            rows.forEach(row => {
                if (row.style.display !== "none") { // ✅ Only add visible rows
                    let rowData = [];
                    row.querySelectorAll("td").forEach(td => rowData.push(td.innerText));
                    data.push(rowData);
                }
            });

            doc.autoTable({
                head: [headers],
                body: data,
                startY: 20,
                styles: { fontSize: 10, cellPadding: 5 },
                columnStyles: {
                    0: { cellWidth: 'auto' },  // Company Name
                    1: { cellWidth: 'auto' },  // Invoice No.
                    2: { cellWidth: 'auto' },  // Vehicle No.
                    3: { cellWidth: 'auto' },  // Challan No.
                    4: { cellWidth: 'auto' },  // Invoice Date
                    5: { cellWidth: 'auto' },  // Delivery Date
                    6: { cellWidth: 'auto' },  // Challan Date
                    7: { cellWidth: 'auto' },  // GST No.
                    8: { cellWidth: 'auto' },  // Remarks
                    // 9: { cellWidth: 50 }   // Action
                }
            });

            if (data.length === 0) {
                alert("No filtered data to export!");
                return;
            }

            doc.save("filtered_purchase_list.pdf");
        }
    </script>
    <script>
        function exportToExcel() {
            let table = document.getElementById("purchaseTable");
            if (!table) {
                console.error("Table not found!");
                return;
            }

            let rows = document.querySelectorAll("#tableBody tr");
            let csvContent = "data:text/csv;charset=utf-8,";

            // Extract headers
            let headers = [];
            document.querySelectorAll("thead th").forEach(th => headers.push(th.innerText));
            csvContent += headers.join(",") + "\n";

            // Extract only visible (filtered) rows
            rows.forEach(row => {
                if (row.style.display !== "none") { // ✅ Only add visible rows
                    let rowData = [];
                    row.querySelectorAll("td").forEach(td => rowData.push(td.innerText));
                    csvContent += rowData.join(",") + "\n";
                }
            });

            if (csvContent.split("\n").length <= 2) { // If only headers exist, no data is available
                alert("No filtered data to export!");
                return;
            }

            // Create a downloadable link
            let encodedUri = encodeURI(csvContent);
            let link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "filtered_purchase_list.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

</body>

</html>