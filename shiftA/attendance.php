<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morning Shift Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .attendance-container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            padding: 32px 24px;
        }

        .attendance-title {
            color: #ff6200;
            font-weight: bold;
            text-align: center;
            margin-bottom: 24px;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-custom {
            font-size: 18px;
            font-weight: 600;
            width: 48%;
        }

        .btn-back {
            background: #6c757d;
            color: #fff;
        }

        .btn-back:hover {
            background: #495057;
            color: #fff;
        }

        .success-message {
            color: #198754;
            font-weight: bold;
            text-align: center;
            margin-top: 16px;
        }

        .error-message {
            color: #dc3545;
            font-weight: bold;
            text-align: center;
            margin-top: 16px;
        }
    </style>
</head>

<body>
    <div class="attendance-container">
        <h2 class="attendance-title">Morning Shift Attendance</h2>
        <form action="attendance.php" method="post" autocomplete="off">
            <div class="mb-3">
                <label for="employee_name" class="form-label">Name of Employee</label>
                <input type="text" class="form-control" id="employee_name" name="employee_name" required>
            </div>
            <div class="mb-3">
                <label for="in_time" class="form-label">In Time</label>
                <input type="time" class="form-control" id="in_time" name="in_time" required>
            </div>
            <div class="mb-3">
                <label for="out_time" class="form-label">Out Time</label>
                <input type="time" class="form-control" id="out_time" name="out_time" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success btn-custom">Submit</button>
                <button type="button" class="btn btn-back btn-custom" onclick="window.history.back();">Back</button>
            </div>
        </form>
        <?php
        // Database Connection
        $conn = new mysqli('localhost', 'root', 'Rajukumar@21', 'vendors');
        if ($conn->connect_error) {
            echo '<div class="error-message">Connection failed: ' . $conn->connect_error . '</div>';
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['employee_name'];
                $in_time = $_POST['in_time'];
                $out_time = $_POST['out_time'];

                $sql = "INSERT INTO attendance (employee_name, in_time, out_time) VALUES ('$name', '$in_time', '$out_time')";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="success-message">Attendance recorded successfully!</div>';
                } else {
                    echo '<div class="error-message">Error: ' . $conn->error . '</div>';
                }
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>