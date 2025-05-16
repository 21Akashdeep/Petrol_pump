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

// Fetch Vendors Data
$sql = "SELECT * FROM liquidrate LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM liquidrate";
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
    <?php include '../navbar.php'; ?>
    <!-- Main Content -->
    <div class="container container-content">

        <!-- Table Section -->
        <div class="bg-white p-4 shadow-sm rounded">
            <div class="btn-custom">
                <button type="button" class="btn btn-success mb-3"
                    onclick="window.location.href='../create/createliquidrate.php'">New liquid Rate</button>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>SNo.</th>
                        <th>Mobile 2T</th>
                        <th>Mobile 1 ltr</th>
                        <th>D water 1 ltr</th>
                        <th>D water 5 ltr</th>
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
                                    <td>{$row['mobile_2t_rate']}</td>
                                    <td>{$row['mobile_1t_rate']}</td>
                                    <td>{$row['mobile_D1_rate']}</td>
                                    <td>{$row['mobile_D5_rate']}</td>
                                
                                    <td>
                                <a href='../edit/liquidrateedit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='../delete/liquidratedelete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                            </td>
                                  </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No vendors found</td></tr>";
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
    <footer>
        <p><strong>Copyright © 2025 <a href="https://pcats.co.in/" class="brand" target="_blank">P-Cats,
                    Jamshedpur</a>.</strong> All
            rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>