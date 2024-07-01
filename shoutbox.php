<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header('Location: login.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'initialize');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (message) VALUES (?)");
        $stmt->bind_param("s", $message);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}

// Fetch messages
$conn = new mysqli('localhost', 'root', '', 'initialize');
$sql = "SELECT message FROM messages";
$result = $conn->query($sql);
$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row['message'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shoutbox</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: rgba(158, 86, 41, 0.37); }
        form { margin: 20px; }
        label, input { display: block; margin: 10px 0; }
    </style>
</head>
<body>
    <h2>Shoutbox</h2>
    <form action="shoutbox.php" method="POST">
        <label for="message">Message:</label>
        <input type="text" name="message" id="message" required>
        <input type="submit" value="Shout!">
    </form>

    <?php
    foreach ($messages as $message) {
        echo "<p>" . htmlspecialchars($message) . "</p>";
    }
    ?>
</body>
</html>
