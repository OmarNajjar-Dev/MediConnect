// Filter doctors based on specialty selection
export function filterDoctors(specialty) {
  const cards = document.querySelectorAll(".doctor-card");
  cards.forEach((card) => {
    const cardSpecialty = card
      .querySelector(".text-medical-600")
      ?.textContent.trim()
      .toLowerCase();
    const selected = specialty.trim().toLowerCase();

    card.style.display =
      selected === "all specialties" || cardSpecialty === selected
        ? "block"
        : "none";
  });
}

// Set "All Specialties" button as active and apply default filter
function setDefaultActiveButton() {
  const allBtn = document.getElementById("all-specialties");

  allBtn?.classList.add(
    "bg-medical-500",
    "text-white",
    "border-medical-500",
    "hover:bg-medical-400"
  );
  allBtn?.classList.remove(
    "bg-background",
    "text-black",
    "hover:bg-medical-50",
    "hover:text-medical-600"
  );
  filterDoctors("All Specialties");
}

// Add click listeners to specialty buttons
function addButtonClickListeners() {
  const buttons = document.querySelectorAll(".specialty-button");

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const specialty = btn.textContent.trim();
      filterDoctors(specialty);

      buttons.forEach((b) => {
        b.classList.remove(
          "bg-medical-500",
          "text-white",
          "border-medical-500",
          "hover:bg-medical-400"
        );
        b.classList.add(
          "bg-background",
          "text-black",
          "hover:bg-medical-50",
          "hover:text-medical-600"
        );
      });

      btn.classList.add(
        "bg-medical-600",
        "text-white",
        "border-medical-500",
        "hover:bg-medical-400"
      );
      btn.classList.remove(
        "bg-background",
        "text-black",
        "hover:bg-medical-50",
        "hover:text-medical-600"
      );
    });
  });
}

// Search input filter
function searchDoctors() {
  const query = document
    .querySelector(".search-input")
    ?.value.trim()
    .toLowerCase();
  const cards = document.querySelectorAll(".doctor-card");

  cards.forEach((card) => {
    const name = card.querySelector("h2")?.textContent.toLowerCase() || "";
    const specialty =
      card.querySelector(".text-medical-600")?.textContent.toLowerCase() || "";
    const hospital =
      card.querySelector(".text-gray-600.text-sm")?.textContent.toLowerCase() ||
      "";

    card.style.display =
      name.includes(query) ||
      specialty.includes(query) ||
      hospital.includes(query)
        ? "block"
        : "none";
  });
}

// Initialize all doctor filters and search
export function initDoctorFilters() {
  setDefaultActiveButton();
  addButtonClickListeners();
  document
    .querySelector(".search-input")
    ?.addEventListener("input", searchDoctors);
}
