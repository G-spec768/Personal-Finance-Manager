<?php
include('../src/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Prepare the SQL statement
    $sql = "INSERT INTO users (first_name, last_name, email, phone, username, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone, $username, $password);

    if ($stmt->execute()) {
        // Registration successful
        header('Location: login.php?success=1');
    } else {
        // Registration failed
        $error = "Error: " . $stmt->error;
    }
}
?>
