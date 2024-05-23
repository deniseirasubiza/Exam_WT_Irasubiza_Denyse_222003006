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
    $stmt = $connection->prepare("INSERT INTO modules(module_id, title, description) VALUES (?, ?, ?)"); 
    $stmt->bind_param("sss", $module_id, $title, $description);
    // Set parameters and execute
  $module_id = $_POST['module_id'];
   $title = $_POST['title'];
   $description = $_POST['description'];
    
   
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the lesson table
$sql = "SELECT * FROM modules";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of modules</title>
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
    <center><h2>Table of modules</h2></center>
    <table border="5">
        <tr>
            <th>module_id</th>
            <th>title</th>
            <th>description</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $module_id = $row['module_id']; // Fetch the id
                echo "<tr>
                    <td>" . $row['module_id'] . "</td>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td><a style='padding:4px' href='delete_modules.php?module_id=$module_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_modules.php?module_id=$module_id'>Update</a></td> 
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
