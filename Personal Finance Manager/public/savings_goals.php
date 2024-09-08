<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');

// Handle form submission for adding a new goal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goal_name'])) {
    $goal_name = $_POST['goal_name'];
    $goal_amount = $_POST['goal_amount'];
    $user_id = $_SESSION['user_id'];

    // Insert new goal into the database
    $sql = "INSERT INTO savings_goals (user_id, goal_name, goal_amount, current_amount) VALUES (?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isd", $user_id, $goal_name, $goal_amount);
    $stmt->execute();
}

// Fetch user's savings goals
$sql = "SELECT id, goal_name, goal_amount, current_amount FROM savings_goals WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$savings_goals = $result->fetch_all(MYSQLI_ASSOC);

// Set a default theme if not already set
$current_theme = isset($current_theme) ? $current_theme : 'light-theme';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="savings_goals.css">
    <title>Savings Goals</title>
</head>
<body>
<?php include('../templates/user_header.php'); ?>

<div class="savings-container">
    <h1>Savings Goals</h1>
    
    <form id="add-goal-form" method="POST">
        <fieldset>
            <legend>Add New Goal</legend>
            <label for="goal_name">Goal Name:</label>
            <input type="text" id="goal_name" name="goal_name" placeholder="e.g., Vacation, Emergency Fund" required>

            <label for="goal_amount">Goal Amount:</label>
            <input type="number" id="goal_amount" name="goal_amount" placeholder="Enter amount" required>

            <input type="submit" value="Add Goal">
        </fieldset>
    </form>

    <section class="goals-list">
        <h2>Your Goals</h2>
        <?php if (empty($savings_goals)): ?>
            <p>No savings goals set yet.</p>
        <?php else: ?>
            <?php foreach ($savings_goals as $goal): ?>
                <div class="goal-item">
                    <h3><?php echo htmlspecialchars($goal['goal_name']); ?></h3>
                    <p>Goal Amount: <?php echo htmlspecialchars($goal['goal_amount']); ?> KSh</p>
                    <p>Current Amount: <?php echo htmlspecialchars($goal['current_amount']); ?> Ksh</p>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: <?php echo ($goal['current_amount'] / $goal['goal_amount']) * 100; ?>%;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</div>

<?php include('../templates/footer.php'); ?>
<script src="savings_goals.js"></script>
</body>
</html>
