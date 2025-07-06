export function validateRegisterForm() {
  const form = document.getElementById("register-form");
  const password = document.querySelector(".password");
  const confirmPassword = document.getElementById("confirm-password");
  const roleInput = document.getElementById("role-input");
  const emailInput = document.querySelector('input[name="email"]');
  const passwordErrorToast = document.getElementById("password-error-toast");
  const roleErrorToast = document.getElementById("role-error-toast");
  const emailErrorToast = document.getElementById("email-error-toast");

  // Helper to hide all toasts
  const hideAllToasts = () => {
    passwordErrorToast.classList.add("hidden");
    roleErrorToast.classList.add("hidden");
    emailErrorToast.classList.add("hidden");
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

    // Check password
    else if (password.value !== confirmPassword.value) {
      passwordErrorToast.classList.remove("hidden");
      hasError = true;
    }
    
    // Check email
    else {
      try {
        const res = await fetch("/MediConnect/backend/check-email.php", {
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
