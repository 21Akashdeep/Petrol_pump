<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "Rajukumar@21";
$dbname = "vendors";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Fetch Data in Proper Rows
$sql = "
    SELECT ID, Date_And_Time, Employee_Name1 AS Employee_Name, Collection_Name1 AS Collection_Name, Amount1 AS Amount FROM collectionb3
    UNION 
    SELECT ID, Date_And_Time, Employee_Name2 AS Employee_Name, Collection_Name2 AS Collection_Name, Amount2 AS Amount FROM collectionb3
    ORDER BY Date_And_Time DESC
";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// ✅ Calculate Total Amount
$totalAmount = 0;
while ($row = $result->fetch_assoc()) {
    $totalAmount += $row['Amount'];
}

// Reset the result set to fetch data again
$result->data_seek(0);
// Pagination Variables
$limit = 10; // Number of rows per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch Vendors Data
$sql = "SELECT * FROM collectionb3 LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM collectionb3 LIMIT $limit OFFSET $offset";
$result2 = $conn->query($sql2);

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM collectionb3";
$count_result = $conn->query($sql_count);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Total Records Count
$sql_count = "SELECT COUNT(*) AS total FROM collectionb3";
$count_result = $conn->query($sql_count);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f7f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            text-align: center;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .total-amount {
            background: #ff6600;
            color: white;
            padding: 8px 15px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            display: inline-block;
        }

        .add-new-btn {
            background: #FF6600;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .add-new-btn:hover {
            background: #e65c00;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background: rgb(20, 20, 20);
            color: white;
        }

        .edit-btn,
        .delete-btn {
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            color: white;
        }

        .edit-btn {
            background: #007BFF;
        }

        .edit-btn:hover {
            background: #0056b3;
        }

        .delete-btn {
            background: #DC3545;
        }

        .delete-btn:hover {
            background: #b52b3a;
        }
    </style>
</head>

<body>
    <div class="container">


        <h5>Collection Records 1</h5>

        <div class="header">
            <div class="total-amount">Total Amount: ₹ <?php echo number_format($totalAmount, 2); ?></div>
            <a href="m3collection.php">
                <button class="add-new-btn">Add New</button>
            </a>
            <button type="button" class="add-new-btn" onclick="window.location.href='../mainshiftB.php'">Back</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Date & Time</th>
                    <th>Employee Name</th>
                    <th>Collection</th>
                    <th>Amount</th>
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
                                <td>{$row['Date_And_Time']}</td>
                                <td>{$row['Employee_Name1']}</td>
                                <td>{$row['Collection_Name1']}</td>
                                <td>{$row['Amount1']}</td>
                                <td>
                                <a href='m3collectionedit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='m3collectiondelete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                            </td>
                              </tr>";
                        $sno++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
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
        <h5>collection Record 2</h5>
        <table>
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Date & Time</th>
                    <th>Employee Name</th>
                    <th>Collection</th>
                    <th>Amount</th>
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
                                <td>{$row['Date_And_Time']}</td>
                                <td>{$row['Employee_Name2']}</td>
                                <td>{$row['Collection_Name2']}</td>
                                <td>{$row['Amount2']}</td>
                                <td>
                                <a href='m3collectionedit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='m3collectiondelete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                            </td>
                              </tr>";
                        $sno++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>