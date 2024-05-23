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
    $stmt = $connection->prepare("INSERT INTO blockchain_resources (resource_id, title, description, type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $resource_id, $title, $description, $type);
    
    // Set parameters and execute
    $resource_id = $_POST['resource_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the instructors table
$sql = "SELECT * FROM blockchain_resources";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Information Of Blockchain Resources</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef; /* Light grey background */
            margin: 0;
            padding: 0;
            color: #333;
        }

        h2 {
            color: #333;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 3px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: pink;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: blue;
        }

        a {
            color: #3498db;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #3498db;
            color: #fff;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <center><h2>Table of Blockchain Resources</h2></center>
    <table>
        <tr>
            <th>Resource ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Type</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any instructors
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $resource_id = $row['resource_id']; // Fetch the id
                echo "<tr>
                    <td>" . $row['resource_id'] . "</td>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['type'] . "</td>
                    <td><a href='delete_blockchain_resources.php?resource_id=$resource_id'>Delete</a></td>
                    <td><a href='update_blockchain_resources.php?resource_id=$resource_id'>Update</a></td> 
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
            <b><h2>UR CBE BIT &copy; 2024 &reg;, Designed by: @Irasubiza Denyse</h2></b>
        </center>
    </footer>
</body>
</html>
