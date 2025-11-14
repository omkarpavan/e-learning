<?php
include '../one/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['course_code']) || empty($_POST['course_code'])) {
        echo "<script>alert('Course ID is missing!'); window.location.href='view_courses.php';</script>";
        exit();
    }

    $student_id = $_SESSION['student_id'] ?? null;
    if (!$student_id) {
        echo "<script>alert('Student not logged in!'); window.location.href='login.php';</script>";
        exit();
    }

    $course_id = $_POST['course_code']; 

    // Check if the student already enrolled
    $stmt_check = $conn->prepare("SELECT * FROM enrollments WHERE student_id = ? AND course_code = ?");
    $stmt_check->bind_param("is", $student_id, $course_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Already enrolled in this course!'); window.location.href='view_courses.php';</script>";
        exit();
    }

    // Insert enrollment record
    $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_code) VALUES (?, ?)");
    $stmt->bind_param("ss", $student_id, $course_id);

    if ($stmt->execute()) {
        echo "<script>alert('Successfully Enrolled!'); window.location.href='view_courses.php';</script>";
    } else {
        echo "<script>alert('Error in Enrollment!');</script>";
    }
}
?>
