<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activity_id = $_POST['id'];

    // Perform the deletion in the database
    // Modify this code to suit your database structure
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'mywebsite';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM activities WHERE id = $activity_id";
    if ($conn->query($sql) === TRUE) {
        echo "Activity deleted successfully";
    } else {
        echo "Error deleting activity: " . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>
