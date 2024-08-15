<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');

// Fetch current settings
$user_id = $_SESSION['user_id'];
$sql = "SELECT notifications, theme, language, currency FROM user_settings WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$settings = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="settings.css">
    <title>Settings</title>
</head>
<body>
<?php include('../templates/user_header.php'); ?>

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
    </form>
</div>

<?php include('../templates/footer.php'); ?>
<script src="settings.js"></script>
</body>
</html>
