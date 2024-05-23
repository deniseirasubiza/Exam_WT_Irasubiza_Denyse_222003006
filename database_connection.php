<?php
// Connection details
$host = "localhost";
$user = "denise";
$pass = "222003006";
$database = "online_learning_management_system";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>