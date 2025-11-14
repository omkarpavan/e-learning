<?php 
session_start();
include '../one/database.php';

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    die("Access denied. Please login first.");
}

$student_id = $_SESSION['student_id']; // Student ID from session

// Validate course_code
if (!isset($_GET['course_code']) || empty($_GET['course_code'])) {
    die("Error: Course code is required.");
}
$course_code = htmlspecialchars($_GET['course_code']); // Prevent XSS

// Validate file type
if (!isset($_GET['file']) || empty($_GET['file'])) {
    die("Error: File type is required.");
}
$file_type = $_GET['file']; 

// Allowed file types (ensure it matches database columns)
$allowed_files = ['ppt', 'lecture_notes', 'question_papers', 'important_questions', 'lab_manuals', 'video_link'];
if (!in_array($file_type, $allowed_files)) {
    die("Invalid file type.");
}

// Fetch the correct file name or link from the database
$query = $conn->prepare("SELECT $file_type FROM courses WHERE course_code = ?");
$query->bind_param("s", $course_code);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

if (!$row || empty($row[$file_type])) {
    die("Error: No file found in the database.");
}

$file_name = $row[$file_type];  // Get the actual file name or URL

// If it's a video link, redirect to it
if ($file_type === 'video_link') {
    // Optional: validate URL format (http or https only)
    if (!preg_match('/^https?:\/\//', $file_name)) {
        die("Invalid video URL.");
    }

    // Log the video access
    $stmt = $conn->prepare("INSERT INTO course_downloads (student_id, course_code, file_name) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $student_id, $course_code, $file_name);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect to the video URL
    header("Location: " . $file_name);
    exit();
}

// Otherwise, handle file download
$file_path = __DIR__ . "/uploads/" . $file_name;

if (!file_exists($file_path)) {
    die("Error: File not found at " . $file_path);
}

// Log the download
$stmt = $conn->prepare("INSERT INTO course_downloads (student_id, course_code, file_name) VALUES (?, ?, ?)");
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("sss", $student_id, $course_code, $file_name);
if (!$stmt->execute()) {
    die("Error inserting download record: " . $stmt->error);
}
$stmt->close();

// Serve the file
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
header('Content-Length: ' . filesize($file_path));
readfile($file_path);
exit();
?>
