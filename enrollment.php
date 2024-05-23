
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
    $stmt = $connection->prepare("INSERT INTO enrollment(student_name, course_title, enrollment_date, status) VALUES (?, ?, ?, ?)"); 
    $stmt->bind_param("ssss", $student_name, $course_title, $enrollment_date, $status);
    // Set parameters and execute
   $student_name = $_POST['student_name'];
   $course_title = $_POST['course_title'];
   $enrollment_date = $_POST['enrollment_date'];
   $status = $_POST['status'];
   
   
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the notification table
$sql = "SELECT * FROM enrollment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of enrollment</title>
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
            background-color:blue;
        }
        tr:nth-child(even) {
            background-color: pink;
        }
        tr:hover {
            background-color: pink;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        footer {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <center><h2>Table of enrollment</h2></center>
    <table border="5">
        <tr>
            <th>student_name</th>
            <th>course_title</th>
            <th>enrollment_date</th>
            <th>status</th>
            <th>Delete</th>
           
        </tr>
        <?php
        // Check if there are any bookings
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $student_name = $row['student_name']; // Fetch the id
                echo "<tr>
                    <td>" . $row['student_name'] . "</td>
                    <td>" . $row['course_title'] . "</td>
                    <td>" . $row['enrollment_date'] . "</td>
                    <td>" . $row['status'] . "</td>
                    <td><a style='padding:4px' href='delete_enrollment.php?student_name=$student_name'>Delete</a></td> 
                    
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
