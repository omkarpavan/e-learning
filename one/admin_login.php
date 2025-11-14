<?php
session_start();
include '../one/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM admins WHERE admin_id='$admin_id' AND password='$password'");
    if ($result->num_rows > 0) {
        $_SESSION['admin_id'] = $admin_id;
        header("Location: admin_dashboard.php");
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-container {
            background: #fff;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            width: 350px;
            border: 1px solid #ddd;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        @media (max-width: 400px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST">
            <label>Admin ID:</label>
            <input type="text" name="admin_id" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
