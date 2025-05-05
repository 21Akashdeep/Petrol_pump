<?php


if($_POST){
$username=$_POST["username"];
$phone=$_POST["phone"];
$password=$_POST["password"];
// $Re_password=$_POST['Re-password'];

$link = new mysqli('localhost','root','','admin');

if(mysqli_connect_error()){
    die ("connection error");
}

$query ="insert into signupadmin (username,phone,password)values ('$username','$phone','$password')";
// $dbresult = $db->query ($query);
if($link->query($query)===TRUE){
    echo "ADDED: ".$username.",".$phone.",".$password;
    header("location:Adminlogin.php");
}
else{
    echo "error: ".$query."<br>".$link->error;
}
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body>
    <div class="row">
        <div class="col-6 col-md-4"></div>
        <div class="col-6 col-md-4" style="background-color: aliceblue;">
            <h4 style="display:flex;justify-content: center;">Admin Sign up</h4>

            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
                    
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone number</label>
                    <input type="number" class="form-control" name="phone">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <label for="Re-password" class="form-label">Re password</label>
                    <input type="password" class="form-control" name="Re-password">
                </div>

                
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="Adminlogin.php">
                <button type="button" class="btn btn-primary">Back</button>
                </a>
            </form>
        </div>
        <div class="col-6 col-md-4"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>