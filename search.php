<?php
// Check if the 'query' GET parameter is set and not empty
if (isset($_GET['query']) && !empty($_GET['query'])) {
    include('database_connection.php');

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'course' => "SELECT coursename FROM course WHERE coursename LIKE ?",
        'lesson' => "SELECT lesson_title FROM lesson WHERE lesson_title LIKE ?",
        'discussion_form' => "SELECT post_title FROM discussion_form WHERE post_title LIKE ?",
        'enrollment' => "SELECT student_name FROM enrollment WHERE student_name LIKE ?",
        'quiz' => "SELECT quiz_title FROM quiz WHERE quiz_title LIKE ?",
        'instructors' => "SELECT name FROM instructors WHERE name LIKE ?",
        'submissions' => "SELECT user_id FROM submissions WHERE user_id LIKE ?",
        'modules' => "SELECT title FROM modules WHERE title LIKE ?",
        'blockchain_resources' => "SELECT type FROM blockchain_resources WHERE type LIKE ?",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    // Check if search term is not empty
    if (!empty($searchTerm)) {
        foreach ($queries as $table => $sql) {
            $stmt = $connection->prepare($sql);
            $likeTerm = "%$searchTerm%";
            $stmt->bind_param("s", $likeTerm);
            $stmt->execute();
            $result = $stmt->get_result();

            echo "<h3>Table of $table:</h3>";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p>" . htmlspecialchars($row[array_keys($row)[0]]) . "</p>"; // Dynamic field extraction from result with HTML escaping
                }
            } else {
                echo "<p>No results found in $table matching the search term: '" . htmlspecialchars($searchTerm) . "'</p>";
            }

            $stmt->close();
        }
    } else {
        echo "<p>No search term was provided.</p>";
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
