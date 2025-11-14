<?php
session_start();
include '../one/database.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch faculty and courses
$faculty = $conn->query("SELECT faculty_id, name FROM faculty");
$courses = $conn->query("SELECT course_code, course_name FROM courses");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $faculty_id = $_POST['faculty_id'];
    $course_id = $_POST['course_id'];

    // Assign or update faculty-course mapping
    $stmt = $conn->prepare("INSERT INTO faculty_courses (faculty_id, course_code) VALUES (?, ?) 
                            ON DUPLICATE KEY UPDATE course_code = VALUES(course_code)");
    $stmt->bind_param("ss", $faculty_id, $course_id);

    if ($stmt->execute()) {
        $message = "Faculty assigned successfully!";
    } else {
        $message = "Error assigning faculty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Faculty</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 500px; margin: auto; }
        label, select, button { display: block; width: 100%; margin-bottom: 10px; padding: 8px; }
        button { background-color: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>

<div class="container">
    <h2>Assign Faculty to Course</h2>
    <?php if (isset($message)) echo "<p style='color:green;'>$message</p>"; ?>
    
    <form method="POST">
        <label>Select Faculty:</label>
        <select name="faculty_id" required>
            <option value="">--Select Faculty--</option>
            <?php while ($row = $faculty->fetch_assoc()) { ?>
                <option value="<?= $row['faculty_id']; ?>"><?= $row['name']; ?></option>
            <?php } ?>
        </select>

        <label>Select Course:</label>
        <select name="course_id" required>
            <option value="">--Select Course--</option>
            <?php while ($row = $courses->fetch_assoc()) { ?>
                <option value="<?= $row['course_code']; ?>"><?= $row['course_name']; ?></option>
            <?php } ?>
        </select>

        <button type="submit">Assign Faculty</button>
    </form>
</div>

</body>
</html>
