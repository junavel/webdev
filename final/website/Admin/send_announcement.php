<?php
session_start(); // Start the session

// Replace with your database connection details
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $target = $_POST["target"];
    $users = isset($_POST["users"]) ? $_POST["users"] : [];

    // Insert announcement into the database
    $sql = "INSERT INTO announcements (title, content, target, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }

    // Make sure $_SESSION['user_id'] is set correctly based on user authentication
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $stmt->bind_param("sssi", $title, $content, $target, $user_id);

        if ($stmt->execute()) {
            echo "Announcement saved successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: User not authenticated.";
    }

    $stmt->close();

    if ($target === "selected" && !empty($users)) {
        // Send the announcement to the selected users
        foreach ($users as $userId) {
            // Send the announcement to user with ID $userId
            // You can use your preferred method (e.g., email, notifications)
        }
    }
}

// Close the database connection
$conn->close();
?>
