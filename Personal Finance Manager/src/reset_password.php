<?php
include('../src/config.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists and is not expired
    $sql = "SELECT user_id, expires FROM password_resets WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $expires);
        $stmt->fetch();

        // Check if the token has expired
        if (time() > $expires) {
            echo "The reset token has expired.";
            exit();
        }
    } else {
        echo "Invalid token.";
        exit();
    }
} else {
    echo "No token provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../public/register_login.css">
</head>
<body>
<?php include('../templates/header.php'); ?>
<div class="container">
    <h2>Reset Password</h2>
    <form action="update_password.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

        <label for="new_password">New Password:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>

        <input type="submit" value="Reset Password">
    </form>
</div>
<?php include('../templates/footer.php'); ?> 
</body>
</html>
