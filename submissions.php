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
    $stmt = $connection->prepare("INSERT INTO submissions (submission_id, user_id, assignment_id, submission_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $submission_id, $user_id, $assignment_id, $submission_date);
    
    // Set parameters and execute
    $submission_id = $_POST['submission_id'];
    $user_id = $_POST['user_id'];
    $assignment_id = $_POST['assignment_id'];
    $submission_date = $_POST['submission_date'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the instructors table
$sql = "SELECT * FROM submissions";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of submissions</title>
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
    <center><h2>Table of submissions</h2></center>
    <table border="5">
        <tr>
            <th>submission_id</th>
            <th>user_id</th>
            <th>assignment_id</th>
            <th>submission_date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any instructors
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $submission_id = $row['submission_id']; // Fetch the id
                echo "<tr>
                    <td>" . $row['submission_id'] . "</td>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['assignment_id'] . "</td>
                    <td>" . $row['submission_date'] . "</td>
                    <td><a style='padding:4px' href='delete_submissions.php?submission_id=$submission_id'>Delete</a></td>
                    <td><a style='padding:4px' href='update_submissions.php?submission_id=$submission_id'>Update</a></td> 
                </tr>"; 
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>

    <footer>
        <center> 
            <b><h2>UR CBE BIT &copy;, 2024 &reg;, Designer by: @Irasubiza denyse</h2></b>
        </center>
    </footer>
</body>
</html>
