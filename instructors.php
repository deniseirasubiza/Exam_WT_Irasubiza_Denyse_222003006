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
    $stmt = $connection->prepare("INSERT INTO instructors (instructor_id, name, email, specialization) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $instructor_id, $name, $email, $specialization);
    
    // Set parameters and execute
    $instructor_id = $_POST['instructor_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the instructors table
$sql = "SELECT * FROM instructors";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of instructors</title>
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
    <center><h2>Table of instructors</h2></center>
    <table border="5">
        <tr>
            <th>instructor_id</th>
            <th>name</th>
            <th>email</th>
            <th>specialization</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any instructors
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $instructor_id = $row['instructor_id']; // Fetch the id
                echo "<tr>
                    <td>" . $row['instructor_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['specialization'] . "</td>
                    <td><a style='padding:4px' href='delete_instructors.php?instructor_id=$instructor_id'>Delete</a></td>
                    <td><a style='padding:4px' href='update_instructors.php?instructor_id=$instructor_id'>Update</a></td> 
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
