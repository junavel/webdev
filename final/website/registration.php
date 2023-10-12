<?php
session_start();
include_once("included/DBUtil.php"); // Include your database configuration

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and sanitize user inputs
    $firstName = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $inputPassword = $_POST["password"]; // Do not hash the password
    $age = filter_var($_POST["age"], FILTER_VALIDATE_INT);
    $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    $gender = $_POST["gender"];
    $role = 'user';

    // Validation (You can add more validation as needed)
    if (empty($firstName) || empty($lastName) || empty($email) || empty($inputPassword) || empty($age) || empty($address) || empty($gender)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // Create connection
    $conn = mysqli_connect($servername, $username, $dbpassword, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the email already exists in the database
    $sql_check = "SELECT * FROM access WHERE email = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $email);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Email already exists, display an error message or redirect with an error
        echo "Email already registered. Please use a different email.";
    } else {
        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO access (firstname, lastname, email, password, age, address, gender, role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ssssisss", $firstName, $lastName, $email, $inputPassword, $age, $address, $gender, $role);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Registration successful, redirect to a confirmation page or display a success message
                header("Location: index.php");
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>
<!-- Your HTML form goes here -->
