<?php
$servername = "localhost";
$username = "web_user";
$password = "StrongPassword123";
$dbname = "web_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to the database!";
?>

