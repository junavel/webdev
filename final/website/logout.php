<?php
// Start or resume the session
session_start();

// Destroy the session and unset session variables
session_destroy();
$_SESSION = [];

// Redirect to the index.php page
header("Location: index.php");
exit;
?>
