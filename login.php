<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $conn->real_escape_string($_POST['username']);
    $user_password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE Name='$user_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($user_password, $row['Password'])) {
            $_SESSION['username'] = $user_username;
            header("Location: welcome.php");
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>
