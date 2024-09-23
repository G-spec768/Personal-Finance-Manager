<?php
include('../src/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT); // Hash the new password

    // Update the password in the users table
    $sql = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_password, $user_id);

    if ($stmt->execute()) {
        // Delete the reset token
        $sql = "DELETE FROM password_resets WHERE token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();

        echo "Password has been reset successfully.";
        header('Location: login.php');
    } else {
        echo "Error resetting password.";
    }
}
?>
