document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const usernameError = document.getElementById('username-error');
    const passwordError = document.getElementById('password-error');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission initially
        let isValid = true;

        // Clear previous error messages
        usernameError.textContent = '';
        passwordError.textContent = '';

        // Validate Username
        isValidUsername(usernameInput.value).then(valid => {
            if (!valid) {
                usernameError.textContent = 'Username already exists or is invalid.';
                isValid = false;
            }

            // Validate Password
            if (!isValidPassword(passwordInput.value)) {
                passwordError.textContent = 'Password must be at least 6 characters long and include uppercase, lowercase, one number, and one special character.';
                isValid = false;
            }

            if (isValid) {
                form.submit(); // Only submit if all validations passed
            }
        }).catch(error => {
            console.error(error);
            alert('An error occurred while validating the username.');
        });
    });

    // Function to check if username is valid
    function isValidUsername(username) {
        return new Promise((resolve, reject) => {
            if (!username) {
                resolve(false);
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../src/check_username.php', true); // asynchronous request
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    resolve(xhr.responseText.trim() === 'available');
                } else {
                    reject('Error checking username');
                }
            };
            xhr.onerror = function() {
                reject('Error checking username');
            };
            xhr.send('username=' + encodeURIComponent(username));
        });
    }

    // Function to validate password strength
    function isValidPassword(password) {
        const minLength = 6;
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumber = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        return password.length >= minLength && hasUpperCase && hasLowerCase && hasNumber && hasSpecialChar;
    }
});
