<?php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = "Sun123flower@"; // replace with your database password
$dbname = "farm"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
