<?php
session_start();
include '../one/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Add faculty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_faculty'])) {
    $name = $_POST['name'];
   
    $query = "INSERT INTO faculty (name) VALUES ('$name')";
    if ($conn->query($query)) {
        $message = "Faculty added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Remove faculty
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_faculty'])) {
    $faculty_id = $_POST['faculty_id'];

    $query = "DELETE FROM faculty WHERE faculty_id = $faculty_id";
    if ($conn->query($query)) {
        $message = "Faculty removed successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Faculty</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .message {
            margin-bottom: 10px;
            color: green;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            text-align: left;
            font-weight: bold;
            margin: 8px 0 4px;
        }

        input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .back-link {
            margin-top: 15px;
            display: inline-block;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Faculty</h2>
    <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>

    <form method="POST">
        <h3>Add Faculty</h3>
        <input type="text" name="name" placeholder="Full Name" required>
        <button type="submit" name="add_faculty">Add Faculty</button>
    </form>

    <form method="POST">
        <h3>Remove Faculty</h3>
        <input type="number" name="faculty_id" placeholder="Faculty ID" required>
        <button type="submit" name="remove_faculty">Remove Faculty</button>
    </form>

    <a href="admin_dashboard.php" class="back-link">⬅ Back to Dashboard</a>
</div>

</body>
</html>