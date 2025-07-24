import { setupPasswordToggle } from "../utils/setupPasswordToggle.js";
import { showErrorToast } from "../../common/toast.js";

import { handleCheckboxToggle } from "./handleCheckboxToggle.js";
import { validateRegisterForm } from "./validateRegisterForm.js";
import { setupEnhancedRegistration } from "./enhancedRegistration.js";
import { PasswordStrengthValidator } from "../../common/passwordStrength.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  handleCheckboxToggle();
  validateRegisterForm();
  setupEnhancedRegistration();

  // Initialize password strength validator with simplified structure
  window.passwordValidator = new PasswordStrengthValidator(
    "password", // password input ID
    null, // no strength bar (simplified)
    "password-strength", // strength text ID
    "confirm-password", // confirm password input ID
    "password-match-indicator" // password match indicator ID
  );

  // Handle PHP error redirects
  handlePhpErrors();
});

function handlePhpErrors() {
  const urlParams = new URLSearchParams(window.location.search);
  const error = urlParams.get("error");

  if (error) {
    const errorMessages = {
      invalid_email: {
        title: "Invalid Email Format",
        message: "Please enter a valid email address.",
      },
      email_exists: {
        title: "Email Already Exists",
        message:
          "This email is already registered. Please use another email or login instead.",
      },
      invalid_role: {
        title: "Registration Error",
        message: "There was an issue with your registration. Please try again.",
      },
      insert_failed: {
        title: "Registration Failed",
        message: "Failed to create your account. Please try again.",
      },
      link_failed: {
        title: "Registration Failed",
        message: "Failed to assign your role. Please try again.",
      },
    };

    const errorData = errorMessages[error];
    if (errorData) {
      showErrorToast(errorData.title, errorData.message);
    }

    // Clean up the URL
    const newUrl = window.location.pathname;
    window.history.replaceState({}, document.title, newUrl);
  }
}
