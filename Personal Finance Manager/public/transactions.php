<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('../src/config.php');

// Handle form submission for adding transactions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_transaction'])) {
    $transaction_date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];

    // Validate inputs
    if (!empty($transaction_date) && !empty($description) && !empty($amount) && !empty($category) && $amount > 0) {
        // Insert the new transaction into the database
        $sql = "INSERT INTO transactions (user_id, transaction_date, description, amount, category) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issds", $_SESSION['user_id'], $transaction_date, $description, $amount, $category);
        if ($stmt->execute()) {
            $success_message = 'Transaction added successfully.';
        } else {
            $error_message = 'Failed to add transaction. Please try again.';
        }
    } else {
        $error_message = 'Invalid input. Please fill in all fields correctly.';
    }
}

// Fetch transactions for the logged-in user
$sql = "SELECT * FROM transactions WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);

// Set a default theme if not already set
$current_theme = isset($current_theme) ? $current_theme : 'light-theme';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="transactions_styles.css"> <!-- Updated stylesheet link -->
    <title>Transactions</title>
</head>
<body>
<?php include('../templates/user_header.php'); ?>
<div class="transactions-container">
    <h1>Your Transactions</h1>

    <!-- Form for adding a new transaction -->
    <form id="transaction-form" method="POST">
        <fieldset>
            <legend>Add New Transaction</legend>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
            
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" step="0.01" required>
            
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
            
            <input type="hidden" name="add_transaction" value="true">
            <input type="submit" value="Add Transaction">
        </fieldset>
    </form>

    <!-- Display transactions -->
    <table id="transactions-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?php echo htmlspecialchars($transaction['transaction_date']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['amount']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['category']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (isset($success_message)): ?>
        <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
    <?php endif; ?>
    
    <?php if (isset($error_message)): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
</div>

<?php include('../templates/footer.php'); ?>
</body>
</html>
