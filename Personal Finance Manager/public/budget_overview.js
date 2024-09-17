document.addEventListener('DOMContentLoaded', function() {
    const openCreateModalButton = document.getElementById('open-create-modal');
    const createBudgetModal = document.getElementById('create-budget-modal');
    const closeCreateModalButton = document.getElementById('close-create-modal');
    
    const editBudgetModal = document.getElementById('edit-budget-modal');
    const closeEditModalButton = document.getElementById('close-edit-modal');
    
    const deleteBudgetModal = document.getElementById('delete-budget-modal');
    const closeDeleteModalButton = document.getElementById('close-delete-modal');
    
    const confirmDeleteButton = document.getElementById('confirm-delete');
    const cancelDeleteButton = document.getElementById('cancel-delete');
    
    // Open Create Budget Modal
    openCreateModalButton.addEventListener('click', function() {
        createBudgetModal.style.display = 'block';
    });

    // Close Create Budget Modal
    closeCreateModalButton.addEventListener('click', function() {
        createBudgetModal.style.display = 'none';
    });

    // Open Edit Budget Modal
    window.openEditModal = function(id, category, limit) {
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-category').value = category;
        document.getElementById('edit-limit').value = limit;
        editBudgetModal.style.display = 'block';
    }

    // Close Edit Budget Modal
    closeEditModalButton.addEventListener('click', function() {
        editBudgetModal.style.display = 'none';
    });

    // Open Delete Budget Modal
    window.openDeleteModal = function(id) {
        document.getElementById('delete-id').value = id;
        deleteBudgetModal.style.display = 'block';
    }

    // Close Delete Budget Modal
    closeDeleteModalButton.addEventListener('click', function() {
        deleteBudgetModal.style.display = 'none';
    });

    // Confirm Delete
    confirmDeleteButton.addEventListener('click', function() {
        const form = document.getElementById('delete-budget-form');
        form.submit(); // Submit the delete form
    });

    // Cancel Delete
    cancelDeleteButton.addEventListener('click', function() {
        deleteBudgetModal.style.display = 'none';
    });

    // Handle Form Submissions
    document.getElementById('create-budget-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('/api/create-budget', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(() => {
            updateBudgetTable(); // Update table and chart after adding a new budget
            createBudgetModal.style.display = 'none'; // Close the modal
        })
        .catch(error => console.error('Error creating budget:', error));
    });

    document.getElementById('edit-budget-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('/api/edit-budget', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(() => {
            updateBudgetTable(); // Update table and chart after editing a budget
            editBudgetModal.style.display = 'none'; // Close the modal
        })
        .catch(error => console.error('Error editing budget:', error));
    });

    // Fetch and display budget data
    function updateBudgetTable() {
        // Directly use budgetData injected from PHP
        populateTable(budgetData);
        populateChart(budgetData);
    }

    // Populate Budget Table
    function populateTable(data) {
        const tableBody = document.querySelector('#budget-table tbody');
        tableBody.innerHTML = ''; // Clear existing rows
        data.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.category}</td>
                <td>${item.limit}</td>
                <td>${item.spent}</td>
                <td>
                    <button onclick="openEditModal(${item.id}, '${item.category}', ${item.limit})">Edit</button>
                    <button onclick="openDeleteModal(${item.id})">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Populate Budget Chart
    function populateChart(data) {
        const ctx = document.getElementById('budget-chart').getContext('2d');
        const categories = data.map(item => item.category);
        const limits = data.map(item => item.limit);
        const spent = data.map(item => item.spent);
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [
                    {
                        label: 'Budget Limit',
                        data: limits,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Spent',
                        data: spent,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Initial call to populate the table and chart
    updateBudgetTable();
});
