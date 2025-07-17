import { setupPasswordToggle } from "../utils/setupPasswordToggle.js";
import { showErrorToast } from "../../common/toast.js";

import { handleCheckboxToggle } from "./handleCheckboxToggle.js";
import { validateRegisterForm } from "./validateRegisterForm.js";
import { setupEnhancedRegistration } from "./enhancedRegistration.js";
import { PasswordStrengthValidator } from "../../common/passwordStrength.js";

window.addEventListener("DOMContentLoaded", () => {
  setupPasswordToggle();
  initRoleHandler();
  handleCheckboxToggle();
  validateRegisterForm();
  setupEnhancedRegistration();

  // Initialize password strength validator
  new PasswordStrengthValidator();

  // Handle PHP error redirects
  handlePhpErrors();
});

function initRoleHandler() {
  const roleSelect = document.getElementById("role");
  if (!roleSelect) return;

  roleSelect.addEventListener("change", (e) => {
    const selectedRole = e.target.value;
    handleRoleChange(selectedRole);
  });
}

function handleRoleChange(role) {
  const roleSpecificFields = document.getElementById("role-specific-fields");
  const hospitalSelection = document.getElementById("hospital-selection");
  const specialtySelection = document.getElementById("specialty-selection");
  const teamNameField = document.getElementById("team-name-field");

  // Hide all role-specific fields first
  roleSpecificFields.classList.add("hidden");
  hospitalSelection.classList.add("hidden");
  specialtySelection.classList.add("hidden");
  teamNameField.classList.add("hidden");

  // Show relevant fields based on selected role
  if (role === "doctor") {
    roleSpecificFields.classList.remove("hidden");
    hospitalSelection.classList.remove("hidden");
    specialtySelection.classList.remove("hidden");
  } else if (role === "ambulance-team") {
    roleSpecificFields.classList.remove("hidden");
    hospitalSelection.classList.remove("hidden");
    teamNameField.classList.remove("hidden");
  } else if (role === "staff") {
    roleSpecificFields.classList.remove("hidden");
    hospitalSelection.classList.remove("hidden");
  }
}

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
