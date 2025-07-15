export function validateRegisterForm() {
  const form = document.getElementById("register-form");
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirm-password");
  const roleInput = document.getElementById("role-input");
  const emailInput = document.getElementById('email');

  const passwordErrorToast = document.getElementById("password-error-toast");
  const passwordFormatErrorToast = document.getElementById(
    "password-format-error-toast"
  );
  const roleErrorToast = document.getElementById("role-error-toast");
  const emailErrorToast = document.getElementById("email-error-toast");

  // Helper to hide all toasts
  const hideAllToasts = () => {
    passwordErrorToast.classList.add("hidden");
    passwordFormatErrorToast.classList.add("hidden");
    roleErrorToast.classList.add("hidden");
    emailErrorToast.classList.add("hidden");
  };

  // Helper to validate password format
  const isPasswordValid = (pwd) => {
    const regex =
      /^(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;
    return regex.test(pwd);
  };

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    let hasError = false;

    hideAllToasts(); // Hide all before checks

    // Check role
    if (!roleInput.value) {
      roleErrorToast.classList.remove("hidden");
      hasError = true;
    }

    // Check password format
    else if (!isPasswordValid(password.value)) {
      passwordFormatErrorToast.classList.remove("hidden");
      hasError = true;
    }

    // Check password match
    else if (password.value !== confirmPassword.value) {
      passwordErrorToast.classList.remove("hidden");
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
          emailErrorToast.classList.remove("hidden");
          hasError = true;
        }
      } catch (err) {
        console.error("Email verification failed:", err);
      }
    }

    // Hide toast after 5 seconds (if shown)
    setTimeout(hideAllToasts, 5000);

    if (!hasError) {
      form.submit();
    }
  });
}
