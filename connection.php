<?php
// Connection settings
$host = "localhost";
$username = "sqluser";
$password = "password";
$dbname = "mybase";

// Create a new connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>