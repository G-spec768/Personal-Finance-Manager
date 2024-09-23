// Initialize the Spending Chart for the End of Month Overview
const ctx = document.getElementById('spendingChart').getContext('2d');
const spendingChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Rent', 'Groceries', 'Entertainment', 'Utilities', 'Savings'],
        datasets: [{
            label: 'Monthly Spending',
            data: [4500, 900, 400, 600, 1500], // Example data; replace with actual data as needed
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
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

// Dynamic Savings Goal Progress Bars
function updateSavingsGoalProgress(goals) {
    goals.forEach(goal => {
        const progressPercentage = (goal.saved_amount / goal.goal_amount) * 100;
        const progressBar = document.getElementById(`goal-${goal.goal_name}-progress`);
        progressBar.style.width = `${progressPercentage}%`;
        progressBar.textContent = `${Math.round(progressPercentage)}% Complete`;

        // Set a custom color for the goal progress
        if (progressPercentage >= 100) {
            progressBar.style.backgroundColor = '#28a745'; // Green when complete
        } else if (progressPercentage >= 75) {
            progressBar.style.backgroundColor = '#ffc107'; // Yellow when nearing completion
        } else {
            progressBar.style.backgroundColor = '#007bff'; // Blue for in-progress
        }
    });
}

// On Document Ready
document.addEventListener('DOMContentLoaded', function() {
    // Assume budgets and goals are available from the PHP context
    updateSavingsGoalProgress(goals);
});
