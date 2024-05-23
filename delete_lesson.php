<?php
include('database_connection.php');

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if lesson_title is set
if(isset($_REQUEST['lesson_title'])) {
    $lesson_title = $_REQUEST['lesson_title'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM lesson WHERE lesson_title=?");
    $stmt->bind_param("i", $lesson_title);

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: skyblue;
            }

            .container {
                max-width: 600px;
                margin: 100px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .container h1 {
                text-align: center;
                margin-bottom: 20px;
            }

            .delete-form {
                text-align: center;
            }

            .delete-form input[type="submit"] {
                padding: 10px 20px;
                font-size: 16px;
                background-color: blue;
                border: none;
                color: #fff;
                cursor: pointer;
                border-radius: 5px;
            }

            .delete-form input[type="submit"]:hover {
                background-color: #cc0000;
            }
        </style>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <div class="container">
            <h1>Delete Record</h1>
            <form class="delete-form" method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="lesson_title" value="<?php echo $lesson_title; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($stmt->execute()) {
                echo "Record deleted successfully.";
            } else {
                echo "Error deleting data: " . $stmt->error;
            }

            $stmt->close();
            ?>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "lesson_title is not set.";
}

$connection->close();
?>
