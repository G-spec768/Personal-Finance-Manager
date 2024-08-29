// Example of initializing the chart for the End of Month Overview
const ctx = document.getElementById('spendingChart').getContext('2d');
const spendingChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Rent', 'Groceries', 'Entertainment', 'Utilities', 'Savings'],
        datasets: [{
            label: 'Monthly Spending',
            data: [1200, 800, 400, 600, 500],
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1']
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

function adjustBudget() {
    alert("Redirecting to budget adjustment page...");
    // Implementation of budget adjustment functionality
}

function setNewGoals() {
    alert("Set your new goals for the upcoming month.");
    // Implementation for setting new goals
}
