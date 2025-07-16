import { setupPasswordToggle } from "../utils/setupPasswordToggle.js";
import { showErrorToast } from "../../common/toast.js";

import { initRoleDropdown } from "./initRoleDropdown.js";
import { autoFillLocation } from "./autoFillLocation.js";
import { handleCheckboxToggle } from "./handleCheckboxToggle.js";
import { validateRegisterForm } from "./validateRegisterForm.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  initRoleDropdown();
  autoFillLocation();
  handleCheckboxToggle();
  validateRegisterForm();

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
        title: "Invalid Role",
        message: "Please select a valid role from the dropdown.",
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
