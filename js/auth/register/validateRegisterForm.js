export function validateRegisterForm() {
  const form = document.getElementById("register-form");
  const password = document.querySelector(".password");
  const confirmPassword = document.getElementById("confirm-password");
  const roleInput = document.getElementById("role-input");
  const emailInput = document.querySelector('input[name="email"]');
  const passwordErrorToast = document.getElementById("password-error-toast");
  const roleErrorToast = document.getElementById("role-error-toast");
  const emailErrorToast = document.getElementById("email-error-toast");

  form.addEventListener("submit", async (e) => {
    e.preventDefault(); // Always prevent default submission first
    let hasError = false;

    // Check role selection
    if (!roleInput.value) {
      roleErrorToast.classList.remove("hidden");
      hasError = true;
      setTimeout(() => roleErrorToast.classList.add("hidden"), 5000);
    }

    // Check password match
    if (password.value !== confirmPassword.value) {
      passwordErrorToast.classList.remove("hidden");
      hasError = true;
      setTimeout(() => passwordErrorToast.classList.add("hidden"), 5000);
    } else {
      passwordErrorToast.classList.add("hidden");
    }

    // Check if email is already taken
    let emailTaken = false;
    try {
      const res = await fetch("/MediConnect/backend/check-email.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `email=${encodeURIComponent(emailInput.value)}`,
      });
      const data = await res.json();
      if (data.exists) {
        emailErrorToast.classList.remove("hidden");
        emailTaken = true;
        hasError = true;
        setTimeout(() => emailErrorToast.classList.add("hidden"), 5000);
      } else {
        emailErrorToast.classList.add("hidden");
      }
    } catch (err) {
      console.error("Email verification failed:", err);
    }

    // Submit only if there are no errors
    if (!hasError && !emailTaken) {
      form.submit();
    }
  });
}
