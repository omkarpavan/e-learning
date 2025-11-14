<?php
include '../one/database.php'; // Ensure this contains your DB connection
session_start();

// Check if the student is logged in
if (!isset($_SESSION['student_id'])) {
    echo "<script>alert('You must log in first!'); window.location.href='login.php';</script>";
    exit();
}

$student_id = $_SESSION['student_id']; // Get student ID from session

// Fetch available courses from the database
$sql = "SELECT course_code, course_name FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll in a Course</title>
</head>
<body>
    <h2>Enroll in a Course</h2>
    
    <form action="enroll_course.php" method="POST">
        <label for="course_code">Select Course:</label>
        <select name="course_code" required>
            <option value="">-- Select Course --</option>
            <?php
            // Populate dropdown with courses
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['course_code'] . "'>" . $row['course_name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <button type="submit">Enroll</button>
    </form>
    
    <br>
    <a href="view_courses.php">View Enrolled Courses</a>
</body>
</html>
