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
    $stmt = $connection->prepare("INSERT INTO payment (payment_id, user_id, amounts, payment_dates) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $payment_id, $user_id, $amounts, $payment_dates);
    
    // Set parameters and execute
    $payment_id = $_POST['payment_id'];
    $user_id = $_POST['user_id'];
    $amounts = $_POST['amounts'];
    $payment_dates = $_POST['payment_dates'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// SQL query to fetch data from the instructors table
$sql = "SELECT * FROM payment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of payment</title>
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
    <center><h2>Table of payment</h2></center>
    <table border="5">
        <tr>
            <th>payment_id</th>
            <th>user_id</th>
            <th>email</th>
            <th>payment_dates</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any instructors
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $payment_id = $row['payment_id']; // Fetch the id
                echo "<tr>
                    <td>" . $row['payment_id'] . "</td>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['amounts'] . "</td>
                    <td>" . $row['payment_dates'] . "</td>
                    <td><a style='padding:4px' href='delete_payment.php?payment_id=$payment_id'>Delete</a></td>
                    <td><a style='padding:4px' href='update_payment.php?payment_id=$payment_id'>Update</a></td> 
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
