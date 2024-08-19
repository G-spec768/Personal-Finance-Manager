document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validate Username
        if (!isValidUsername(usernameInput.value)) {
            alert('Username already exists or is invalid.');
            isValid = false;
        }
        
        // Validate Password
        if (!isValidPassword(passwordInput.value)) {
            alert('Password must be at least 6 characters long and include uppercase, lowercase, one number, and one special character.');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // Function to check if username is valid
    function isValidUsername(username) {
        // Simulate an AJAX call to check username existence
        let isValid = false;
        
        if (username) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../src/check_username.php', false); // synchronous request
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('username=' + encodeURIComponent(username));
            
            if (xhr.status === 200) {
                isValid = xhr.responseText.trim() === 'available';
            }
        }
        
        return isValid;
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

document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.querySelector('form');
    const submitButton = registerForm.querySelector('input[type="submit"]');
    const termsCheckbox = document.createElement('input');
    const termsLabel = document.createElement('label');

    // Create the Terms and Conditions checkbox
    termsCheckbox.type = 'checkbox';
    termsCheckbox.id = 'terms';
    termsCheckbox.style.marginRight = '5px';

    // Create the label for the checkbox
    termsLabel.setAttribute('for', 'terms');
    termsLabel.textContent = 'I agree to the Terms and Conditions';

    // Insert the checkbox and label before the submit button
    submitButton.insertAdjacentElement('beforebegin', termsCheckbox);
    submitButton.insertAdjacentElement('beforebegin', termsLabel);
    submitButton.insertAdjacentElement('beforebegin', document.createElement('br'));
    submitButton.insertAdjacentElement('beforebegin', document.createElement('br'));

    // Initially disable the submit button
    submitButton.disabled = true;

    // Enable/disable the submit button based on the checkbox state
    termsCheckbox.addEventListener('change', function () {
        submitButton.disabled = !termsCheckbox.checked;
    });
});
