<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['coursename'])) {
    $coursename = $_REQUEST['coursename'];
    
    $stmt = $connection->prepare("SELECT * FROM course WHERE coursename=?");
    $stmt->bind_param("i", $coursename);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['coursename'];
        $y = $row['description'];
        $z = $row['instructor'];
        $w = $row['duration'];
        $H = $row['skills_level'];
    } else {
        echo "course not found.";
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
            background-color: skyblue;
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
        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="instructor">Instructor:</label>
        <input type="text" name="instructor" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="duration">Duration:</label>
        <input type="text" name="duration" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="skill_level">Skill Level:</label>
        <input type="text" name="skill_level" value="<?php echo isset($H) ? $H : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $description = $_POST['description'];
    $instructor = $_POST['instructor'];
    $duration = $_POST['duration'];
    $skill_level = $_POST['skill_level'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE course SET description=?, instructor=?, duration=?, skills_level=? WHERE coursename=?");
    $stmt->bind_param("sssss", $description, $instructor, $duration, $skill_level, $coursename);
    $stmt->execute();
    
    // Redirect to course.php
    header('Location: course.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
