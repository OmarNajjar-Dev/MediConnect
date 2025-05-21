export function showAlert(message, type = "success") {
  const alertBox = document.getElementById("form-alert");

  // Set message and background color
  alertBox.textContent = message;
  alertBox.className =
    "mt-4 p-4 text-sm rounded-md transition-opacity duration-500";
  alertBox.classList.add("bg-green-600", "text-white"); // for success

  if (type === "error") {
    alertBox.classList.remove("bg-green-600");
    alertBox.classList.add("bg-red-600");
  }

  // Show alert
  alertBox.classList.remove("hidden");
  alertBox.style.opacity = "1";

  // Hide after 3 seconds
  setTimeout(() => {
    alertBox.style.opacity = "0";
    setTimeout(() => {
      alertBox.classList.add("hidden");
    }, 500); // Wait for transition to complete
  }, 3000);
}