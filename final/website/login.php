<?php
session_start();
include_once("included/dbutil.php");

$conn = getConnection();

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * from access where email = '".$email."' and password = '".$password."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row["email"] == $email && $row["password"]== $password) {
    // Login successful
    $_SESSION["user_id"] = $row["user_id"]; // Assuming you have a user ID
    $_SESSION["user_full_name"] = $row["user_full_name"]; // Replace with the actual user's full name column name
    $_SESSION["user_job"] = $row["user_job"]; // Replace with the actual user's job column name
    // Add other user-related session variables as needed

    if ($row["role"] == "admin") {
        $_SESSION["user_role"] = "admin";
        header("Location: Admin/index.html");
    } else {
        $_SESSION["user_role"] = "user";
        header("Location: User/index.html");
    }
} else {
    // Login failed
    header("Location: index.php");
}

closeConnection();
?>
