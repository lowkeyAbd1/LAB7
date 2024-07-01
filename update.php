<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $accessLevel = $_POST['accessLevel'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'your_database');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("UPDATE users SET matric=?, name=?, address=?, city=?, accessLevel=?, password=? WHERE id=?");
        $stmt->bind_param("ssssssi", $matric, $name, $address, $city, $accessLevel, $password, $id);
        $stmt->execute();
        echo "Update Successful!";
        $stmt->close();
        $conn->close();
    }
}
?>
