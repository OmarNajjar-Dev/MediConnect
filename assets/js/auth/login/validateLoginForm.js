import { showErrorToast } from "../../common/toast.js";

export function validateLoginForm() {
  const form = document.getElementById("login-form");
  const loginBtn = document.getElementById("login-btn");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const rememberMeCheckbox = document.getElementById("remember-me");

  if (!form || !loginBtn) return;

  // Handle form submission
  form.addEventListener("submit", async (e) => {
    e.preventDefault(); // Prevent default form submission

    console.log("Form submitted, preventing default...");

    // Disable button to prevent double submission
    loginBtn.disabled = true;
    loginBtn.innerHTML =
      '<i data-lucide="loader-2" class="h-4 w-4 animate-spin"></i> Signing in...';

    const formData = new URLSearchParams();
    formData.append("email", emailInput.value.trim());
    formData.append("password", passwordInput.value);
    if (rememberMeCheckbox.checked) {
      formData.append("remember_me", "1");
    }

    try {
      console.log("Sending login request...");

      const res = await fetch("/mediconnect/backend/auth/login-handler.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData.toString(),
      });

      console.log("Login response status:", res.status);

      if (!res.ok) {
        throw new Error(`HTTP error! status: ${res.status}`);
      }

      const data = await res.json();
      console.log("Login response data:", data);

      if (data.success === true) {
        console.log("Login successful, redirecting to:", data.redirect);
        // Successful login - redirect to appropriate dashboard
        window.location.href = data.redirect;
      } else {
        // Failed login - show error toast
        console.log("Login failed:", data.message);
        showErrorToast(
          "Login Failed",
          data.message || "Invalid email or password."
        );
      }
    } catch (error) {
      console.error("Login error:", error);
      // Network error - show same error message
      showErrorToast("Login Failed", "Network error. Please try again.");
    } finally {
      // Re-enable button
      loginBtn.disabled = false;
      loginBtn.innerHTML =
        '<i data-lucide="log-in" class="h-4 w-4"></i> Sign in';
    }
  });

  // Also handle button click as backup
  loginBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent any default button behavior
    console.log("Button clicked, triggering form submission...");
    form.dispatchEvent(
      new Event("submit", { bubbles: true, cancelable: true })
    );
  });
}
