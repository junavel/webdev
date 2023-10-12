<?php

session_start();

include_once("included/dbutil.php");

$conn = getConnection();

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * from access where email = '".$email."' and password = '".$password."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row["email"] == $email && $row["password"]== $password){ 
     if ($row["role"] == "admin") {
         $_SESSION["user_role"] = "admin"; 

         header("Location: Admin/index.html");

        } else {

            $_SESSION["user_role"] = "user";

            header("Location: User/index.html");

        }
} else {
    header("Location: index.php");
}

closeConnection();

?>