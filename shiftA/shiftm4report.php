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
$sql = "SELECT * FROM shifta4 LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM shifta4 LIMIT $limit OFFSET $offset";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM shifta4 LIMIT $limit OFFSET $offset";
$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM shifta4 LIMIT $limit OFFSET $offset";
$result4 = $conn->query($sql4);

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM shifta4";
$count_result = $conn->query($sql_count);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Total Records Count
$sql_count2 = "SELECT COUNT(*) AS total FROM shifta4";
$count_result2 = $conn->query($sql_count2);
$total_rows2 = $count_result2->fetch_assoc()['total'];
$total_pages2 = ceil($total_rows2 / $limit);


// Total Records Count
$sql_count3 = "SELECT COUNT(*) AS total FROM shifta4";
$count_result3 = $conn->query($sql_count3);
$total_rows3 = $count_result3->fetch_assoc()['total'];
$total_pages3 = ceil($total_rows3 / $limit);

// Total Records Count
$sql_count4 = "SELECT COUNT(*) AS total FROM shifta4";
$count_result4 = $conn->query($sql_count4);
$total_rows4 = $count_result4->fetch_assoc()['total'];
$total_pages4 = ceil($total_rows4 / $limit);
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
    <div class="container d-flex flex-column align-items-center" style="margin-top: 3%;">

        <!-- Table Section 1 -->
        <div class="bg-white p-4 shadow-sm rounded mb-4" style="max-width: 1100px; width: 100%;">
            <h5>Nozzle 1 Data</h5>
            <table class="table table-bordered table-hover mx-auto" style="width: auto;">
                <thead class="table-dark">
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
                                    <td>{$row['datetime']}</td>
                                    <td>{$row['employee1']}</td>
                                    <td>{$row['product1']}</td>
                                    <td>{$row['nozzle1']}</td>
                                    <td>{$row['xg1_start_reading']}</td>
                                    <td>{$row['xg1_close_reading']}</td>
                                    <td>{$row['xg1_reading_difference']}</td>
                                    <td>{$row['xg1_testing_less']}</td>                                   
                                    <td>{$row['xg1_net_sale']}</td>
                                    <td>{$row['xg1_total_amount']}</td>
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
                <thead class="table-dark">
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
                                    <td>{$row['datetime']}</td>
                                    <td>{$row['employee2']}</td>
                                    <td>{$row['product2']}</td>
                                    <td>{$row['nozzle2']}</td>
                                    <td>{$row['xg2_start_reading']}</td>
                                    <td>{$row['xg2_close_reading']}</td>
                                    <td>{$row['xg2_reading_difference']}</td>
                                    <td>{$row['xg2_testing_less']}</td>                                   
                                    <td>{$row['xg2_net_sale']}</td>
                                    <td>{$row['xg2_total_amount']}</td>
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

                    <?php for ($i = 1; $i <= $total_pages2; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages2): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <!-- Table Section 3 -->
        <div class="bg-white p-4 shadow-sm rounded mb-4" style="max-width: 1100px; width: 100%;">
            <h5>Nozzle 3 Data</h5>
            <table class="table table-bordered table-hover mx-auto" style="width: auto;">
                <thead class="table-dark">
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
                    if ($result3->num_rows > 0) {
                        $sno = 1;
                        while ($row = $result3->fetch_assoc()) {
                            echo "<tr>
                                    <th>$sno</th>
                                    <td>{$row['datetime']}</td>
                                    <td>{$row['employee3']}</td>
                                    <td>{$row['product3']}</td>
                                    <td>{$row['nozzle3']}</td>
                                    <td>{$row['ms1_start_reading']}</td>
                                    <td>{$row['ms1_close_reading']}</td>
                                    <td>{$row['ms1_reading_difference']}</td>
                                    <td>{$row['ms1_testing_less']}</td>                                   
                                    <td>{$row['ms1_net_sale']}</td>
                                    <td>{$row['ms1_total_amount']}</td>
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

                    <?php for ($i = 1; $i <= $total_pages3; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages3): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <!-- Table Section 4 -->
        <div class="bg-white p-4 shadow-sm rounded mb-4" style="max-width: 1100px; width: 100%;">
            <h5>Nozzle 4 Data</h5>
            <table class="table table-bordered table-hover mx-auto" style="width: auto;">
                <thead class="table-dark">
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
                    if ($result4->num_rows > 0) {
                        $sno = 1;
                        while ($row = $result4->fetch_assoc()) {
                            echo "<tr>
                                    <th>$sno</th>
                                    <td>{$row['datetime']}</td>
                                    <td>{$row['employee4']}</td>
                                    <td>{$row['product4']}</td>
                                    <td>{$row['nozzle4']}</td>
                                    <td>{$row['ms2_start_reading']}</td>
                                    <td>{$row['ms2_close_reading']}</td>
                                    <td>{$row['ms2_reading_difference']}</td>
                                    <td>{$row['ms2_testing_less']}</td>                                   
                                    <td>{$row['ms2_net_sale']}</td>
                                    <td>{$row['ms2_total_amount']}</td>
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

                    <?php for ($i = 1; $i <= $total_pages4; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages4): ?>
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