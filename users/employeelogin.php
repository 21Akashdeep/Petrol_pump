<?php
session_start();

if(isset($_POST["submit1"]))
{
    $_SESSION['username'] = $_POST['t1'];
    $link=mysqli_connect("localhost","root","Rajukumar@21");
    mysqli_select_db($link,"pcatswzu_complains");
    $res =mysqli_query($link, "select *from signup where username='$_POST[t1]' && password='$_POST[t2]'");
    while($row=mysqli_fetch_array($res))
    {
        ?>
<script type="text/javascript">
    window.location = "user.php";
</script>
<?php
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>practice</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>


</head>

<body>

    <div class="form">


    </div>
    <div class="">
        <div class="row">
            <div class="col-6 col-md-4"></div>
            <div class="col-6 col-md-4" style="background-color: aliceblue;margin-Top:15%;">
            
                <form method="post">
                <h4 style="display:flex;justify-content: center;">Employee Log In</h4>
                <div class="mb-3">
                    <label for="t1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="t1" aria-describedby="emailHelp" required>
                    
                </div>
                
                <div class="mb-3">
                    <label for="t2" class="form-label">Password</label>
                    <input type="password" class="form-control" name="t2" required>
                </div>
                
                <button type="submit" class="btn btn-primary" name="submit1">Login</button>
                

                    <!-- <button>login</button> -->
                </form>

            </div>
            <div class="col-6 col-md-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>