<?php
include '../db_connect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM vendors WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Validate and sanitize the 'id' parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid vendor ID.');
}
$id = intval($_GET['id']);

// Fetch vendor details securely
$sql = "SELECT * FROM vendors WHERE id=$id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    die('Vendor not found.');
}
$row = mysqli_fetch_assoc($result);
?>
< <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Vendor</title>
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
            <h3 class="text-center mb-4">Edit Vendor</h3>
            <form method="POST" action="../update/vendorupdate.php">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="company_name" value="<?= $row['company_name'] ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">GST No.</label>
                    <input type="number" class="form-control" name="gst_no" value="<?= $row['gst_no'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pan No.</label>
                    <input type="text" class="form-control" name="pan_no" value="<?= $row['pan_no'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contact No.</label>
                    <input type="tel" class="form-control" name="contact_no" value="<?= $row['contact_no'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contact Person No.</label>
                    <input type="tel" class="form-control" name="contact_person_no"
                        value="<?= $row['contact_person_no'] ?>">
                </div>
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
            <div class="text-center mt-3">
                <a href="index.html" class="btn btn-outline-secondary">Back to Dashboard</a>
            </div>
        </div>
    </body>

    </html>