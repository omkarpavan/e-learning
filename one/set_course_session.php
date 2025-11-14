<?php
session_start();

// Ensure course_code is provided
if (!isset($_GET['course_code'])) {
    die("Error: No course selected.");
}

// Store course_code in session and redirect
$_SESSION['course_code'] = $_GET['course_code'];
header("Location: view_course_material.php");
exit();
?>
