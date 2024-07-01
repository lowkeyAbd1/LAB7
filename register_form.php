<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $accessLevel = $_POST['accessLevel'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'initialize');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO users (matric, name, address, city, accessLevel, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $matric, $name, $address, $city, $accessLevel, $password);
        $stmt->execute();
        echo "Registration Successful!";
        header('Location: shoutbox.php');
        $stmt->close();
        $conn->close();
    }
}
?>
