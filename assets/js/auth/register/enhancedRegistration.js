import { initDropdown } from "../../common/initDropdown.js";

export function setupEnhancedRegistration() {
  setupRoleBasedFields();
  setupGeolocationDetection();
}

function setupRoleBasedFields() {
  console.log("Patient-only registration - no role selection needed");
  // Role is hardcoded to 'Patient' for public registration
  // No role-based field logic needed
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
        `/backend/api/utils/get-location.php?lat=${latitude}&lon=${longitude}`,
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
