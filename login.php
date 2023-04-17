<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "globalsd";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if user exists
$user = $_POST['username'];
$pass = $_POST['password'];

$stmt = mysqli_prepare($conn, "SELECT * FROM usuarios WHERE user=? AND pass=?");
mysqli_stmt_bind_param($stmt, "ss", $user, $pass);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
  header("Location: index_fail.html");
} else {
  // User exists, insert their location, time and username into the user_location table
  $location = $_POST['location'];
  $time = $_POST['time'];
  $day = date('Y-m-d');

  $stmt = mysqli_prepare($conn, "INSERT INTO user_location (username, location, time, day) VALUES (?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "ssss", $user, $location, $time, $day);
  mysqli_stmt_execute($stmt);

  // Redirect to loggedin.html
  header("Location: loggedin.html");
}

mysqli_close($conn);
?>
