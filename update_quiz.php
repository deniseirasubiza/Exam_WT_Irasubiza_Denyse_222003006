<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if Product_Id is set
if(isset($_REQUEST['quiz_id'])) {
    $quiz_id = $_REQUEST['quiz_id'];
    
    $stmt = $connection->prepare("SELECT * FROM quizzes WHERE quiz_id=?");
    $stmt->bind_param("i", $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['quiz_id'];
        $y = $row['quiz_title'];
        $z = $row['questions'];
    } else {
        echo "quiz not found.";
    }
    $stmt->close(); // Close the statement after use
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Quiz</title>
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

        input[type="text"] {
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
        <label for="quiz_title">Quiz Title:</label>
        <input type="text" name="quiz_title" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="questions">Questions:</label>
        <input type="text" name="questions" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $quiz_title = $_POST['quiz_title'];
    $questions = $_POST['questions'];
    
    // Update the quiz in the database
    $stmt = $connection->prepare("UPDATE quizzes SET quiz_title=? ,questions=? WHERE quiz_id=?");
    $stmt->bind_param("sss", $quiz_title, $questions, $quiz_id);
    $stmt->execute();
    
    // Redirect to quiz.php
    header('Location: quiz.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
