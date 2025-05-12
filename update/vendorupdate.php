<?php
include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $company_name = $_POST['company_name'];
    $gst_no = $_POST['gst_no'];
    $pan_no = $_POST['pan_no'];
    $contact_no = $_POST['contact_no'];
    $contact_person_no = $_POST['contact_person_no'];

    $sql = "UPDATE vendors SET 
                company_name = '$company_name',
                gst_no = '$gst_no',
                pan_no = '$pan_no',
                contact_no = '$contact_no',
                contact_person_no = '$contact_person_no'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Vendor updated successfully!');window.location.href='../list/vendorlist.php';</script>";
    } else {
        echo "<script>alert('Error updating vendor: " . mysqli_error($conn) . "');history.back();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vendor</title>
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
        <h3 class="text-center mb-4">Update Vendor</h3>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input type="text" class="form-control" name="company_name" value="<?= $company_name ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">GST No.</label>
                <input type="text" class="form-control" name="gst_no" value="<?= $gst_no ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Pan No.</label>
                <input type="text" class="form-control" name="pan_no" value="<?= $pan_no ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Contact No.</label>
                <input type="tel" class="form-control" name="contact_no" value="<?= $contact_no ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Person No.</label>
                <input type="tel" class="form-control" name="contact_person_no" value="<?= $contact_person_no ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Vendor</button>
        </form>
        <div class="text-center mt-3">
            <a href="../list/vendorlist.php" class="btn btn-secondary">Back to Vendor List</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>