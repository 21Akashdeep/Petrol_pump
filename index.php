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
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("images/dashboard.jpg") no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;

        }

        .login-container {
            background: rgba(255, 255, 255, 0.97);
            padding: 35px 30px 30px 30px;
            width: 350px;
            /* Reduced for better alignment */
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.25);
            border-radius: 12px;
            text-align: left;
            /* Left align content */
            position: relative;
            color: rgb(0, 0, 0);
            font-weight: 700;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Center the form horizontally */
        }

        .login-logo {
            width: 100px;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            margin-bottom: 18px;
            color: #007bff;
            font-weight: 700;
            letter-spacing: 1px;
            text-align: center;
        }

        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        label {
            display: block;
            margin-bottom: 4px;
            font-size: 15px;
            color: #444;
            font-weight: 600;
            margin-top: 10px;
        }

        input[type="tel"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
            box-sizing: border-box;
        }

        .password-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .password-wrapper input[type="password"],
        .password-wrapper input[type="text"] {
            width: 100%;
            padding-right: 38px;
            box-sizing: border-box;
            margin-bottom: 0;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #888;
            padding: 0;
            height: 24px;
            width: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        button[type="submit"] {
            width: 100%;
            padding: 11px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.2s;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background: #0056b3;
        }

        .error-message {
            color: #d8000c;
            background: #ffd2d2;
            border: 1px solid #d8000c;
            border-radius: 4px;
            font-size: 15px;
            margin: 10px 0 0 0;
            padding: 7px 0;
            text-align: center;
            width: 100%;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #212529;
            color: #6c757d;
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
            color: #007bff;
            text-decoration: none;
        }

        footer a.brand:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="images/bpt.ico" alt="Logo" class="login-logo">
        <h2>Login</h2>
        <form action="" method="POST" autocomplete="on">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter phone number" required autocomplete="username">

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Enter password" required
                    autocomplete="current-password">
                <button type="button" class="toggle-password" onclick="togglePassword()"
                    aria-label="Show or hide password">&#128065;</button>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>

            <button type="submit">Login</button>
            <p style="margin-top: 10px; text-align:center;">
                <a href="update/adminf.php" style="text-decoration: none; color: #007bff;">Forgot Password?</a>
            </p>
        </form>
    </div>
    <footer>
        <p><strong>Copyright © 2025 <a href="https://pcats.co.in/" class="brand" target="_blank">P-Cats,
                    Jamshedpur</a>.</strong> All
            rights reserved.</p>
    </footer>
    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const btn = document.querySelector('.toggle-password');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                btn.innerHTML = '&#128064;';
            } else {
                pwd.type = 'password';
                btn.innerHTML = '&#128065;';
            }
        }
    </script>
</body>

</html>