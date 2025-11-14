<?php
session_start();
include '../one/database.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$total_courses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$students_per_course = $conn->query("SELECT c.course_code, c.course_name, COUNT(e.student_id) AS total_students FROM courses c LEFT JOIN enrollments e ON c.course_code = e.course_code GROUP BY c.course_code, c.course_name");
$downloads_per_course = $conn->query("SELECT c.course_code, c.course_name, COUNT(d.course_code) AS total_downloads FROM courses c LEFT JOIN course_downloads d ON c.course_code = d.course_code GROUP BY c.course_code, c.course_name");
$faculty_per_course = $conn->query("SELECT c.course_code, c.course_name, f.name AS faculty_name FROM courses c JOIN faculty_courses fc ON c.course_code = fc.course_code JOIN faculty f ON fc.faculty_id = f.faculty_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        h3 {
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Reports</h2>
        <h3>Number of Courses Created: <?php echo $total_courses; ?></h3>
        
        <h3>Number of Students Enrolled in Each Course</h3>
        <table>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Total Students</th>
            </tr>
            <?php while ($row = $students_per_course->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['course_code']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['total_students']; ?></td>
                </tr>
            <?php } ?>
        </table>
        
        <h3>Number of Downloads Per Course</h3>
        <table>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Total Downloads</th>
            </tr>
            <?php while ($row = $downloads_per_course->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['course_code']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['total_downloads']; ?></td>
                </tr>
            <?php } ?>
        </table>
        
        <h3>Active Faculty Members Per Course</h3>
        <table>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Faculty Name</th>
            </tr>
            <?php while ($row = $faculty_per_course->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['course_code']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['faculty_name']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
