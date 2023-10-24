<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mywebsite';

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a user_id to identify the user you want to update
$user_id = 1; // Replace with the actual user ID

// Retrieve data from the form
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$job = isset($_POST['job']) ? $_POST['job'] : '';
$country = isset($_POST['country']) ? $_POST['country'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Combine first name and last name into 'fullname'
$fullName = $firstName . ' ' . $lastName;

// SQL query to update user profile
$sql = "UPDATE access SET 
        firstname = '$firstName',
        lastname = '$lastName',
        job = '$job',
        country = '$country',
        address = '$address',
        phone = '$phone',
        email = '$email'
        WHERE id = $user_id";

if ($conn->query($sql) === TRUE) {
    // Redirect to user-profile.php
    header('Location: user-profile.php');
    exit;
} else {
    echo "Error updating profile: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
