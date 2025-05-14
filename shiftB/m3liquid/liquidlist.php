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
$sql = "SELECT * FROM liquidb3 LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM liquidb3 LIMIT $limit OFFSET $offset";
$result2 = $conn->query($sql2);

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM liquidb3";
$count_result = $conn->query($sql_count);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM liquidb3";
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
            background-color: #f8f9fa;
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

        .btn-custom button {
            margin-right: 10px;
            /* Buttons ke beech me 10px ka gap */
        }
    </style>
</head>

<body>

    <!-- Navbar -->

    <!-- Main Content -->
    <div class="container container-content">

        <!-- Table Section -->
        <div class="bg-white p-4 shadow-sm rounded">
            <div class="btn-custom">
                <button type="button" class="btn btn-success mb-3"
                    onclick="window.location.href='../mainshiftB.php';">Back</button>
                <button type="button" class="btn btn-success mb-3" onclick="window.location.href='liquid.php'">Add New
                    Liquid</button>
            </div>
            <h5>Employee 1 Data</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>SNo.</th>
                        <th>Employee Name</th>
                        <th>Liquid Name</th>
                        <th>Opening QTY</th>
                        <th>Closing QTY</th>
                        <th>Sale</th>
                        <th>Sale Amt</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $sno = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <th>$sno</th>
                                    <td>{$row['employee1']}</td>
                                    <td>{$row['product1']}</td>
                                    <td>{$row['xg1_start_reading']}</td>
                                    <td>{$row['xg1_close_reading']}</td>
                                    <td>{$row['xg1_net_sale']}</td>
                                    <td>{$row['xg1_total_amount']}</td>
                                    
                                    <td>
                                <a href='liquidedit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='liquiddelete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                            </td>
                                  </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No items found</td></tr>";
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

        <div class="bg-white p-4 shadow-sm rounded">
            <h5>Employee 2 Data</h5>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <<th>SNo.</th>
                            <th>Employee Name</th>
                            <th>Liquid Name</th>
                            <th>Opening QTY</th>
                            <th>Closing QTY</th>
                            <th>Sale</th>
                            <th>Sale Amt</th>
                            <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result2->num_rows > 0) {
                        $sno = 1;
                        while ($row = $result2->fetch_assoc()) {
                            echo "<tr>
                                    <th>$sno</th>
                                    <td>{$row['employee2']}</td>
                                    <td>{$row['product2']}</td>
                                    <td>{$row['xg2_start_reading']}</td>
                                    <td>{$row['xg2_close_reading']}</td>
                                    <td>{$row['xg2_net_sale']}</td>
                                    <td>{$row['xg2_total_amount']}</td>
                                    <td>
                                <a href='liquidedit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='liquiddelete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                            </td>
                                  </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No items found</td></tr>";
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