<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity</title>
    <style>
        body {
            background-image: url('assets/img/orange.jpg'); /* Replace with your background image URL */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            backdrop-filter: blur(10px); /* Adjust the blur intensity as needed */
            background-color: rgba(255, 255, 255, 0.7); /* Adjust the background color and opacity as needed */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
        }

        .edit-form label {
            font-weight: bold;
            display: block;
            margin: 10px 0;
        }

        .edit-form input, .edit-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f9f9f9;
            color: #333;
        }

        .edit-form button {
            background-color: #F4A261;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .edit-form button:hover {
            background-color: #EE6352;
        }
        .radio-label {
            display: flex;
            align-items: center;
            margin-right: 20px; /* Adjust the margin as needed for spacing between options */
        }

    </style>
</head>
<body>
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

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        // Retrieve the activity ID from the URL
        $activityId = $_GET["id"];

        // Query to select the activity with the given ID
        $sql = "SELECT id, title, content, date, time, location, ootd, status, remarks FROM activities WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $activityId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Store the activity details in variables
            $id = $row["id"];
            $title = $row["title"];
            $content = $row["content"];
            $date = $row["date"];
            $time = $row["time"];
            $location = $row["location"];
            $ootd = $row["ootd"];
            $status = $row["status"];
            $remarks = $row["remarks"];
        } else {
            // Activity not found
            echo "Activity not found.";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editId"])) {
        // Get form data
        $id = $_POST["editId"];
        $title = $_POST["editTitle"];
        $content = $_POST["editContent"];
        $date = $_POST["editDate"];
        $time = $_POST["editTime"];
        $location = $_POST["editLocation"];
        $ootd = $_POST["editOOTD"];
        $status = $_POST["editStatus"];
        $remarks = $_POST["editRemarks"]; // Get Remarks data from the form
        
        // Update the activity in the database
        $sql = "UPDATE activities SET title=?, content=?, date=?, time=?, location=?, ootd=?, status=?, remarks=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $title, $content, $date, $time, $location, $ootd, $status, $remarks, $id);
        
        if ($stmt->execute()) {
            // Redirect to the activities list page or display a success message
            header("Location: activity_list.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
?>

<div class="container">
    <h1 style="font-family: Arial, sans-serif; color: #333;">Edit Activity</h1>
    <form method="POST">
        <input type="hidden" name="editId" value="<?php echo $id; ?>">
        <div class="edit-form">
            <label for="editTitle">Title:</label>
            <input type="text" id="editTitle" name="editTitle" value="<?php echo $title; ?>">
        </div>

        <div class="edit-form">
            <label for="editContent">Content:</label>
            <textarea id="editContent" name="editContent" rows="4"><?php echo $content; ?></textarea>
        </div>

        <div class="edit-form">
            <label for="editDate">Date:</label>
            <input type="date" id="editDate" name="editDate" value="<?php echo $date; ?>">
        </div>

        <div class="edit-form">
            <label for="editTime">Time:</label>
            <input type="time" id="editTime" name="editTime" value="<?php echo $time; ?>">
        </div>

        <div class="edit-form">
            <label for="editLocation">Location:</label>
            <input type="text" id="editLocation" name="editLocation" value="<?php echo $location; ?>">
        </div>

        <div class="edit-form">
            <label for="editOOTD">OOTD:</label>
            <input type="text" id="editOOTD" name="editOOTD" value="<?php echo $ootd; ?>">
        </div>

        <label for="editStatus">Status:</label>
        <select id="editStatus" name="editStatus">
            <option value="Plan" <?php if ($status === 'Plan') echo 'selected'; ?>>Plan</option>
            <option value="Cancel" <?php if ($status === 'Cancel') echo 'selected'; ?>>Cancel</option>
            <option value="Done" <?php if ($status === 'Done') echo 'selected'; ?>>Done</option>
        </select><br><br>

        <div class="edit-form">
            <label for="editRemarks">Remarks:</label>
            <textarea id="editRemarks" name="editRemarks" rows="4"><?php echo $remarks; ?></textarea>
        </div>

        <button type="submit">Save Changes</button>
        <a href="activity_list.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
