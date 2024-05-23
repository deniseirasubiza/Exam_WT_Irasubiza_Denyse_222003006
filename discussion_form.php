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
    $stmt = $connection->prepare("INSERT INTO discussion_form(post_title, post_content, post_date) VALUES (?, ?, ?)"); 
    $stmt->bind_param("sss", $post_title, $post_content, $post_date);
    // Set parameters and execute
  $post_title = $_POST['post_title'];
   $post_content = $_POST['post_content'];
   $post_date = $_POST['post_date'];
    
   
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the lesson table
$sql = "SELECT * FROM discussion_form";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of discussion_form</title>
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
    <center><h2>Table of discussion_form</h2></center>
    <table border="5">
        <tr>
            <th>post_title</th>
            <th>post_content</th>
            <th>post_date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $post_title = $row['post_title']; // Fetch the id
                echo "<tr>
                    <td>" . $row['post_title'] . "</td>
                    <td>" . $row['post_content'] . "</td>
                    <td>" . $row['post_date'] . "</td>
                    <td><a style='padding:4px' href='delete_discussion_form.php?post_title=$post_title'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_discusson_form.php?post_title=$post_title'>Update</a></td> 
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
