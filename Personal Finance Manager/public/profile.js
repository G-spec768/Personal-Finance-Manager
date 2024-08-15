document.getElementById('profile-form').addEventListener('submit', function(event) {
    // You can add additional client-side validation here if needed
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;

    if (!username || !email) {
        alert('Please fill in all fields.');
        event.preventDefault(); // Prevent form submission if validation fails
    }
});
