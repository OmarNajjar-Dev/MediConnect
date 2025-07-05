export function autoFillLocation() {
  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(
      async function (position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        try {
          const response = await fetch(`/MediConnect/backend/get-location.php?lat=${lat}&lon=${lon}`);
          const data = await response.json();

          if (data.address) {
            const city =
              data.address.city || data.address.town || data.address.village;
            if (city) {
              document.querySelector('input[name="city"]').value = city;
            }

            if (data.display_name) {
              document.querySelector('input[name="address"]').value =
                data.display_name;
            }
          }
        } catch (error) {
          console.error("Error during geolocation fetch:", error);
        }
      },
      function (error) {
        console.warn("Failed to locate:", error.message);
      }
    );
  } else {
    console.warn("Geolocation not supported.");
  }
}
