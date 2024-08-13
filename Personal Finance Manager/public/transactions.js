// public/js/transactions.js

document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('transaction_date');
    
    // Ensure that the date input field only allows dates within the current month
    const today = new Date();
    const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

    dateInput.setAttribute('min', firstDay.toISOString().split('T')[0]);
    dateInput.setAttribute('max', lastDay.toISOString().split('T')[0]);
});
