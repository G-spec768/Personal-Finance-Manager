<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');

// Handle form submission for setting a reminder
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $reminder_date = $_POST['reminder_date'];
    $user_id = $_SESSION['user_id'];

    // Validate user input
    if (!empty($title) && !empty($reminder_date)) {
        $sql = "INSERT INTO reminders (user_id, title, description, reminder_date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $user_id, $title, $description, $reminder_date);
        $stmt->execute();
    }
}

// Fetch reminders for the logged-in user
$sql = "SELECT * FROM reminders WHERE user_id = ? ORDER BY reminder_date";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$reminders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminders</title>
    <link rel="stylesheet" href="reminders.css"> <!-- Link to your CSS -->
</head>
<body>
<?php include('../templates/user_header.php'); ?>

<div class="reminder-container">
    <h1>Set Reminder</h1>
    <form id="reminder-form" method="POST" action="reminders.php">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
        
        <label for="reminder_date">Reminder Date:</label>
        <input type="date" id="reminder_date" name="reminder_date" required>
        
        <input type="submit" value="Set Reminder">
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
<script src="reminders.js"></script> <!-- Link to your JS -->
</body>
</html>
