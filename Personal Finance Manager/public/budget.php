<!-- public/budget.php -->
<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('src\config.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $user_id = $_SESSION['user_id'];

    // Insert the budget details into the database
    $sql = "INSERT INTO budget (user_id, category, amount) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isd", $user_id, $category, $amount);
    $stmt->execute();
}

// Fetch the budget details from the database
$sql = "SELECT category, amount FROM budget WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$budget_items = $result->fetch_all(MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="budget_styles.css">
    <title>Budget</title>
</head>
<body>
<?php include('../templates/header.php'); ?>

<div class="budget-container">
    <h1>Your Budget</h1>
    <form id="budget-form" method="POST">
        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="Income">Income</option>
            <option value="Expenses">Expenses</option>
            <option value="Savings and Investments">Savings and Investments</option>
            <option value="Debt Repayment">Debt Repayment</option>
            <option value="Financial Goals">Financial Goals</option>
        </select>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" placeholder="Enter amount" required>

        <input type="submit" value="Add">
    </form>

    <table id="budget-table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($budget_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                    <td><?php echo htmlspecialchars($item['amount']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../templates/footer.php'); ?>

<!-- <script src="../js/budget.js"></script> -->
<script src="budget.js"></script>



</body>
</html>