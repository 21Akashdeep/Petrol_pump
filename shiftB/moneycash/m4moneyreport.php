<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #333;
        }

        .no-data {
            text-align: center;
            font-weight: bold;
            color: #ff0000;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 4px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
        }

        .pagination a.disabled {
            background-color: #ccc;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "Rajukumar@21";
    $dbname = "vendors";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Pagination Variables
    $limit = 5; // Ek page pe kitni rows dikhani hain
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Function to display paginated table data
    function displayTable($conn, $tableName, $columns, $headers, $limit, $offset, $page)
    {
        echo "<h2>" . ucfirst(str_replace("_", " ", $tableName)) . " Report</h2>";
        echo "<table>";
        echo "<tr>";
        foreach ($headers as $header) {
            echo "<th>$header</th>";
        }
        echo "</tr>";

        // Total Rows Count
        $totalRowsQuery = "SELECT COUNT(*) as total FROM $tableName";
        $totalRowsResult = $conn->query($totalRowsQuery);
        $totalRows = $totalRowsResult->fetch_assoc()['total'];
        $totalPages = ceil($totalRows / $limit);

        // Fetch Data with Limit & Offset
        $sql = "SELECT * FROM $tableName ORDER BY date_time DESC LIMIT $limit OFFSET $offset";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($columns as $col) {
                    echo "<td>" . $row[$col] . "</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='" . count($headers) . "' class='no-data'>No data found</td></tr>";
        }
        echo "</table>";

        // Pagination Links
        echo "<div class='pagination'>";
        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "'>Previous</a>";
        } else {
            echo "<a class='disabled'>Previous</a>";
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i'>$i</a>";
        }

        if ($page < $totalPages) {
            echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
        } else {
            echo "<a class='disabled'>Next</a>";
        }
        echo "</div>";
    }
    echo '<button type="button" class="btn btn-success mb-3" onclick="window.location.href=\'m4moneycash.php\'"> Add Cash </button>';
    echo '&nbsp;&nbsp;';
    echo '<button type="button" class="btn btn-success mb-3" onclick="window.location.href=\'../mainshiftB.php\'">Back</button>';


    // Displaying tables with pagination
    displayTable($conn, "bankb4", ["id", "denomination", "pieces", "amount", "date_time"], ["ID", "Denomination", "Pieces", "Amount", "Date & Time"], $limit, $offset, $page);
    displayTable($conn, "second_shiftb4", ["id", "denomination", "pieces", "amount", "date_time"], ["ID", "Denomination", "Pieces", "Amount", "Date & Time"], $limit, $offset, $page);
    displayTable($conn, "transactionsb4", ["id", "total_amount", "date_time"], ["ID", "Total Amount", "Date & Time"], $limit, $offset, $page);

    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>