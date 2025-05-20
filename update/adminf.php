<?php
include '../db_connect.php';

$conn = db_connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            background: #f4f6f8;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reset-container {
            background: #fff;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
            width: 350px;
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
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

        .error {
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

        a {
            color: #007bff;
            text-decoration: none;
            display: inline-block;
            margin-top: 18px;
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <h2>Reset Password</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['username'])) {
                $username = $_POST['username'];

                // Check if user exists by username
                $stmt = $conn->prepare("SELECT * FROM adminsignup WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // User exists, now check if password is set in POST
                    if (!empty($_POST['password'])) {
                        $password = $_POST['password'];
                        $update = $conn->prepare("UPDATE adminsignup SET password = ? WHERE username = ?");
                        $update->bind_param("ss", $password, $username);
                        if ($update->execute()) {
                            echo "<div class='message'>Password updated successfully.</div>";
                        } else {
                            echo "<div class='error'>Error updating password.</div>";
                        }
                        $update->close();
                    } else {
                        // Show password form
                        ?>
                        <form method="POST" action="">
                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                            <label for="password">New Password:</label>
                            <input type="password" name="password" id="password" required>
                            <button type="submit">Reset Password</button>
                        </form>
                        <?php
                    }
                } else {
                    echo "<div class='error'>User not found.</div>";
                    // Show username form again
                    ?>
                    <form method="POST" action="">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" required>
                        <button type="submit">Next</button>
                    </form>
                    <?php
                }
                $stmt->close();
            } else {
                echo "<div class='error'>Please enter your Username.</div>";
                ?>
                <form method="POST" action="">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <button type="submit">Next</button>
                </form>
                <?php
            }
            $conn->close();
        } else {
            // Show username form
            ?>
            <form method="POST" action="">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
                <button type="submit">Next</button>
            </form>
            <?php
        }
        ?>
        <a href="../index.php">&larr; Back to Login</a>
    </div>
</body>

</html>