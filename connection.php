<?php
// Connection settings
$host = "localhost";
$username = "id20299988_sqluser";
$password = "c&P2HD^aa0Ld\C6[";
$dbname = "id20299988_mybase";

// Create a new connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
