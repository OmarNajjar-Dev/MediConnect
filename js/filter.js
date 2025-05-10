// Filter function
function filterDoctors(specialty) {
  const cards = document.querySelectorAll(".doctor-card");
  cards.forEach((card) => {
    const cardSpecialty = card
      .querySelector(".text-medical-600")
      .textContent.trim()
      .toLowerCase();
    const selectedSpecialty = specialty.trim().toLowerCase();

    if (
      selectedSpecialty === "all specialties" ||
      cardSpecialty === selectedSpecialty
    ) {
      card.style.display = "block"; // Show the card
    } else {
      card.style.display = "none"; // Hide the card
    }
  });
}

// Set "All Specialties" button as active by default on page load
function setDefaultActiveButton() {
  const allSpecialtiesButton = document.getElementById("all-specialties");
  if (allSpecialtiesButton) {
    allSpecialtiesButton.classList.add(
      "bg-medical-500",
      "text-white",
      "border-medical-500",
      "hover:bg-medical-400"
    );
    allSpecialtiesButton.classList.remove(
      "bg-background",
      "text-black",
      "hover:bg-medical-50",
      "hover:text-medical-600"
    );
    filterDoctors("All Specialties"); // Show all doctors by default
  }
}

// Add event listeners to the specialty buttons
function addButtonClickListeners() {
  const specialtyButtons = document.querySelectorAll(".specialty-button");

  specialtyButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const specialty = button.textContent.trim(); // Get the button text
      filterDoctors(specialty); // Call filterDoctors with the selected specialty

      // Remove active styles from all buttons
      specialtyButtons.forEach((btn) => {
        btn.classList.remove(
          "bg-medical-500",
          "text-white",
          "border-medical-500",
          "hover:bg-medical-400"
        );
        btn.classList.add(
          "bg-background",
          "text-black",
          "hover:bg-medical-50",
          "hover:text-medical-600"
        );
      });

      // Add active styles to the clicked button
      button.classList.add(
        "bg-medical-600",
        "text-white",
        "border-medical-500",
        "hover:bg-medical-400"
      );
      button.classList.remove(
        "bg-background",
        "text-black",
        "hover:bg-medical-50",
        "hover:text-medical-600"
      );
    });
  });
}

// Run the functions when DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
  setDefaultActiveButton(); // Set the default active button
  addButtonClickListeners(); // Attach the event listeners to buttons
});

// INPUT SEARCH FILTER FUNCTION
function searchDoctors() {
  const input = document.getElementById("search-input");
  const query = input.value.trim().toLowerCase();

  const cards = document.querySelectorAll(".doctor-card");

  cards.forEach((card) => {
    const name = card.querySelector("h2").textContent.toLowerCase();
    const specialty = card
      .querySelector(".text-medical-600")
      .textContent.toLowerCase();
    const hospital = card
      .querySelector(".text-gray-600.text-sm")
      .textContent.toLowerCase();

    if (
      name.includes(query) ||
      specialty.includes(query) ||
      hospital.includes(query)
    ) {
      card.style.display = "block";
    } else {
      card.style.display = "none";
    }
  });
}
document
  .getElementById("search-input")
  .addEventListener("input", searchDoctors);
