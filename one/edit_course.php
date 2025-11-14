<?php
include '../one/database.php';

if (isset($_GET['id'])) {
    $course_code = $_GET['id'];

    // Fetch the course details
    $sql = "SELECT * FROM courses WHERE course_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $course_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();

    if (!$course) {
        echo "Course not found!";
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $branch = $_POST['branch'];
    $video_link = $_POST['video_link'];

    // Function to upload files
    function uploadFile($file, $existingFile) {
        if ($file['size'] > 0) {
            $target_dir = "../uploads/";
            $file_name = basename($file["name"]);
            $target_file = $target_dir . $file_name;
            move_uploaded_file($file["tmp_name"], $target_file);
            return $file_name; // Return the new file name
        }
        return $existingFile; // If no new file uploaded, keep old file
    }

    $ppt = uploadFile($_FILES['ppt'], $course['ppt']);
    $lecture_notes = uploadFile($_FILES['lecture_notes'], $course['lecture_notes']);
    $question_papers = uploadFile($_FILES['question_papers'], $course['question_papers']);
    $important_questions = uploadFile($_FILES['important_questions'], $course['important_questions']);
    $lab_manuals = uploadFile($_FILES['lab_manuals'], $course['lab_manuals']);

    // Update query
    $update_sql = "UPDATE courses 
                   SET course_name=?, year=?, semester=?, branch=?, ppt=?, lecture_notes=?, question_papers=?, important_questions=?, lab_manuals=?, video_link=? 
                   WHERE course_code=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sisssssssss", $course_name, $year, $semester, $branch, $ppt, $lecture_notes, $question_papers, $important_questions, $lab_manuals, $video_link, $course_code);

    if ($stmt->execute()) {
        echo "<script>alert('Course updated successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error updating course: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Course</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Course Code (Cannot Edit)</label>
            <input type="text" name="course_code" value="<?= $course['course_code'] ?>" readonly>

            <label>Course Name</label>
            <input type="text" name="course_name" value="<?= $course['course_name'] ?>" required>

            <label>Year</label>
            <input type="number" name="year" value="<?= $course['year'] ?>" required>

            <label>Semester</label>
            <input type="number" name="semester" value="<?= $course['semester'] ?>" required>

            <label>Branch</label>
            <input type="text" name="branch" value="<?= $course['branch'] ?>" required>

            <label>PPT (Current: <a href="../uploads/<?= $course['ppt'] ?>" target="_blank">View</a>)</label>
            <input type="file" name="ppt">

            <label>Lecture Notes (Current: <a href="../uploads/<?= $course['lecture_notes'] ?>" target="_blank">View</a>)</label>
            <input type="file" name="lecture_notes">

            <label>Question Papers (Current: <a href="../uploads/<?= $course['question_papers'] ?>" target="_blank">View</a>)</label>
            <input type="file" name="question_papers">

            <label>Important Questions (Current: <a href="../uploads/<?= $course['important_questions'] ?>" target="_blank">View</a>)</label>
            <input type="file" name="important_questions">

            <label>Lab Manuals (Current: <a href="../uploads/<?= $course['lab_manuals'] ?>" target="_blank">View</a>)</label>
            <input type="file" name="lab_manuals">
          <label>Video Link</label>
            <input type="url" name="video_link" value="<?= $course['video_link'] ?>">

            <button type="submit">Update Course</button>
        </form>
    </div>
</body>
</html>
