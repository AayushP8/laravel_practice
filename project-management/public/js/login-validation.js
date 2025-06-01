document.addEventListener("DOMContentLoaded", function () {
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const loginBtn = document.getElementById("login");

    // const usernameValid = false;
    // const passwordValid = false;

    function validateField(field, errorId, message, showError) {
        const errorDiv = document.getElementById(errorId);
        if (!field.value.trim()) {
            if (showError) {
                errorDiv.textContent = message;
                return false;
            }
        } else {
            errorDiv.textContent = "";
            return true;
        }
    }

    function checkFormValidation(showErrorsFor = {}) {
        const usernameValid = validateField(
            username,
            "error-username",
            "Username required",
            showErrorsFor.username || false
        );
        const passwordValid = validateField(
            password,
            "error-password",
            "Password required",
            showErrorsFor.password || false
        );
        loginBtn.disabled = !(usernameValid && passwordValid);
    }

    username.addEventListener("blur", function () {
        // validateField(username, "error-username", "Username Required");
        checkFormValidation({ username: true });
    });
    password.addEventListener("blur", function () {
        // validateField(password, "error-password", "Password Required");
        checkFormValidation({ password: true });
    });

    username.addEventListener("input", checkFormValidation);
    password.addEventListener("input", checkFormValidation);
});
