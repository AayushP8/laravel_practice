document.addEventListener("DOMContentLoaded", function () {
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const loginBtn = document.getElementById("login");

    function validateField(field, errorId, message) {
        const errorDiv = document.getElementById(errorId);
        if (!field.value.trim()) {
            errorDiv.textContent = message;
            return false;
        } else {
            errorDiv.textContent = "";
            return true;
        }
    }

    username.addEventListener("blur", function () {
        validateField(username, "error-username", "Username Required");
    });
    password.addEventListener("blur", function () {
        validateField(password, "error-password", "Password Required");
    });
});
