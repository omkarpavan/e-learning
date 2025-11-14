<?php
include '../one/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $branch = $_POST['branch'];

    $stmt = $conn->prepare("SELECT * FROM courses WHERE year = ? AND semester = ? AND branch = ?");
    $stmt->bind_param("iis", $year, $semester, $branch);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .course {
            background: #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
        }

        .enroll-btn {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        .enroll-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Available Courses</h2>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="course">
            <div>
                <strong><?php echo $row['course_name']; ?></strong><br>
                <?php echo "Course Code: " . $row['course_code']; ?>
            </div>
            <form action="enroll_course.php" method="POST">
                <input type="hidden" name="course_code" value="<?php echo $row['course_code']; ?>">
                <button type="submit" class="enroll-btn">Enroll in this Course</button>
            </form>
        </div>
    <?php } ?>
</div>

</body>
</html>
