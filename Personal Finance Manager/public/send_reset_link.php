<?php
include('../src/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Generate a unique reset token
        $token = bin2hex(random_bytes(50));
        $expires = date("U") + 3600; // 1 hour expiration

        // Store the token and its expiration in the database
        $sql = "INSERT INTO password_resets (user_id, token, expires) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $token, $expires);
        $stmt->execute();

        // Create the reset link
        $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token;

        // Send the email
        $to = $email;
        $subject = "Password Reset Request";
        $message = "To reset your password, click the link: " . $reset_link;
        $headers = "From: noreply@yourdomain.com";

        mail($to, $subject, $message, $headers);

        echo "Reset link sent to your email.";
    } else {
        echo "No account found with that email address.";
    }
}
?>
