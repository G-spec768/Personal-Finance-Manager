<?php
session_start();
include('../src/config.php');

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

// Fetch all users
$sql = "SELECT user_id, username, email, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<link rel="stylesheet" href="admin_stylesheet.css">
<?php include('../templates/admin_header.php'); ?>

<div class="admin-container">
    <h1>Admin Dashboard</h1>
    <h2>All Users</h2>
    <table id="users-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Registered On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['created_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="admin_view_user.php?user_id=<?php echo htmlspecialchars($user['user_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">View Details</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin_auth.php?logout=true">Logout</a>
</div>

<?php include('../templates/admin_footer.php'); ?>
