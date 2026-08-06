<?php
// Connect to the local MySQL server
$cn = mysqli_connect("localhost", "root", "", "cybersecurity_club");

// If the connection fails, show an error and stop the page
if (!$cn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>