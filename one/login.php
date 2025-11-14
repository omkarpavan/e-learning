<?php
session_start();
include '../one/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $query = "SELECT student_id, student_name, password FROM students WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Directly compare the plain text password
        if ($password === $row['password']) {
            $_SESSION['student_id'] = $row['student_id'];
            $_SESSION['student_name'] = $row['student_name'];
            header("Location: course_selection.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid student ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 1px solid #ddd;
        }

        h2 {
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            text-align: left;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        p.error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        @media (max-width: 500px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="">
        <label for="student_id">Student ID</label>
        <input type="text" name="student_id" id="student_id" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
