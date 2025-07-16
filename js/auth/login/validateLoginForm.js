export function validateLoginForm() {
  const form = document.getElementById("login-form");
  const loginBtn = document.getElementById("login-btn");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const rememberMeCheckbox = document.getElementById("remember-me");
  const errorToast = document.getElementById("login-error-toast");

  if (!form || !loginBtn) return;

  // Store timeout ID for cleanup (setTimeout returns a unique numeric identifier)
  let toastTimeoutId = null;

  loginBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    const formData = new URLSearchParams();
    formData.append("email", emailInput.value.trim());
    formData.append("password", passwordInput.value);
    if (rememberMeCheckbox.checked) {
      formData.append("remember_me", "1");
    }

    try {
      const res = await fetch("/MediConnect/backend/auth/login-handler.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData.toString(),
      });

      const data = await res.json();

      if (data.success && data.redirect) {
        // Successful login - redirect to appropriate dashboard
        window.location.href = data.redirect;
      } else {
        // Failed login - show error toast
        showErrorToast();
      }
    } catch (error) {
      console.error("Login error:", error);
      // Network error - show same error message
      showErrorToast();
    }
  });

  function showErrorToast() {
    // Clear existing timeout to prevent multiple timeouts
    if (toastTimeoutId) {
      clearTimeout(toastTimeoutId);
    }

    // Show toast (message is already set in HTML)
    errorToast.classList.remove("hidden");

    // Set timeout to hide toast (returns a unique numeric ID)
    toastTimeoutId = setTimeout(() => {
      errorToast.classList.add("hidden");
    }, 5000);
  }
}
