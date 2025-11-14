<?php
session_start();
include '../one/database.php';

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    die("Access denied. Please login first.");
}

// Ensure course_code is set in session
if (!isset($_SESSION['course_code'])) {
    die("Error: No course selected.");
}

$course_code = $_SESSION['course_code']; // Get course_code from session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Materials</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; text-align: center; background-color: #f4f4f4; }
        .container { max-width: 500px; margin: auto; padding: 20px; background: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px; }
        h2 { color: #333; }
        .btn { 
            display: block; width: 90%; margin: 10px auto; padding: 12px; 
            background: #007bff; color: white; text-decoration: none; 
            border-radius: 5px; font-size: 16px; font-weight: bold; transition: 0.3s;
        }
        .btn:hover { background: #0056b3; }
        .back-btn { background: #ff5722; } 
        .back-btn:hover { background: #d84315; }
    </style>
</head>
<body>

<div class="container">
    <h2>Materials for Course: <?php echo htmlspecialchars($course_code); ?></h2>

    <a href="download.php?file=ppt&course_code=<?php echo urlencode($course_code); ?>" class="btn">📂 Download PPT</a>
    <a href="download.php?file=lecture_notes&course_code=<?php echo urlencode($course_code); ?>" class="btn">📖 Download Lecture Notes</a>
    <a href="download.php?file=question_papers&course_code=<?php echo urlencode($course_code); ?>" class="btn">📝 Download Question Papers</a>
    <a href="download.php?file=video_link&course_code=<?php echo urlencode($course_code); ?>" class="btn">▶ Watch Lecture Video</a>

    <a href="my_courses.php" class="btn back-btn">⬅ Back to My Courses</a>
</div>

</body>
</html>
