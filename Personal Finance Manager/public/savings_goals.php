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
$errors = [];
$success = '';

// Handle form submission for adding a new goal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goal_name'])) {
    $goal_name = $_POST['goal_name'];
    $goal_amount = $_POST['goal_amount'];

    // Insert new goal into the database
    $sql = "INSERT INTO savings_goals (user_id, goal_name, goal_amount, current_amount) VALUES (?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isd", $user_id, $goal_name, $goal_amount);
    $stmt->execute();
}

// Handle fund allocation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['allocate_amount']) && isset($_POST['goal_id'])) {
    $goal_id = $_POST['goal_id'];
    $allocate_amount = $_POST['allocate_amount'];

    // Fetch current amount for the selected goal
    $sql = "SELECT current_amount, goal_amount FROM savings_goals WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $goal_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $goal = $result->fetch_assoc();

    if ($goal) {
        $new_amount = $goal['current_amount'] + $allocate_amount;

        // Ensure the allocated amount does not exceed the goal amount
        if ($new_amount > $goal['goal_amount']) {
            $errors[] = "The allocation exceeds the goal amount.";
        } else {
            // Update the current amount in the database
            $sql = "UPDATE savings_goals SET current_amount = ? WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("dii", $new_amount, $goal_id, $user_id);

            if ($stmt->execute()) {
                $success = "Funds allocated successfully.";
            } else {
                $errors[] = "Error allocating funds. Please try again.";
            }
        }
    } else {
        $errors[] = "Goal not found.";
    }
}

// Fetch user's savings goals
$sql = "SELECT id, goal_name, goal_amount, current_amount FROM savings_goals WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
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

    <!-- Display success message -->
    <?php if ($success): ?>
        <div class="success-message">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <!-- Display errors -->
    <?php if (!empty($errors)): ?>
        <div class="error-message">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

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

                    <!-- Allocate Funds Form -->
                    <form method="POST" class="allocate-form">
                        <label for="allocate_amount_<?php echo $goal['id']; ?>">Allocate Amount:</label>
                        <input type="number" id="allocate_amount_<?php echo $goal['id']; ?>" name="allocate_amount" placeholder="Enter amount" required>
                        <input type="hidden" name="goal_id" value="<?php echo $goal['id']; ?>">
                        <input type="submit" value="Allocate">
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</div>

<?php include('../templates/footer.php'); ?>
<script src="savings_goals.js"></script>
</body>
</html>
