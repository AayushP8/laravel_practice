document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("projectForm");
    const submitBtn =
        document.getElementById("submit-project") ||
        document.getElementById("update-project");

    // Validation functions
    function validateProjectName() {
        const field = document.getElementById("projectname");
        const errorDiv = document.getElementById("err-projectname");
        const value = field.value.trim();

        if (!value) {
            errorDiv.textContent = "Project name is required";
            return false;
        }
        if (value.length < 3 || value.length > 50) {
            errorDiv.textContent = "Project name must be 3-50 characters";
            return false;
        }
        if (value.toLowerCase().includes("demo")) {
            errorDiv.textContent = "Project name cannot contain 'demo'";
            return false;
        }

        errorDiv.textContent = "";
        return true;
    }

    function validateStartDate() {
        const field = document.getElementById("startdate");
        const errorDiv = document.getElementById("err-startdate");
        const value = field.value;

        if (!value) {
            errorDiv.textContent = "Start date is required";
            return false;
        }

        const inputDate = new Date(value);
        const currentDate = new Date("2025-05-15");

        if (inputDate < currentDate) {
            errorDiv.textContent = "Start date must be today or later";
            return false;
        }

        errorDiv.textContent = "";
        return true;
    }

    function validateProjectType() {
        const internal = document.getElementById("internal");
        const external = document.getElementById("external");
        const errorDiv = document.getElementById("err-projecttype");

        if (!internal.checked && !external.checked) {
            errorDiv.textContent = "Project type is required";
            return false;
        }

        errorDiv.textContent = "";
        return true;
    }

    function validateBudget() {
        const field = document.getElementById("budget");
        const errorDiv = document.getElementById("err-budget");
        const value = parseInt(field.value);

        if (!field.value) {
            errorDiv.textContent = "Budget is required";
            return false;
        }

        if (isNaN(value) || value < 20000 || value > 500000) {
            errorDiv.textContent =
                "Budget must be an integer between ₹20,000 and ₹500,000";
            return false;
        }

        errorDiv.textContent = "";
        return true;
    }

    function validateManager() {
        const field = document.getElementById("manager");
        const errorDiv = document.getElementById("err-manager");
        const value = field.value.trim();

        if (!value) {
            errorDiv.textContent = "Project manager is required";
            return false;
        }

        if (value.length < 2 || value.length > 50) {
            errorDiv.textContent = "Manager name must be 2-50 characters";
            return false;
        }

        if (!/^[a-zA-Z\s]+$/.test(value)) {
            errorDiv.textContent =
                "Manager name can only contain letters and spaces";
            return false;
        }

        errorDiv.textContent = "";
        return true;
    }

    function validateLogo() {
        const field = document.getElementById("projectlogo");
        const errorDiv = document.getElementById("err-projectlogo");

        if (field.files.length > 0) {
            const file = field.files[0];
            const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!allowedTypes.includes(file.type)) {
                errorDiv.textContent =
                    "Only image files allowed (.jpg, .jpeg, .png)";
                return false;
            }

            if (file.size > maxSize) {
                errorDiv.textContent = "File size must not exceed 2MB";
                return false;
            }
        }

        errorDiv.textContent = "";
        return true;
    }

    function validateForm() {
        const isValid =
            validateProjectName() &&
            validateStartDate() &&
            validateProjectType() &&
            validateBudget() &&
            validateManager() &&
            validateLogo();

        submitBtn.disabled = !isValid;
        return isValid;
    }

    // Event listeners
    document
        .getElementById("projectname")
        .addEventListener("blur", validateForm);
    document.getElementById("startdate").addEventListener("blur", validateForm);
    document
        .getElementById("internal")
        .addEventListener("change", validateForm);
    document
        .getElementById("external")
        .addEventListener("change", validateForm);
    document.getElementById("budget").addEventListener("blur", validateForm);
    document.getElementById("manager").addEventListener("blur", validateForm);
    document
        .getElementById("projectlogo")
        .addEventListener("change", validateForm);

    // Initial validation
    validateForm();
});
    