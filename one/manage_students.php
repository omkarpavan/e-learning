<?php
session_start();
include '../one/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch students
$students = $conn->query("SELECT * FROM students");

// Handle student deletion
if (isset($_GET['delete'])) {
    $student_id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE student_id='$student_id'");
    header("Location: manage_students.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
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
            width: 90%;
            max-width: 800px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .add-btn {
            display: inline-block;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: 0.3s;
            margin-bottom: 15px;
        }

        .add-btn:hover {
            background: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f4f4f4;
        }

        .delete-btn {
            color: white;
            background: #dc3545;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            transition: 0.3s;
        }

        .delete-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Students</h2>
    <a href="add_student.php" class="add-btn">➕ Add New Student</a>

    <table>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $students->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><a href="?delete=<?php echo $row['student_id']; ?>" class="delete-btn">❌ Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
