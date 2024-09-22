document.addEventListener('DOMContentLoaded', function() {
    const budgetForm = document.getElementById('budget-form');

    // Handle the edit button click
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = button.closest('tr');
            const category = row.querySelector('.category').textContent;
            const amount = row.querySelector('.amount').textContent;

            // Populate the form for editing
            document.getElementById('category').value = category;
            document.getElementById('amount').value = amount;
            document.getElementById('edit_id').value = button.getAttribute('data-id');
        });
    });

    // Handle the delete button click
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = button.getAttribute('data-id');

            if (confirm('Are you sure you want to delete this category?')) {
                // Redirect to delete the item
                window.location.href = `budget.php?delete=${id}`;
            }
        });
    });
});
