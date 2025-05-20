<?php
// Simple "Forgot Password" form for admin/employee

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST['phone'];

    // You should implement logic to verify the phone and send a reset link or OTP.
    // For now, just show a message.
    $message = "If this phone number is registered, a password reset link or instructions will be sent.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <style>
        body {
            background: #f4f6f8;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .forgot-container {
            background: #fff;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
            width: 350px;
            text-align: center;
        }

        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background: #0056b3;
        }

        .message {
            color: #007bff;
            margin-top: 15px;
            font-size: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            display: inline-block;
            margin-top: 18px;
        }
    </style>
</head>

<body>
    <div class="forgot-container">
        <h2>Forgot Password</h2>
        <form method="POST" action="">
            <label for="phone">Enter your registered phone number</label>
            <input type="tel" name="phone" id="phone" placeholder="Phone number" required>
            <button type="submit">Send Reset Link</button>
        </form>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <a href="../index.php">&larr; Back to Login</a>
    </div>
</body>

</html>