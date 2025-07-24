import { showErrorToast, hideToast } from "../../common/toast.js";
import { PasswordStrengthValidator } from "../../common/passwordStrength.js";

export function validateRegisterForm() {
  const form = document.getElementById("register-form");
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirm-password");
  const emailInput = document.getElementById("email");
  const agreeCheckbox = document.getElementById("agree-checkbox");

  // Password strength validator is initialized in index.js
  // We'll access it through the global scope
  const passwordValidator = window.passwordValidator;

  // Helper to validate password format using the strength validator
  const isPasswordValid = (pwd) => {
    return passwordValidator
      ? passwordValidator.isPasswordValid(pwd)
      : pwd.length >= 8 &&
          /\d/.test(pwd) &&
          /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(pwd);
  };

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    let hasError = false;

    hideToast(); // Hide any existing toast

    // Check password format
    if (!isPasswordValid(password.value)) {
      showErrorToast(
        "Invalid password format.",
        "Password must be at least 8 characters long with at least one number and one special character."
      );
      hasError = true;
    }

    // Check password confirmation
    else if (confirmPassword.value === "") {
      showErrorToast(
        "Please confirm your password.",
        "You must enter your password twice for verification."
      );
      hasError = true;
    }

    // Check password match
    else if (passwordValidator && !passwordValidator.doPasswordsMatch()) {
      showErrorToast(
        "Passwords do not match.",
        "Please make sure both password fields contain exactly the same password."
      );
      hasError = true;
    }

    // Check email existence
    else {
      try {
        const res = await fetch("/backend/auth/check-email.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `email=${encodeURIComponent(emailInput.value)}`,
        });
        const data = await res.json();
        if (data.exists) {
          showErrorToast(
            "Email already exists.",
            "Please use another email or login instead."
          );
          hasError = true;
        }
      } catch (err) {
        console.error("Email verification failed:", err);
      }
    }

    // Check terms agreement
    if (!hasError && !agreeCheckbox.checked) {
      showErrorToast(
        "Please accept the terms and conditions.",
        "You must agree to the terms of service to create an account."
      );
      hasError = true;
    }

    // If no errors, proceed with form submission
    if (!hasError) {
      // Show success feedback before submission
      hideToast();
      form.submit();
    }
  });
}
