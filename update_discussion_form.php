<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['post_title'])) {
    $post_title = $_REQUEST['post_title'];
    
    $stmt = $connection->prepare("SELECT * FROM discussion_form WHERE post_title=?");
    $stmt->bind_param("i", $post_title);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['post_title'];
        $y = $row['post_content'];
        $z = $row['post_date'];
    } else {
        echo "discussion_form not found.";
    }
    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="post_content">Post Content:</label>
        <input type="text" name="post_content" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="post_date">Post Date:</label>
        <input type="date" name="post_date" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $post_content = $_POST['post_content'];
    $post_date = $_POST['post_date'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE discussion_form SET post_content=?, post_date=? WHERE post_title=?");
    $stmt->bind_param("sss", $post_content, $post_date, $post_title);
    $stmt->execute();
    
    // Redirect to discussion_form.php
    header('Location: discussion_form.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
