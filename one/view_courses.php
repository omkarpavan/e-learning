<?php
include '../one/database.php';
session_start();

// Ensure student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$stmt = $conn->prepare("
    SELECT courses.* FROM courses
    INNER JOIN enrollments ON courses.course_code = enrollments.course_code
    WHERE enrollments.student_id = ?
");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Container */
        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Course Cards */
        .course {
            background: #f9f9f9;
            padding: 15px;
            margin: 10px 0;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .course:hover {
            transform: scale(1.03);
        }

        strong {
            font-size: 18px;
            color: #007bff;
        }

        /* Course Links */
        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background 0.3s;
        }

        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>My Enrolled Courses</h2>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="course">
            <strong><?php echo htmlspecialchars($row['course_name']); ?></strong><br>
            <a href="set_course_session.php?course_code=<?php echo urlencode($row['course_code']); ?>">View Course Materials</a>
        </div>
    <?php } ?>
</div>

</body>
</html>
