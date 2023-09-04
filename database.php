<?php
$host = "localhost"; // Change to your MySQL server host
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$database = "exam"; // Change to your database name

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>