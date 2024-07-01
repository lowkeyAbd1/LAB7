<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'your_database');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "Deletion Successful!";
        $stmt->close();
        $conn->close();
    }
}
?>
