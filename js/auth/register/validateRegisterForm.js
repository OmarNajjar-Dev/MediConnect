import { showErrorToast, hideToast } from "../../common/toast.js";

export function validateRegisterForm() {
  const form = document.getElementById("register-form");
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirm-password");
  const roleInput = document.getElementById("role-input");
  const emailInput = document.getElementById("email");
  const agreeCheckbox = document.getElementById("agree-checkbox");

  // Helper to validate password format
  const isPasswordValid = (pwd) => {
    const regex =
      /^(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;
    return regex.test(pwd);
  };

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    let hasError = false;

    hideToast(); // Hide any existing toast

    // Check role
    if (!roleInput.value) {
      showErrorToast(
        "Please select your role.",
        "You must choose your position in the healthcare system."
      );
      hasError = true;
    }

    // Check password format
    else if (!isPasswordValid(password.value)) {
      showErrorToast(
        "Invalid password format.",
        "Password must be at least 8 characters long with at least one number and one special character."
      );
      hasError = true;
    }

    // Check password match
    else if (password.value !== confirmPassword.value) {
      showErrorToast(
        "Passwords do not match.",
        "Please make sure your passwords match."
      );
      hasError = true;
    }

    // Check email existence
    else {
      try {
        const res = await fetch("/MediConnect/backend/auth/check-email.php", {
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

    if (!hasError && agreeCheckbox.checked) {
      form.submit();
    }
  });
}
