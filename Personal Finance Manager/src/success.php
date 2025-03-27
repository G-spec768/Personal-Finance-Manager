<?php
// Start a session if not already started
session_start();

if (!isset($_SESSION['registered'])) {
    header("Location: ../public/register.php");
    exit();
}

unset($_SESSION['registered']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="../public/register_login.css">
</head>
<body>
    <?php include('../templates/header.php'); ?>

    <div class="container">
        <h2>Registration Successful</h2>
        <p>Congratulations! Your account has been created successfully.</p>
        <p><a href="login.php">Click here to login</a></p>
    </div>

    <?php include('../templates/footer.php'); ?>
</body>
</html>
