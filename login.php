<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) { // Verify password
            header("Location: homepage.html"); // Redirect to homepage
        } else {
            header("Location: index.html?error=login");
        }
    } else {
        header("Location: index.html?error=login");
    }
}
$conn->close();
?>
