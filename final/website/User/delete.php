<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mywebsite';

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the user ID from the query parameter
if (isset($_GET['id'])) {
    $activity_id = $_GET['id'];

    // Create a SQL query to delete the user based on ID
    $sql = "DELETE FROM activities WHERE id = $activity_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to activity_list.php
        header("Location: activity_list.php");
        exit(); // Important to stop further script execution
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
</body>
</html>
    