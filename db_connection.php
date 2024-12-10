<?php
$servername = "localhost";
$username = "root";  // Your DB username
$password = "";  // Your DB password
$dbname = "pharmacy_db";  // Your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>









