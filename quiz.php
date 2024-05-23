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
    $stmt = $connection->prepare("INSERT INTO quizzes(quiz_id, quiz_title, questions) VALUES (?, ?, ?)"); 
    $stmt->bind_param("sss", $quiz_id, $quiz_title, $questions);
    // Set parameters and execute
  $quiz_id = $_POST['quiz_id'];
   $quiz_title = $_POST['quiz_title'];
   $questions = $_POST['questions'];
    
   
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the lesson table
$sql = "SELECT * FROM quizzes";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of quizzes</title>
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
    <center><h2>Table of quizzes</h2></center>
    <table border="5">
        <tr>
            <th>quiz_id</th>
            <th>quiz_title</th>
            <th>questions</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $quiz_id = $row['quiz_id']; // Fetch the id
                echo "<tr>
                    <td>" . $row['quiz_id'] . "</td>
                    <td>" . $row['quiz_title'] . "</td>
                    <td>" . $row['questions'] . "</td>
                    <td><a style='padding:4px' href='delete_quiz.php?quiz_id=$quiz_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_quiz.php?quiz_id=$quiz_id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>

    <footer>
        <center> 
            <b><h2>UR CBE BIT &copy, 2024 &reg;, Designer by: @Irasubiza denyse</h2></b>
        </center>
    </footer>
</body>
</html>
