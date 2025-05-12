<?php
// Show errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "Rajukumar@21";
$dbname = "vendors";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest opening readings for each machine
$latestA1 = $conn->query("SELECT id, xp_start_reading, ms_start_reading FROM shift ORDER BY id DESC LIMIT 1")->fetch_assoc();
$latestA2 = $conn->query("SELECT id, xp_start_reading, ms_start_reading FROM shifta2 ORDER BY id DESC LIMIT 1")->fetch_assoc();
$latestA3 = $conn->query("SELECT id, xp_start_reading, ms_start_reading FROM shifta3 ORDER BY id DESC LIMIT 1")->fetch_assoc();
$latestA4 = $conn->query("SELECT id, xg1_start_reading, xg2_start_reading, ms1_start_reading, ms2_start_reading FROM shifta4 ORDER BY id DESC LIMIT 1")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Machine 1
    $shiftA1_nozzle1 = $_POST['shiftA1_nozzle1_opening'];
    $shiftA1_nozzle2 = $_POST['shiftA1_nozzle2_opening'];
    // Machine 2
    $shiftA2_nozzle1 = $_POST['shiftA2_nozzle1_opening'];
    $shiftA2_nozzle2 = $_POST['shiftA2_nozzle2_opening'];
    // Machine 3
    $shiftA3_nozzle1 = $_POST['shiftA3_nozzle1_opening'];
    $shiftA3_nozzle2 = $_POST['shiftA3_nozzle2_opening'];
    // Machine 4 (4 nozzles)
    $shiftA4_nozzle1 = $_POST['shiftA4_nozzle1_opening'];
    $shiftA4_nozzle2 = $_POST['shiftA4_nozzle2_opening'];
    $shiftA4_nozzle3 = $_POST['shiftA4_nozzle3_opening'];
    $shiftA4_nozzle4 = $_POST['shiftA4_nozzle4_opening'];

    // Machine 1
    if ($latestA1 && isset($latestA1['id'])) {
        $sql1 = "UPDATE shift SET xp_start_reading=?, ms_start_reading=? WHERE id=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("ddi", $shiftA1_nozzle1, $shiftA1_nozzle2, $latestA1['id']);
        $stmt1->execute();
        $stmt1->close();
    }
    // Machine 2
    if ($latestA2 && isset($latestA2['id'])) {
        $sql2 = "UPDATE shifta2 SET xp_start_reading=?, ms_start_reading=? WHERE id=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("ddi", $shiftA2_nozzle1, $shiftA2_nozzle2, $latestA2['id']);
        $stmt2->execute();
        $stmt2->close();
    }
    // Machine 3
    if ($latestA3 && isset($latestA3['id'])) {
        $sql3 = "UPDATE shifta3 SET xp_start_reading=?, ms_start_reading=? WHERE id=?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("ddi", $shiftA3_nozzle1, $shiftA3_nozzle2, $latestA3['id']);
        $stmt3->execute();
        $stmt3->close();
    }
    // Machine 4 (4 nozzles)
    if ($latestA4 && isset($latestA4['id'])) {
        $sql4 = "UPDATE shifta4 SET xg1_start_reading=?, xg2_start_reading=?, ms1_start_reading=?, ms2_start_reading=? WHERE id=?";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param("dddii", $shiftA4_nozzle1, $shiftA4_nozzle2, $shiftA4_nozzle3, $shiftA4_nozzle4, $latestA4['id']);
        $stmt4->execute();
        $stmt4->close();
    }

    echo "<script>
        alert('Opening readings updated for all machines and nozzles!');
        window.location.href='settingreading.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Opening Reading - Shift A</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 3%;
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center mb-4">Set Opening Reading for Shift A</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Machine 1 Opening Reading</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA1_nozzle1_opening"
                            placeholder="Nozzle 1"
                            value="<?= isset($latestA1['xp_start_reading']) ? $latestA1['xp_start_reading'] : '' ?>"
                            required>
                    </div>
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA1_nozzle2_opening"
                            placeholder="Nozzle 2"
                            value="<?= isset($latestA1['ms_start_reading']) ? $latestA1['ms_start_reading'] : '' ?>"
                            required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Machine 2 Opening Reading</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA2_nozzle1_opening"
                            placeholder="Nozzle 1"
                            value="<?= isset($latestA2['xp_start_reading']) ? $latestA2['xp_start_reading'] : '' ?>"
                            required>
                    </div>
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA2_nozzle2_opening"
                            placeholder="Nozzle 2"
                            value="<?= isset($latestA2['ms_start_reading']) ? $latestA2['ms_start_reading'] : '' ?>"
                            required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Machine 3 Opening Reading</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA3_nozzle1_opening"
                            placeholder="Nozzle 1"
                            value="<?= isset($latestA3['xp_start_reading']) ? $latestA3['xp_start_reading'] : '' ?>"
                            required>
                    </div>
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA3_nozzle2_opening"
                            placeholder="Nozzle 2"
                            value="<?= isset($latestA3['ms_start_reading']) ? $latestA3['ms_start_reading'] : '' ?>"
                            required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Machine 4 Opening Reading</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA4_nozzle1_opening"
                            placeholder="Nozzle 1 (xg1)"
                            value="<?= isset($latestA4['xg1_start_reading']) ? $latestA4['xg1_start_reading'] : '' ?>"
                            required>
                    </div>
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA4_nozzle2_opening"
                            placeholder="Nozzle 2 (xg2)"
                            value="<?= isset($latestA4['xg2_start_reading']) ? $latestA4['xg2_start_reading'] : '' ?>"
                            required>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA4_nozzle3_opening"
                            placeholder="Nozzle 3 (ms1)"
                            value="<?= isset($latestA4['ms1_start_reading']) ? $latestA4['ms1_start_reading'] : '' ?>"
                            required>
                    </div>
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="shiftA4_nozzle4_opening"
                            placeholder="Nozzle 4 (ms2)"
                            value="<?= isset($latestA4['ms2_start_reading']) ? $latestA4['ms2_start_reading'] : '' ?>"
                            required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Opening Readings</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>