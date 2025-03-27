<?php
require __DIR__ . '/config.php'; 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize Input
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $error = "Invalid username format. Only letters, numbers, and underscores are allowed.";
    } else {

        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $error = "Username is already taken.";
        }
    }

    if (strlen($password) !== 6) {
        $error = "Password must be exactly 6 characters long.";
    }


    if (empty($error)) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone, username, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $username, $hashed_password);

        if ($stmt->execute()) {
            header("Location: success.php"); 
            exit();
        } else {
            $error = "Registration failed. Please try again.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register_login.css">
</head>
<body>
    <?php include('../templates/header.php'); ?>

    <div class="container">
        <h2>Register</h2>

        <?php if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

        <form action="register_user.php" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Register">
        </form>
    </div>

    <?php include('../templates/footer.php'); ?>
</body>
</html>
