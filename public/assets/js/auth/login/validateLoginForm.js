import { showErrorToast, hideToast } from "../../common/toast.js";

export function validateLoginForm() {
  const form = document.getElementById("login-form");
  const loginBtn = document.getElementById("login-btn");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const rememberMeCheckbox = document.getElementById("remember-me");

  if (!form || !loginBtn) return;

  loginBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    const formData = new URLSearchParams();
    formData.append("email", emailInput.value.trim());
    formData.append("password", passwordInput.value);
    if (rememberMeCheckbox.checked) {
      formData.append("remember_me", "1");
    }

    try {
      const res = await fetch("api?route=Auth/login-handler", {
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
        showErrorToast("Login Failed", "Invalid email or password.");
      }
    } catch (error) {
      console.error("Login error:", error);
      // Network error - show same error message
      showErrorToast("Login Failed", "Invalid email or password.");
    }
  });
}
