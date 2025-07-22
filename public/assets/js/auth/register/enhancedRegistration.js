export function setupEnhancedRegistration() {
  setupRoleBasedFields();
  setupGeolocationDetection();
}

function setupRoleBasedFields() {
  const roleInput = document.getElementById("role-input");
  const roleSpecificFields = document.getElementById("role-specific-fields");
  const hospitalSelection = document.getElementById("hospital-selection");
  const specialtySelection = document.getElementById("specialty-selection");
  const teamNameField = document.getElementById("team-name-field");
  const hospitalSelect = document.getElementById("hospital_id");
  const specialtySelect = document.getElementById("specialty_id");

  if (!roleInput || !roleSpecificFields) return;

  // Load hospitals and specialties when page loads
  loadHospitals();
  loadSpecialties();

  // Listen for role changes
  const roleOptions = document.querySelectorAll("#role-options .option-btn");
  roleOptions.forEach((option) => {
    option.addEventListener("click", () => {
      const selectedRole = option.getAttribute("data-value");
      handleRoleChange(selectedRole);
    });
  });

  function handleRoleChange(selectedRole) {
    // Hide all role-specific fields first
    roleSpecificFields.classList.add("hidden");
    hospitalSelection.classList.add("hidden");
    specialtySelection.classList.add("hidden");
    teamNameField.classList.add("hidden");

    // Clear required attributes
    hospitalSelect.removeAttribute("required");
    specialtySelect.removeAttribute("required");

    // Show relevant fields based on selected role
    if (selectedRole === "doctor") {
      roleSpecificFields.classList.remove("hidden");
      hospitalSelection.classList.remove("hidden");
      specialtySelection.classList.remove("hidden");

      // Make hospital and specialty required for doctors
      hospitalSelect.setAttribute("required", "required");
      specialtySelect.setAttribute("required", "required");
    } else if (selectedRole === "ambulance-team") {
      roleSpecificFields.classList.remove("hidden");
      hospitalSelection.classList.remove("hidden");
      teamNameField.classList.remove("hidden");

      // Make hospital required for ambulance teams
      hospitalSelect.setAttribute("required", "required");
    }
  }

  async function loadHospitals() {
    try {
      const response = await fetch("api?route=Api/Hospitals/get-hospitals");
      const data = await response.json();

      if (data.success && data.hospitals) {
        hospitalSelect.innerHTML =
          '<option value="">Choose a hospital</option>';
        data.hospitals.forEach((hospital) => {
          const option = document.createElement("option");
          option.value = hospital.hospital_id;
          option.textContent = hospital.name;
          hospitalSelect.appendChild(option);
        });
      }
    } catch (error) {
      console.error("Error loading hospitals:", error);
    }
  }

  async function loadSpecialties() {
    try {
      const response = await fetch("api?route=Api/Specialties/get-specialties");
      const data = await response.json();

      if (data.success && data.specialties) {
        specialtySelect.innerHTML =
          '<option value="">Choose a specialty</option>';
        data.specialties.forEach((specialty) => {
          const option = document.createElement("option");
          option.value = specialty.specialty_id;
          option.textContent = specialty.label_for_doctor || specialty.name;
          specialtySelect.appendChild(option);
        });
      }
    } catch (error) {
      console.error("Error loading specialties:", error);
    }
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
        `api?route=Api/Location/get-location?lat=${latitude}&lon=${longitude}`,
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
