import { initDropdown } from "../../common/initDropdown.js";

export function setupEnhancedRegistration() {
  setupRoleBasedFields();
  setupGeolocationDetection();
}

function setupRoleBasedFields() {
  console.log("Setting up role-based fields...");
  const roleButton = document.getElementById("role-button");
  const roleInput = document.getElementById("role");
  const roleSpecificFields = document.getElementById("role-specific-fields");
  const hospitalSelection = document.getElementById("hospital-selection");
  const specialtySelection = document.getElementById("specialty-selection");
  const teamNameField = document.getElementById("team-name-field");
  const hospitalButton = document.getElementById("hospital-button");
  const hospitalInput = document.getElementById("hospital_id");
  const specialtyButton = document.getElementById("specialty-button");
  const specialtyInput = document.getElementById("specialty_id");

  console.log("Elements found:", {
    roleButton: !!roleButton,
    roleInput: !!roleInput,
    roleSpecificFields: !!roleSpecificFields,
    hospitalSelection: !!hospitalSelection,
    specialtySelection: !!specialtySelection,
    teamNameField: !!teamNameField,
    hospitalButton: !!hospitalButton,
    hospitalInput: !!hospitalInput,
    specialtyButton: !!specialtyButton,
    specialtyInput: !!specialtyInput,
  });

  if (!roleButton || !roleInput || !roleSpecificFields) {
    console.error("Required elements not found");
    return;
  }

  // No need to load hospitals and specialties for patient-only registration
  console.log("Patient-only registration - no additional data needed");

  // Listen for role changes on the dropdown options
  const roleOptions = document.querySelectorAll('[data-dropdown="option"]');
  roleOptions.forEach((option) => {
    option.addEventListener("click", (e) => {
      const selectedRole = option.getAttribute("data-value");
      console.log("Role changed to:", selectedRole);

      // Update the hidden input value
      roleInput.value = selectedRole;

      // Update the button text
      const roleButtonText = roleButton.querySelector("span");
      roleButtonText.textContent = option.querySelector("span").textContent;

      handleRoleChange(selectedRole);
    });
  });

  function handleRoleChange(selectedRole) {
    // For patient-only registration, no role-specific fields are needed
    // All fields are hidden by default
    roleSpecificFields.classList.add("hidden");
    hospitalSelection.classList.add("hidden");
    specialtySelection.classList.add("hidden");
    teamNameField.classList.add("hidden");

    // Clear any required attributes
    hospitalInput.removeAttribute("required");
    specialtyInput.removeAttribute("required");
  }
}

function setupGeolocationDetection() {
  const detectLocationBtn = document.getElementById("detect-location");
  const locationButtonText = document.getElementById("location-button-text");
  const locationLoading = document.getElementById("location-loading");
  const cityInput = document.getElementById("city");
  const addressInput = document.getElementById("address");

  if (!detectLocationBtn || !cityInput || !addressInput) return;

  detectLocationBtn.addEventListener("click", async () => {
    if (!navigator.geolocation) {
      showLocationStatus(
        "Geolocation is not supported by this browser.",
        "error"
      );
      return;
    }

    // Show loading state
    locationButtonText.textContent = "Detecting...";
    locationLoading.classList.remove("hidden");
    detectLocationBtn.disabled = true;

    navigator.geolocation.getCurrentPosition(
      async (position) => {
        try {
          const { latitude, longitude } = position.coords;
          const locationData = await reverseGeocode(latitude, longitude);

          if (locationData) {
            cityInput.value = locationData.city || "";
            addressInput.value = locationData.address || "";
            showLocationStatus("Location detected successfully!", "success");
          } else {
            showLocationStatus(
              "Could not determine your address. Please enter manually.",
              "error"
            );
          }
        } catch (error) {
          console.error("Geocoding error:", error);
          showLocationStatus(
            "Failed to get location details. Please enter manually.",
            "error"
          );
        } finally {
          resetLocationButton();
        }
      },
      (error) => {
        console.error("Geolocation error:", error);
        let errorMessage =
          "Location access denied. Please enter your address manually.";

        switch (error.code) {
          case error.PERMISSION_DENIED:
            errorMessage =
              "Location access denied. Please enter your address manually.";
            break;
          case error.POSITION_UNAVAILABLE:
            errorMessage =
              "Location information unavailable. Please enter your address manually.";
            break;
          case error.TIMEOUT:
            errorMessage =
              "Location request timed out. Please enter your address manually.";
            break;
        }

        showLocationStatus(errorMessage, "error");
        resetLocationButton();
      },
      {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 300000, // 5 minutes
      }
    );
  });

  function resetLocationButton() {
    locationButtonText.textContent = "Detect My Location";
    locationLoading.classList.add("hidden");
    detectLocationBtn.disabled = false;
  }

  async function reverseGeocode(latitude, longitude) {
    try {
      // Use the existing get-location.php API
      const response = await fetch(
        `/mediconnect/backend/api/utils/get-location.php?lat=${latitude}&lon=${longitude}`,
        {
          method: "GET",
          headers: {
            Accept: "application/json",
          },
        }
      );

      const data = await response.json();

      if (data.success) {
        return {
          city: data.city || "Unknown",
          address: data.clean_address || `${latitude}, ${longitude}`,
        };
      }

      return null;
    } catch (error) {
      console.error("Reverse geocoding error:", error);
      return null;
    }
  }

  function showLocationStatus(message, type) {
    const statusDiv = document.getElementById("location-status");
    const statusText = document.getElementById("location-status-text");

    if (!statusDiv || !statusText) return;

    statusText.textContent = message;
    statusDiv.classList.remove(
      "hidden",
      "bg-green-100",
      "text-green-800",
      "bg-red-100",
      "text-red-800"
    );

    if (type === "success") {
      statusDiv.classList.add("bg-green-100", "text-green-800");
    } else if (type === "error") {
      statusDiv.classList.add("bg-red-100", "text-red-800");
    }

    statusDiv.classList.remove("hidden");

    // Auto-hide after 5 seconds
    setTimeout(() => {
      statusDiv.classList.add("hidden");
    }, 5000);
  }

  function showToast(title, message, type) {
    // Use the existing toast system
    if (typeof window.showToast === "function") {
      window.showToast(title, message, type);
    } else {
      // Fallback alert
      alert(`${title}: ${message}`);
    }
  }
}
