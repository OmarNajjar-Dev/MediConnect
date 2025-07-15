// Exported function to automatically fill location fields using Geolocation API
export async function autoFillLocation() {
  // Get input fields for city and full address
  const cityInput = document.getElementById('city');
  const addressInput = document.getElementById('address');

  // Check if the browser supports geolocation
  if (!("geolocation" in navigator)) {
    console.warn("This browser does not support geolocation.");
    return;
  }

  try {
    // Get the user's current position with high accuracy
    const position = await getCurrentPosition({ enableHighAccuracy: true });
    const { latitude: lat, longitude: lon } = position.coords;

    // Call backend API to reverse geocode the coordinates
    const response = await fetch(
      `/MediConnect/backend/api/get-location.php?lat=${lat}&lon=${lon}`
    );

    // Check if the response is OK (status 200)
    if (!response.ok) {
      throw new Error("Failed to fetch location data");
    }

    // Parse the response JSON
    const data = await response.json();

    // Check if address data exists
    if (data?.address) {
      // Extract the city from available fields (fallback options included)
      const city =
        data.address.city ||
        data.address.town ||
        data.address.village ||
        data.address.county;

      // Set the city input field if it exists
      if (cityInput && city) {
        cityInput.value = city;
      }

      // Set the full address if display_name is available
      if (addressInput && data.display_name) {
        addressInput.value = data.display_name;
      }
    } else {
      console.warn("No address data found in response.");
    }

  } catch (error) {
    // Handle any errors (e.g., permission denied, API error)
    console.error("Error getting location:", error.message);
  }
}

// Helper function to convert getCurrentPosition to a Promise-based format
function getCurrentPosition(options = {}) {
  return new Promise((resolve, reject) => {
    navigator.geolocation.getCurrentPosition(resolve, reject, options);
  });
}
