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

// SQL query to count activities for each month
$sql = "SELECT MONTH(date) AS month_number, COUNT(id) AS activity_count FROM activities GROUP BY MONTH(date)";

// Execute the query
$result = $conn->query($sql);

if ($result) {
    $data = array();

    // Define an array of colors for each month
    $colors = array(
        1 => 'rgba(255, 99, 132, 0.6)',
        2 => 'rgba(54, 162, 235, 0.6)',
        3 => 'rgba(255, 206, 86, 0.6)',
        4 => 'rgba(75, 192, 192, 0.6)',
        5 => 'rgba(153, 102, 255, 0.6)',
        6 => 'rgba(255, 159, 64, 0.6)',
        7 => 'rgba(255, 99, 132, 0.6)',
        8 => 'rgba(54, 162, 235, 0.6)',
        9 => 'rgba(255, 206, 86, 0.6)',
        10 => 'rgba(75, 192, 192, 0.6)',
        11 => 'rgba(153, 102, 255, 0.6)',
        12 => 'rgba(255, 159, 64, 0.6)'
    );

    while ($row = $result->fetch_assoc()) {
        $month_number = $row['month_number'];
        $activity_count = $row['activity_count'];
        $data[] = $activity_count;
        $colors[] = $colors[$month_number];
    }

    // Return data as JSON, including the colors
    $response = array(
        'data' => $data,
        'colors' => $colors
    );

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Log any errors to the PHP error log
    error_log("MySQL Error: " . $conn->error);
}

$conn->close();
?>
