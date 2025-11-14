<?php
include '../one/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            color: #555;
        }

        input[type="text"], input[type="number"], input[type="file"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 14px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        @media (max-width: 480px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create a New Course</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Course Code:</label>
            <input type="text" name="course_code" required>

            <label>Course Name:</label>
            <input type="text" name="course_name" required>

            <label>Year:</label>
            <input type="number" name="year" required>

            <label>Semester:</label>
            <input type="number" name="semester" required>

            <label>Branch:</label>
            <input type="text" name="branch" required>

            <label>Upload PowerPoint Presentation (PPT):</label>
            <input type="file" name="ppt_file">

            <label>Upload Lecture Notes:</label>
            <input type="file" name="lecture_notes">

            <label>Upload Previous Question Papers:</label>
            <input type="file" name="question_papers">

            <label>Upload Important Questions:</label>
            <input type="file" name="important_questions">

            <label>Upload Lab Manuals:</label>
            <input type="file" name="lab_manuals">

            <label>Lecture Video Link:</label>
            <input type="text" name="video_link">

            <button type="submit" name="submit">Create Course</button>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $branch = $_POST['branch'];
    $video_link = $_POST['video_link'];

    $uploadDir = __DIR__ . '/uploads/'; // Correct absolute path

    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    function uploadFile($fileInput, $uploadDir) {
        if (!empty($_FILES[$fileInput]['name'])) {
            $fileName = time() . '_' . basename($_FILES[$fileInput]['name']); // Add timestamp for uniqueness
            $targetPath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES[$fileInput]['tmp_name'], $targetPath)) {
                return $fileName;
            }
        }
        return null;
    }

    // Upload files and get stored filenames
    $ppt = uploadFile('ppt_file', $uploadDir);
    $lecture_notes = uploadFile('lecture_notes', $uploadDir);
    $question_papers = uploadFile('question_papers', $uploadDir);
    $important_questions = uploadFile('important_questions', $uploadDir);
    $lab_manuals = uploadFile('lab_manuals', $uploadDir);

    $stmt = $conn->prepare("INSERT INTO courses (course_code, course_name, year, semester, branch, video_link, ppt, lecture_notes, question_papers, important_questions, lab_manuals) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiisssssss", $course_code, $course_name, $year, $semester, $branch, $video_link, $ppt, $lecture_notes, $question_papers, $important_questions, $lab_manuals);

    if ($stmt->execute()) {
        echo "<script>alert('Course Created Successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
