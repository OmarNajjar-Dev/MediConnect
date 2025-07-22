export function setupEnhancedRegistration() {
  setupRoleBasedFields();
  setupGeolocationDetection();
}

function setupRoleBasedFields() {
  console.log("Setting up role-based fields...");
  const roleSelect = document.getElementById("role");
  const roleSpecificFields = document.getElementById("role-specific-fields");
  const hospitalSelection = document.getElementById("hospital-selection");
  const specialtySelection = document.getElementById("specialty-selection");
  const teamNameField = document.getElementById("team-name-field");
  const hospitalSelect = document.getElementById("hospital_id");
  const specialtySelect = document.getElementById("specialty_id");

  console.log("Elements found:", {
    roleSelect: !!roleSelect,
    roleSpecificFields: !!roleSpecificFields,
    hospitalSelection: !!hospitalSelection,
    specialtySelection: !!specialtySelection,
    teamNameField: !!teamNameField,
    hospitalSelect: !!hospitalSelect,
    specialtySelect: !!specialtySelect,
  });

  if (!roleSelect || !roleSpecificFields) {
    console.error("Required elements not found");
    return;
  }

  // Load hospitals and specialties when page loads
  console.log("Loading hospitals and specialties...");
  loadHospitals();
  loadSpecialties();

  // Listen for role changes on the select element
  roleSelect.addEventListener("change", (e) => {
    const selectedRole = e.target.value;
    console.log("Role changed to:", selectedRole);
    handleRoleChange(selectedRole);
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
      // Only show team name for ambulance team
      roleSpecificFields.classList.remove("hidden");
      teamNameField.classList.remove("hidden");
    } else if (selectedRole === "staff") {
      roleSpecificFields.classList.remove("hidden");
      hospitalSelection.classList.remove("hidden");
      // Make hospital required for staff
      hospitalSelect.setAttribute("required", "required");
    }
  }

  async function loadHospitals() {
    try {
      console.log("Loading hospitals...");
      const response = await fetch(
        "/mediconnect/backend/api/get-hospitals.php"
      );
      console.log("Hospitals response status:", response.status);
      const data = await response.json();
      console.log("Hospitals data:", data);

      // Clear existing options except the first one
      hospitalSelect.innerHTML = '<option value="">Select a hospital</option>';

      // Check if data is an array (direct response) or has a success property
      const hospitals = Array.isArray(data)
        ? data
        : data.success && data.hospitals
        ? data.hospitals
        : [];
      console.log("Processed hospitals:", hospitals);

      hospitals.forEach((hospital) => {
        const option = document.createElement("option");
        option.value = hospital.hospital_id;
        option.textContent = hospital.name;
        hospitalSelect.appendChild(option);
      });
      console.log("Hospitals loaded successfully");
    } catch (error) {
      console.error("Error loading hospitals:", error);
    }
  }

  async function loadSpecialties() {
    try {
      console.log("Loading specialties...");
      const response = await fetch(
        "/mediconnect/backend/api/get-specialties.php"
      );
      console.log("Specialties response status:", response.status);
      const data = await response.json();
      console.log("Specialties data:", data);

      // Clear existing options except the first one
      specialtySelect.innerHTML =
        '<option value="">Select a specialty</option>';

      if (data.success && data.specialties) {
        data.specialties.forEach((specialty) => {
          const option = document.createElement("option");
          option.value = specialty.specialty_id;
          option.textContent = specialty.label_for_doctor || specialty.name;
          specialtySelect.appendChild(option);
        });
        console.log("Specialties loaded successfully");
      } else {
        console.error("No specialties data found:", data);
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
        `/mediconnect/backend/api/get-location.php?lat=${latitude}&lon=${longitude}`,
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
