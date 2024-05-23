<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if submission_id is set
if(isset($_REQUEST['submission_id'])) {
    $submission_id = $_REQUEST['submission_id'];
    
    $stmt = $connection->prepare("SELECT * FROM submissions WHERE submission_id=?");
    $stmt->bind_param("i", $submission_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['submission_id'];
        $y = $row['user_id'];
        $z = $row['assignment_id'];
        $H = $row['submission_date'];
    } else {
        echo "Submissions not found.";
    }
    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Submission</title>
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

        input[type="number"],
        input[type="date"] {
            width: calc(100% - 20px);
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
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="assignment_id">Assignment ID:</label>
        <input type="number" name="assignment_id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="submission_date">Submission Date:</label>
        <input type="date" name="submission_date" value="<?php echo isset($H) ? $H : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['user_id'];
    $assignment_id = $_POST['assignment_id'];
    $submission_date = $_POST['submission_date'];
    
    // Update the submission in the database
    $stmt = $connection->prepare("UPDATE submissions SET user_id=?, assignment_id=?, submission_date=? WHERE submission_id=?");
    $stmt->bind_param("ssss", $user_id, $assignment_id, $submission_date, $submission_id);
    $stmt->execute();
    
    // Redirect to submissions.php
    header('Location: submissions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
