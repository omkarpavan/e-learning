<?php
session_start();
include '../one/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch student count
$student_count = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'];

// Fetch faculty count
$faculty_count = $conn->query("SELECT COUNT(*) as total FROM faculty")->fetch_assoc()['total'];

// Fetch course count
$course_count = $conn->query("SELECT COUNT(*) as total FROM courses")->fetch_assoc()['total'];

// Fetch downloads count
$downloads_count = $conn->query("SELECT COUNT(*) as total FROM course_downloads")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 700px;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .card {
            flex: 1;
            min-width: 200px;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        h3 {
            margin-top: 20px;
            color: #444;
        }

        .actions {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }

        .actions li {
            margin: 10px 0;
        }

        .actions a {
            text-decoration: none;
            font-size: 16px;
            color: #007bff;
            font-weight: bold;
            transition: 0.3s;
        }

        .actions a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Dashboard</h2>
    
    <div class="dashboard">
        <div class="card">📚 Students: <?php echo $student_count; ?></div>
        <div class="card">👨‍🏫 Faculty: <?php echo $faculty_count; ?></div>
        <div class="card">📖 Courses: <?php echo $course_count; ?></div>
        <div class="card">📥 Downloads: <?php echo $downloads_count; ?></div>
    </div>

    <h3>Quick Actions</h3>
    <ul class="actions">
        <li><a href="manage_students.php">📌 Manage Students</a></li>
        <li><a href="manage_faculty.php">👨‍🏫 Manage Faculty</a></li>
        <li><a href="assign_faculty.php">🔗 Assign Faculty to Courses</a></li>
        <li><a href="generate_reports.php">📊 Generate Reports</a></li>
    </ul>
</div>

</body>
</html>
