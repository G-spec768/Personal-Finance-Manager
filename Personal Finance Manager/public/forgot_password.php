<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../public/register_login.css">
</head>
<body>
<?php include('../templates/header.php'); ?>
<div class="container">

    <h2>Forgot Password</h2>
    <form action="send_reset_link.php" method="post">
        <label for="email">Enter your email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Send Reset Link">
    </form>

</div>
<?php include('../templates/footer.php'); ?> 
</body>
</html>
