<?php
include '../one/database.php';

if (isset($_GET['id'])) {
    $course_code = $_GET['id'];

    // Delete the course
    $sql = "DELETE FROM courses WHERE course_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $course_code);

    if ($stmt->execute()) {
        echo "<script>alert('Course deleted successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error deleting course: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
