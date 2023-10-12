<?php

$servername = "localhost"; 
$username = "root"; 
$dbpassword = ""; 
$dbname = "mywebsite";

// Create a database connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get the database connection
function getConnection() {
    global $conn;
    return $conn;
}

// Function to close the database connection
function closeConnection() {
    global $conn;
    if ($conn) {
        $conn->close();
    }
}
?>
