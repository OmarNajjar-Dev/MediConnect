/**
 * Simple Geolocation Auto-Fill System for MediConnect
 * Uses OpenCage API only - simple and reliable
 */

// Exported function to automatically fill location fields
export async function autoFillLocation() {
  // Get input fields for city and address
  const cityInput = document.getElementById("city");
  const addressInput = document.getElementById("address");

  // Show simple loading indicator
  const loadingIndicator = showLoadingIndicator();

  // Add loading state to input fields
  showInputLoadingState(cityInput, addressInput);

  // Check if the browser supports geolocation
  if (!("geolocation" in navigator)) {
    console.warn("This browser does not support geolocation.");
    showLocationError("Geolocation is not supported by this browser.");
    hideLoadingIndicator(loadingIndicator);
    return;
  }

  try {
    // Get the user's current position
    const position = await getCurrentPosition({
      enableHighAccuracy: true,
      timeout: 10000,
      maximumAge: 300000, // 5 minutes cache
    });

    const { latitude: lat, longitude: lon } = position.coords;

    console.log(`Getting location for coordinates: ${lat}, ${lon}`);

    // Call simple backend API
    const response = await fetch(
      `/mediconnect/backend/api/get-location.php?lat=${lat}&lon=${lon}`,
      {
        method: "GET",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
      }
    );

    // Check if the response is OK
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}: Failed to get location`);
    }

    // Parse the response JSON
    const data = await response.json();

    // Handle API errors
    if (!data.success || data.error) {
      throw new Error(data.message || data.error || "Unknown API error");
    }

    // Fill form fields
    if (cityInput && data.city) {
      cityInput.value = data.city;
      cityInput.classList.add("location-filled");
    }

    if (addressInput && data.clean_address) {
      addressInput.value = data.clean_address;
      addressInput.classList.add("location-filled");
    }

    // Show success message
    showLocationSuccess();

    console.log("Location auto-filled successfully:", {
      city: data.city,
      address: data.clean_address,
    });
  } catch (error) {
    console.error("Location detection failed:", error);
    showLocationError("Unable to detect location.");
  } finally {
    // Always hide loading indicator
    hideLoadingIndicator(loadingIndicator);

    // Remove loading state from input fields
    hideInputLoadingState(cityInput, addressInput);
  }
}

/**
 * Simple getCurrentPosition with Promise support
 */
function getCurrentPosition(options = {}) {
  return new Promise((resolve, reject) => {
    navigator.geolocation.getCurrentPosition(resolve, reject, options);
  });
}

/**
 * Show simple loading indicator
 */
function showLoadingIndicator() {
  const indicator = document.createElement("div");
  indicator.id = "location-loading";
  indicator.innerHTML = `<span>Detecting your location...</span>`;

  // Insert near the form fields
  const cityInput = document.getElementById("city");
  if (cityInput && cityInput.parentNode) {
    cityInput.parentNode.insertBefore(indicator, cityInput.nextSibling);
  }

  return indicator;
}

/**
 * Hide loading indicator
 */
function hideLoadingIndicator(indicator) {
  if (indicator && indicator.parentNode) {
    indicator.parentNode.removeChild(indicator);
  }
}

/**
 * Show loading state on input fields
 */
function showInputLoadingState(cityInput, addressInput) {
  if (cityInput) {
    cityInput.classList.add("location-loading-input");
    cityInput.placeholder = "Detecting location...";
  }
  if (addressInput) {
    addressInput.classList.add("location-loading-input");
    addressInput.placeholder = "Detecting address...";
  }
}

/**
 * Hide loading state from input fields
 */
function hideInputLoadingState(cityInput, addressInput) {
  if (cityInput) {
    cityInput.classList.remove("location-loading-input");
    cityInput.placeholder = "Enter your city";
  }
  if (addressInput) {
    addressInput.classList.remove("location-loading-input");
    addressInput.placeholder = "Enter your address";
  }
}

/**
 * Show simple success message
 */
function showLocationSuccess() {
  showMessage("Location detected successfully!", "success");
}

/**
 * Show simple error message
 */
function showLocationError(message) {
  showMessage(message, "error");
}

/**
 * Simple message display function
 */
function showMessage(message, type) {
  // Remove existing message
  const existingMessage = document.getElementById("location-message");
  if (existingMessage) {
    existingMessage.remove();
  }

  const messageDiv = document.createElement("div");
  messageDiv.id = "location-message";
  messageDiv.className = type; // Add CSS class for styling
  messageDiv.innerHTML = message;

  // Insert near the form fields
  const cityInput = document.getElementById("city");
  if (cityInput && cityInput.parentNode) {
    cityInput.parentNode.insertBefore(messageDiv, cityInput.nextSibling);
  }

  // Auto-remove after 4 seconds
  setTimeout(() => {
    if (messageDiv.parentNode) {
      messageDiv.parentNode.removeChild(messageDiv);
    }
  }, 4000);
}

/**
 * Get stored location data if available
 */
export function getStoredLocationData() {
  try {
    const stored = sessionStorage.getItem("user_location");
    return stored ? JSON.parse(stored) : null;
  } catch (e) {
    console.warn("Could not retrieve stored location data:", e.message);
    return null;
  }
}

/**
 * Clear stored location data
 */
export function clearStoredLocationData() {
  try {
    sessionStorage.removeItem("user_location");
    console.log("Stored location data cleared");
  } catch (e) {
    console.warn("Could not clear stored location data:", e.message);
  }
}

/**
 * Get location data ready for database storage
 */
export function getLocationForStorage() {
  const stored = getStoredLocationData();
  if (stored && stored.city) {
    return {
      city: stored.city,
      address: stored.clean_address || stored.city,
    };
  }
  return null;
}
