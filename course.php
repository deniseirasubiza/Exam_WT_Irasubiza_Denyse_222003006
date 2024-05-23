<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO course(coursename, description, instructor, duration, skills_level) VALUES (?, ?, ?, ?, ?)"); 
    $stmt->bind_param("sssss", $coursename, $description, $instructor, $duration, $skill_level);

    // Set parameters and execute
    $coursename = $_POST['coursename'];
    $description = $_POST['description'];
    $instructor = $_POST['instructor'];
    $duration = $_POST['duration'];
    $skill_level = $_POST['skill_level'];

    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the payment table
$sql = "SELECT * FROM course";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of course</title>
    <style>
        body {
            background-color: pink;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: blue;
            color: white;
        }
        tr:nth-child(even) {
            background-color: pink;
        }
        tr:hover {
            background-color: lightpink;
        }
        a {
            text-decoration: none;
            color: #007bff;
            padding: 4px;
        }
        a:hover {
            text-decoration: underline;
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
        h2 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <center><h2>Table of course</h2></center>
    <table border="5">
        <tr>
            <th>Course Name</th>
            <th>Description</th>
            <th>Instructor</th>
            <th>Duration</th>
            <th>Skill Level</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any courses
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $coursename = $row['coursename']; // Fetch the course name
                echo "<tr>
                    <td>" . $row['coursename'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['instructor'] . "</td>
                    <td>" . $row['duration'] . "</td>
                    <td>" . $row['skills_level'] . "</td>
                    <td><a href='delete_course.php?coursename=$coursename'>Delete</a></td> 
                    <td><a href='update_course.php?coursename=$coursename'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>

    <footer>
        <b>UR CBE BIT &copy;, 2024 &reg;, Designed by: @Irasubiza Denyse</b>
    </footer>
</body>
</html>
