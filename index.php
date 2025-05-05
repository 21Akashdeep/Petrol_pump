<?php
session_start();
include 'db_connect.php'; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $conn = db_connect(); // Call function from db_connect.php

    // Check in admin table
    $query = "SELECT * FROM adminsignup WHERE phone = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $phone, $password);
    $stmt->execute();
    $adminResult = $stmt->get_result();

    if ($adminResult->num_rows > 0) {
        $_SESSION['user_type'] = "admin";
        $_SESSION['phone'] = $phone;
        header("Location: home.php"); // Redirect to admin panel
        exit();
    }

    // Check in employee table
    $query = "SELECT * FROM employeesignup WHERE phone = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $phone, $password);
    $stmt->execute();
    $empResult = $stmt->get_result();

    if ($empResult->num_rows > 0) {
        $_SESSION['user_type'] = "employee";
        $_SESSION['phone'] = $phone;
        header("Location: users/usermachine_A1.php"); // Redirect to employee dashboard
        exit();
    } else {
        header("Location: index.php?error=Invalid Credentials!");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #f4f4f4;
            background: url("images/dashboard.jpg");
            background-size: contain;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background: white;
            padding: 30px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input {
            width: 92%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background: #212529; /* Light gray background */
        color: #6c757d; /* Dark gray text */
        text-align: center;
        padding: 10px;
        font-size: 14px;
        font-family: Arial, sans-serif;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
}

footer p {
    margin: 0;
}

footer a.brand {
    font-weight: bold;
    color: #007bff; /* Blue color for link */
    text-decoration: none;
}

footer a.brand:hover {
    text-decoration: underline;
}


    </style>
</head>
<body>
    <div class="login-container">
        <h2> BPT Login</h2>
        <form action="" method="POST">
            <input type="text" name="phone" placeholder="Enter phone Number" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <p class="error-message">
                <?php if(isset($_GET['error'])) echo $_GET['error']; ?>
            </p>
            <button type="submit">Login</button>
            <!-- <p style="margin-top: 10px;">
        <a href="update/adminf.php" style="text-decoration: none; color: #007bff;">Forgot Password?</a> -->
    </p>
        </form>
    </div>
    <footer>
    <p><strong>Copyright © 2025 <a href="#" class="brand">P-Cats, Jamshedpur</a>.</strong> All rights reserved.</p>
</footer>
</body>
</html>
