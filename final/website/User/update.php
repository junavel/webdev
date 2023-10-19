<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mywebsite";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $id = $_POST["editId"];
    $title = $_POST["editTitle"];
    $content = $_POST["editContent"];
    $date = $_POST["editDate"];
    $time = $_POST["editTime"];
    $location = $_POST["editLocation"];
    $ootd = $_POST["editOOTD"];
    $status = $_POST["editStatus"];

    // Check if the status is "Remarks"
    if ($status === "Remarks") {
        // Get the remarks data
        $remarks = $_POST["editRemarks"];
        
        // Update the activity with remarks in the database
        $sql = "UPDATE activities SET title=?, content=?, date=?, time=?, location=?, ootd=?, status=?, remarks=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $title, $content, $date, $time, $location, $ootd, $status, $remarks, $id);
    } else {
        // Update the activity without remarks
        $sql = "UPDATE activities SET title=?, content=?, date=?, time=?, location=?, ootd=?, status=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $title, $content, $date, $time, $location, $ootd, $status, $id);
    }

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect back to the activities page or display a success message
        header("Location: activity_list.php");
        exit();
    } else {
        // Handle errors
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>
