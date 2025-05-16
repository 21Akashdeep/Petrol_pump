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
$limit = 5; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch Vendors Data
$sql = "SELECT * FROM shifta2 LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM shifta2 LIMIT $limit OFFSET $offset";
$result2 = $conn->query($sql2);

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM shifta2";
$count_result = $conn->query($sql_count);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM shifta2";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
       body {
            background-image: url("../images/dashboard.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            min-height: 100vh;
            text-align: center;

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
            padding-left: 2px;
            padding-right: 2px;
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
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include '../navbar.php'; ?>
    <!-- Main Content -->
    <div class="container container-content d-flex flex-column align-items-center" style="margin-top: 3%;">

        <!-- Table Section 1 -->
        <div class="bg-white p-4 shadow-sm rounded mb-4" style="max-width: 1100px; width: 100%;">
            <h5>Nozzle 1 Data TATA</h5>
            <table class="table table-bordered table-hover mx-auto" style="width: auto;">
                <thead>
                    <tr>
                        <th>SNo.</th>
                        <th>Report_Date_time</th>
                        <th>Employee Name</th>
                        <th>product</th>
                        <th>nozzle</th>
                        <th>opening_Reading</th>
                        <th>closing_Reading</th>
                        <th>Reading Difference</th>
                        <th>Testing Less</th>
                        <th>Net sale</th>
                        <th>total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $sno = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <th>$sno</th>
                                    <td>{$row['shifta1_datetime']}</td>
                                    <td>{$row['shifta1_emp1']}</td>
                                    <td>{$row['shifta1_product1']}</td>
                                    <td>{$row['shifta1_nozzle1']}</td>
                                    <td>{$row['xp_start_reading']}</td>
                                    <td>{$row['xp_close_reading']}</td>
                                    <td>{$row['xp_reading_difference']}</td>
                                    <td>{$row['xp_testing_less']}</td>                                   
                                    <td>{$row['xp_net_sale']}</td>
                                    <td>{$row['xp_total_amount']}</td>
                                  </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='11' class='text-center'>No items found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <!-- Table Section 2 -->
        <div class="bg-white p-4 shadow-sm rounded mb-4" style="max-width: 1100px; width: 100%;">
            <h5>Nozzle 2 Data</h5>
            <table class="table table-bordered table-hover mx-auto" style="width: auto;">
                <thead>
                    <tr>
                        <th>SNo.</th>
                        <th>Report_Date_time</th>
                        <th>Employee Name</th>
                        <th>product</th>
                        <th>nozzle</th>
                        <th>opening_Reading</th>
                        <th>closing_Reading</th>
                        <th>Reading Difference</th>
                        <th>Testing Less</th>
                        <th>Net sale</th>
                        <th>total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result2->num_rows > 0) {
                        $sno = 1;
                        while ($row = $result2->fetch_assoc()) {
                            echo "<tr>
                                    <th>$sno</th>
                                    <td>{$row['shifta1_datetime']}</td>
                                    <td>{$row['shifta1_emp2']}</td>
                                    <td>{$row['shifta1_product2']}</td>
                                    <td>{$row['shifta1_nozzle2']}</td>
                                    <td>{$row['ms_start_reading']}</td>
                                    <td>{$row['ms_close_reading']}</td>
                                    <td>{$row['ms_reading_difference']}</td>
                                    <td>{$row['ms_testing_less']}</td>                                   
                                    <td>{$row['ms_net_sale']}</td>
                                    <td>{$row['ms_total_amount']}</td>
                                  </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='11' class='text-center'>No items found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>