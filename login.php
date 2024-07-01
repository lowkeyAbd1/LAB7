<?php
session_start();
$matric = $_POST['matric'];
$password = $_POST['password'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'your_database');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE matric='$matric' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['matric'] = $matric;
    header('Location: shoutbox.php');
} else {
    echo "Invalid Matric or Password";
}
$conn->close();
?>
