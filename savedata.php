<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "globalsd";

// Get the user's location and time
$location = $_POST['location'];
$time = date('Y-m-d H:i:s'); // Get the current date and time

// Get the username from the button click
$user = $_POST['username'];

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Insert the user's location and time into the user_location table
$stmt = mysqli_prepare($conn, "INSERT INTO user_location (username, location, time) VALUES (?, ?, ?)");

if ($stmt === false) {
    die("Error preparing statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sss", $user, $location, $time);
mysqli_stmt_execute($stmt);

// Close the database connection
mysqli_close($conn);
?>