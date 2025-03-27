document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('password');

    form.addEventListener('submit', function (event) {
        if (passwordInput.value.length !== 6) {
            alert('Password must be exactly 6 characters long.');
            event.preventDefault(); // Prevent form submission
        }
    });
});
