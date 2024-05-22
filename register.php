<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $conn->real_escape_string($_POST['username']);
    $user_email = $conn->real_escape_string($_POST['email']);
    $user_password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (Name, Email, Password) VALUES ('$user_username', '$user_email', '$user_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>
