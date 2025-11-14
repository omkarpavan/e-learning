<?php
include '../one/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 90%;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Heading */
        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            overflow-x: auto;
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
            transition: 0.3s;
        }

        /* Icons */
        .icon {
            width: 40px;
            height: auto;
            transition: transform 0.2s;
        }

        .icon:hover {
            transform: scale(1.1);
        }

        /* Action Buttons */
        .action-btn {
            padding: 6px 10px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin: 3px;
        }

        .edit-btn {
            background: #28a745;
        }

        .edit-btn:hover {
            background: #218838;
        }

        .delete-btn {
            background: #dc3545;
        }

        .delete-btn:hover {
            background: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }
        }
        .icon {
    width: 120px; /* Increase size */
    height: auto; /* Maintain aspect ratio */
    transition: transform 0.2s;
}

.icon:hover {
    transform: scale(1.2); /* Slightly enlarge on hover */
}
    </style>
</head>
<body>
    <div class="container">
        <h2>My Courses</h2>
        <table border="1">
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Year</th>
                <th>Semester</th>
                <th>Branch</th>
                <th>PPT</th>
                <th>Lecture Notes</th>
                <th>Question Papers</th>
                <th>Important Questions</th>
                <th>Lab Manuals</th>
                <th>Video Link</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM courses";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['course_code']}</td>
                            <td>{$row['course_name']}</td>
                            <td>{$row['year']}</td>
                            <td>{$row['semester']}</td>
                            <td>{$row['branch']}</td>
                            <td><a href='../uploads/{$row['ppt']}' target='_blank'><img src='images/ppt_icon1.png' class='icon' alt='PPT'></a></td>
                            <td><a href='../uploads/{$row['lecture_notes']}' target='_blank'><img src='images/notes_icon.jpg' class='icon' alt='Lecture Notes'></a></td>
                            <td><a href='../uploads/{$row['question_papers']}' target='_blank'><img src='images/question_paper_icon.jfif' class='icon' alt='Question Papers'></a></td>
                            <td><a href='../uploads/{$row['important_questions']}' target='_blank'><img src='images/important_icon.jfif' class='icon' alt='Important Questions'></a></td>
                            <td><a href='../uploads/{$row['lab_manuals']}' target='_blank'><img src='images/lab_manual_icon.jfif' class='icon' alt='Lab Manuals'></a></td>
                            <td><a href='{$row['video_link']}' target='_blank'><img src='images/video_icon.jpg' class='icon' alt='Video Link'></a></td>
                            <td>
                                <a href='edit_course.php?id={$row['course_code']}' class='action-btn edit-btn'>Edit</a>
                                <a href='delete_course.php?id={$row['course_code']}' class='action-btn delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No courses found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
