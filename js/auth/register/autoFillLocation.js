export function autoFillLocation() {
  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(
      async function (position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        try {
          const response = await fetch(
            `/MediConnect/backend/api/get-location.php?lat=${lat}&lon=${lon}`
          );
          const data = await response.json();

          if (data.address) {
            const city =
              data.address.city || data.address.town || data.address.village;
            const cityInput = document.querySelector('input[name="city"]');
            const addressInput = document.querySelector(
              'input[name="address"]'
            );

            if (cityInput && city) {
              cityInput.value = city;
            }

            if (addressInput && data.display_name) {
              addressInput.value = data.display_name;
            }
          }
        } catch (error) {
          console.error("Error during geolocation fetch:", error);
        }
      },
      function (error) {
        console.log("Failed to locate:", error.message);
      }
    );
  } else {
    console.log("The browser does not support geolocation.");
  }
}
