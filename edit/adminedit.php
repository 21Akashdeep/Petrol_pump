<?php
include '../db_connect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM adminsignup WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<form method="POST" action="../update/adminupdate.php">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <label>Company Name:</label>
    <input type="text" name="company_name" value="<?= $row['company_name'] ?>" required>
    <button type="submit">Update</button>
</form>
 