<?php
$servername = "localhost";
$username = "web_user"; // Database username
$password = "StrongPassword123"; // Database password
$dbname = "web_db"; // Database name

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the visit counter
$conn->query("UPDATE visits_counter SET visits_count = visits_count + 1 WHERE id = 1");

// Retrieve the current visit count
$result = $conn->query("SELECT visits_count FROM visits_counter WHERE id = 1");
$row = $result->fetch_assoc();
$visits = $row['visits_count'];

// Display the results on the page
echo "<!DOCTYPE html>
<html>
<head>
    <title>Welcome to My Website</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>Your IP Address: " . $_SERVER['REMOTE_ADDR'] . "</p>
    <p>Current Time: " . date('Y-m-d H:i:s') . "</p>
    <p>Connected to the database successfully!</p>
    <p>Total Visits: " . $visits . "</p>
</body>
</html>";

$conn->close();
?>

