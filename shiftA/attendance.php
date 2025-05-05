<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morning Shift Attendance</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: lightblue; }
    </style>
</head>
<body>
    <h2>Morning Shift Attendance Form</h2>
    <form action="attendance.php" method="post">
        <table>
            <tr>
                <th>Name of Employee</th>
                <th>In Time</th>
                <th>Out Time</th>
            </tr>
            <tr>
                <td><input type="text" name="employee_name" required></td>
                <td><input type="time" name="in_time" required></td>
                <td><input type="time" name="out_time" required></td>
            </tr>
        </table>
        <br>
        <button type="submit">Submit</button>
        <button type="button" onclick="window.history.back();">Back</button>

    </form>

    <?php
        // Database Connection
        $conn = new mysqli('localhost', 'root', 'Rajukumar@21', 'vendors');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['employee_name'];
            $in_time = $_POST['in_time'];
            $out_time = $_POST['out_time'];

            $sql = "INSERT INTO attendance (employee_name, in_time, out_time) VALUES ('$name', '$in_time', '$out_time')";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Attendance recorded successfully!</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>
</body>
</html>