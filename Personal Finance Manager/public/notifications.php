<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');

// Fetch notifications for the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$notifications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="notifications.css">
</head>
<body>
<?php include('../templates/user_header.php'); ?>

<div class="notifications-container">
    <h1>Your Notifications</h1>
    <table id="notifications-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notifications as $notification): ?>
                <tr>
                    <td><?php echo htmlspecialchars($notification['date']); ?></td>
                    <td><?php echo htmlspecialchars($notification['type']); ?></td>
                    <td><?php echo htmlspecialchars($notification['message']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../templates/footer.php'); ?>
<script src="notifications.js"></script>
</body>
</html>
