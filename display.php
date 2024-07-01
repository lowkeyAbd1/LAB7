<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'test');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>Matric</th><th>Name</th><th>Access Level</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['matric']}</td><td>{$row['name']}</td><td>{$row['accessLevel']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
