<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');
$user_id = $_SESSION['user_id'];



// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        // Update profile
        $username = $_POST['username'];
        $email = $_POST['email'];
        $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $email, $user_id);
        $stmt->execute();
    } elseif (isset($_POST['update_settings'])) {
        // Update settings
        $notifications = implode(',', $_POST['notifications'] ?? []);
        $theme = $_POST['theme'];
        $current_theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light-theme';
        $language = $_POST['language'];
        $currency = $_POST['currency'];
        $sql = "UPDATE user_settings SET notifications = ?, theme = ?, language = ?, currency = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $notifications, $theme, $language, $currency, $user_id);
        $stmt->execute();
    } elseif (isset($_POST['add_reminder'])) {
        // Add reminder
        $title = $_POST['title'];
        $description = $_POST['description'];
        $reminder_date = $_POST['reminder_date'];
        if (!empty($title) && !empty($reminder_date)) {
            $sql = "INSERT INTO reminders (user_id, title, description, reminder_date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $user_id, $title, $description, $reminder_date);
            $stmt->execute();
        }
    }
}

// Fetch user profile
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Fetch user settings
$sql = "SELECT notifications, theme, language, currency FROM user_settings WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$settings = $stmt->get_result()->fetch_assoc();

// Fetch user notifications
$sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$notifications = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch user reminders
$sql = "SELECT * FROM reminders WHERE user_id = ? ORDER BY reminder_date";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$reminders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="all_settings.css">
</head>
<body>
<?php include('../templates/user_header.php'); ?>

<!-- Profile Section -->
<div class="profile-container">
    <h1>Profile</h1>
    <div class="profile-picture-container">
        <img src="path/to/profile-picture.jpg" alt="Profile Picture">
        <form method="POST" action="upload_picture.php" enctype="multipart/form-data">
            <input type="file" name="profile_picture" accept="image/*">
            <input type="submit" value="Upload Picture">
        </form>
    </div>
    <form id="profile-form" method="POST" action="../src/update_profile.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <input type="submit" value="Update Profile">
    </form>
    <?php if (isset($success_message)): ?>
        <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
    <?php endif; ?>
</div>


<!-- Settings Section -->
<div class="settings-container">
    <h1>Settings</h1>
    <form id="settings-form" method="POST" action="../src/update_settings.php">
        <fieldset>
            <legend>Notification Preferences</legend>
            <label>
                <input type="checkbox" name="notifications[]" value="email" <?php echo in_array('email', explode(',', $settings['notifications'])) ? 'checked' : ''; ?>>
                Email Notifications
            </label>
            <label>
                <input type="checkbox" name="notifications[]" value="sms" <?php echo in_array('sms', explode(',', $settings['notifications'])) ? 'checked' : ''; ?>>
                SMS Notifications
            </label>
        </fieldset>

        <fieldset>
            <legend>Theme Settings</legend>
            <label>
                <input type="radio" name="theme" value="light" <?php echo $settings['theme'] === 'light' ? 'checked' : ''; ?>>
                Light Mode
            </label>
            <label>
                <input type="radio" name="theme" value="dark" <?php echo $settings['theme'] === 'dark' ? 'checked' : ''; ?>>
                Dark Mode
            </label>

            <label for="theme-switcher">Choose a theme:</label>
            <select id="theme-switcher">
                <option value="light-theme" <?php echo $current_theme === 'light-theme' ? 'selected' : ''; ?>>Light</option>
                <option value="dark-theme" <?php echo $current_theme === 'dark-theme' ? 'selected' : ''; ?>>Dark</option>
                <option value="solarized-theme" <?php echo $current_theme === 'solarized-theme' ? 'selected' : ''; ?>>Solarized</option>
            </select>
        </fieldset>




        <fieldset>
            <legend>Language & Currency</legend>
            <label for="language">Language:</label>
            <select id="language" name="language">
                <option value="en" <?php echo $settings['language'] === 'en' ? 'selected' : ''; ?>>English</option>
                <option value="es" <?php echo $settings['language'] === 'es' ? 'selected' : ''; ?>>Spanish</option>
                <!-- Add more languages as needed -->
            </select>

            <label for="currency">Currency:</label>
            <select id="currency" name="currency">
                <option value="usd" <?php echo $settings['currency'] === 'usd' ? 'selected' : ''; ?>>USD</option>
                <option value="eur" <?php echo $settings['currency'] === 'eur' ? 'selected' : ''; ?>>EUR</option>
                <!-- Add more currencies as needed -->
            </select>
        </fieldset>

        <input type="submit" value="Save Settings">
        <input type="button" id="reset-settings" class="reset-settings" value="Reset to Default">
    </form>
</div>


<!-- Notifications Section -->
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

<!-- Reminders Section -->
<div class="reminder-container">
    <h1>Set Reminder</h1>
    <form id="reminder-form" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        
        <label for="reminder_date">Reminder Date:</label>
        <input type="date" id="reminder_date" name="reminder_date" required>
        
        <input type="submit" name="add_reminder" value="Set Reminder">
    </form>
    
    <h1>Your Reminders</h1>
    <table id="reminders-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reminders as $reminder): ?>
                <tr>
                    <td><?php echo htmlspecialchars($reminder['title']); ?></td>
                    <td><?php echo htmlspecialchars($reminder['description']); ?></td>
                    <td><?php echo htmlspecialchars($reminder['reminder_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../templates/footer.php'); ?>
<script src="combined.js"></script>
</body>
</html>
