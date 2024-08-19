<?php
include('config.php');

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    
    // Prepare SQL query to check username existence
    $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    
    // Return response based on username existence
    if ($count > 0) {
        echo 'taken';
    } else {
        echo 'available';
    }

    $stmt->close();
    $conn->close();
}
?>
