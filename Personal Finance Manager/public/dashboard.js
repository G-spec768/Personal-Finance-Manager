// Initialize the Spending Chart for the End of Month Overview
const ctx = document.getElementById('spendingChart').getContext('2d');
const spendingChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Rent', 'Groceries', 'Entertainment', 'Utilities', 'Savings'],
        datasets: [{
            label: 'Monthly Spending',
            data: [4500, 900, 400, 600, 1500],
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1']
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return '$' + tooltipItem.raw.toLocaleString();
                    }
                }
            }
        }
    }
});

// Budget Progress Function
function updateBudgetProgress(budgets) {
    budgets.forEach(budget => {
        const spentPercentage = (budget.spent / budget.amount) * 100;
        const progressBar = document.querySelector(`#budget-${budget.category}-progress`);
        progressBar.style.width = `${spentPercentage}%`;

        // Add warning colors based on spending thresholds
        if (spentPercentage >= 90) {
            progressBar.style.backgroundColor = '#dc3545'; // Danger (Red)
        } else if (spentPercentage >= 80) {
            progressBar.style.backgroundColor = '#ffc107'; // Warning (Yellow)
        } else {
            progressBar.style.backgroundColor = '#28a745'; // Safe (Green)
        }
    });
}

// Example budgets for demo purposes (replace with actual data)
const exampleBudgets = [
    { category: 'Rent', amount: 4500, spent: 4000 },
    { category: 'Groceries', amount: 900, spent: 850 },
    { category: 'Entertainment', amount: 400, spent: 350 },
    { category: 'Utilities', amount: 600, spent: 450 }
];

// Call the function with actual budget data
updateBudgetProgress(exampleBudgets);

// Function for adjusting the budget
function adjustBudget() {
    // Open a modal or redirect to a page to adjust the budget
    alert("Redirecting to budget adjustment page...");
    // Add your budget adjustment logic here
}

// Function for setting new goals
function setNewGoals() {
    // Open a modal or redirect to a page for setting goals
    alert("Set your new goals for the upcoming month.");
    // Add your set new goals logic here
}

// Dynamic Savings Goal Progress Bars
function updateSavingsGoalProgress(goals) {
    goals.forEach(goal => {
        const progressPercentage = (goal.saved_amount / goal.goal_amount) * 100;
        const progressBar = document.querySelector(`#goal-${goal.goal_name}-progress`);
        progressBar.style.width = `${progressPercentage}%`;

        // Set a custom color for the goal progress based on completion percentage
        if (progressPercentage >= 100) {
            progressBar.style.backgroundColor = '#28a745'; // Fully Complete (Green)
        } else {
            progressBar.style.backgroundColor = '#007bff'; // In Progress (Blue)
        }

        // Add tooltip or additional info
        progressBar.setAttribute('title', `${goal.saved_amount} of ${goal.goal_amount} saved.`);
    });
}

// Example goals for demo purposes (replace with actual data)
const exampleGoals = [
    { goal_name: 'Emergency Fund', goal_amount: 10000, saved_amount: 7000 },
    { goal_name: 'Vacation', goal_amount: 5000, saved_amount: 1200 }
];

// Call the function with actual goal data
updateSavingsGoalProgress(exampleGoals);
