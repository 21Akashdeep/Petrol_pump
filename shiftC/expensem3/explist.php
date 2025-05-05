<?php
$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

// Database Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination Settings
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset Calculation

// Fetch Data with Pagination
$sql = "SELECT expense_name, SUM(amount) AS total_amount, GROUP_CONCAT(vehicle_number SEPARATOR ', ') AS vehicle_numbers
        FROM expensec3 
        GROUP BY expense_name 
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Total Records Count
$count_sql = "SELECT COUNT(DISTINCT expense_name) AS total FROM expensec3";
$count_result = $conn->query($count_sql);
$total_records = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit); // Total Pages Calculation

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense List with Pagination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
            background: #f8f9fa;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .page-link {
            margin: 0 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="table-container">
    <div class="btn-custom">
                <!-- <button type="button" class="btn btn-success mb-3 mx-2"onclick="window.location.href='../users/Adminlogin.php'">Admin login</button> -->
                <button type="button" class="btn btn-success mb-3 mx-3"onclick="window.location.href='expense-form.php'">Create Expense</button>
            </div>
        <h5 class="text-center">Expense Summary</h5>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Expense Name</th>
                    <th>Vehicle Numbers</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['expense_name']}</td>
                                <td>{$row['vehicle_numbers']}</td>
                                <td>₹{$row['total_amount']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No Records Found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav class="pagination">
            <?php if ($page > 1) { ?>
                <a class="btn btn-primary btn-sm page-link" href="?page=<?php echo ($page - 1); ?>">Previous</a>
            <?php } ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <a class="btn btn-secondary btn-sm page-link <?php if ($i == $page) echo 'active'; ?>" href="?page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            <?php } ?>

            <?php if ($page < $total_pages) { ?>
                <a class="btn btn-primary btn-sm page-link" href="?page=<?php echo ($page + 1); ?>">Next</a>
            <?php } ?>
        </nav>

    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
