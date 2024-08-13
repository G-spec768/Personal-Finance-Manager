// public/js/budget.js

document.getElementById('budget-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const income = parseFloat(document.querySelector('input[name="income"]').value) || 0;
    const expenses = parseFloat(document.querySelector('input[name="expenses"]').value) || 0;
    const savings = parseFloat(document.querySelector('input[name="savings"]').value) || 0;
    const debt = parseFloat(document.querySelector('input[name="debt"]').value) || 0;
    const goals = parseFloat(document.querySelector('input[name="goals"]').value) || 0;

    const remaining = income - (expenses + savings + debt + goals);
    
    document.getElementById('remaining-amount').textContent = `Remaining Amount: ${remaining.toFixed(2)}`;
});
