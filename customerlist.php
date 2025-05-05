<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = "Rajukumar@21"; // Change if needed
$dbname = "vendors"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Vendors Data
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
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
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Customer List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container container-content">
        <!-- <div class="row mb-4">
            <div class="col-md-6">
                <div class="bg-white p-4 shadow-sm rounded">
                    <h5 class="text-center">Section 1</h5>
                    <p class="text-muted text-center">Add relevant details here</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-white p-4 shadow-sm rounded">
                    <h5 class="text-center">Section 2</h5>
                    <p class="text-muted text-center">Additional content goes here</p>
                </div>
            </div>
        </div> -->

        <!-- Table Section -->
        <div class="bg-white p-4 shadow-sm rounded">
            <div class="btn-custom">
                <button type="button" class="btn btn-success mb-3"onclick="window.location.href='createcustomer.php'">Create New Customer</button>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">SNo.</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">GST No.</th>
                        <th scope="col">Pan No.</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Contact Person No.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $sno = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <th>$sno</th>
                                    <td>{$row['company_name']}</td>
                                    <td>{$row['gst_no']}</td>
                                    <td>{$row['pan_no']}</td>
                                    <td>{$row['contact_no']}</td>
                                    <td>{$row['contact_person_no']}</td>
                                  </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No vendors found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
