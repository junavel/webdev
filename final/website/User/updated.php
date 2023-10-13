<?php
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

// Retrieve form data
$activityId = $_POST['activityId'];
$title = $_POST['editTitle'];
$content = $_POST['editContent'];
$date = $_POST['editDate'];
$time = $_POST['editTime'];
$location = $_POST['editLocation'];
$ootd = $_POST['editOOTD'];

// Update the activity in the database
$sql = "UPDATE activities
        SET title = '$title',
            content = '$content',
            date = '$date',
            time = '$time',
            location = '$location',
            ootd = '$ootd'
        WHERE activity_id = $activityId";

if ($conn->query($sql) === TRUE) {
    echo "Changes saved successfully.";
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
