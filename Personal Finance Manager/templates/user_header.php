<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/user_header.css"> 
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="budget.php">Manage Budget</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="savings_goals.php">Savings Goals</a></li>
                <li><a href="budget_overview.php">Budget Overview</a></li>
                <!-- <li><a href="profile.php">Profile</a></li> -->
                <li><a href="all_settings.php">Settings</a></li>
                <!-- <li><a href="notifications.php">Notifications</a></li>
                <li><a href="reminders.php">Reminders</a></li> -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
                
            <label for="theme-switcher">Choose a theme:</label>
            <select id="theme-switcher">
                <option value="light-theme" <?php echo $current_theme === 'light-theme' ? 'selected' : ''; ?>>Light</option>
                <option value="dark-theme" <?php echo $current_theme === 'dark-theme' ? 'selected' : ''; ?>>Dark</option>
                <option value="solarized-theme" <?php echo $current_theme === 'solarized-theme' ? 'selected' : ''; ?>>Solarized</option>
            </select>
        </nav>
    </header>
   <main>