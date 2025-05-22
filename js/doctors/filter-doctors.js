// Import the utility function to toggle visibility of the "no results" message
import { updateNoResultsVisibility } from "../utils/updataNoResultsVisibility.js";

// Global state variables
let currentSpecialty = "all specialties";
let currentSearchQuery = "";

/**
 * Apply combined filters: search text + selected specialty
 */
function applyDoctorFilters() {
  const cards = document.querySelectorAll(".doctor-card-wrapper");

  cards.forEach((card) => {
    // Extract card content
    const name = card.querySelector("h2")?.textContent.toLowerCase() || "";
    const specialty =
      card.querySelector(".text-medical-600")?.textContent.toLowerCase() || "";
    const hospital =
      card.querySelector(".text-gray-600.text-sm")?.textContent.toLowerCase() ||
      "";

    // Check if search input matches any of the fields
    const matchesSearch =
      name.includes(currentSearchQuery) ||
      specialty.includes(currentSearchQuery) ||
      hospital.includes(currentSearchQuery);

    // Check if the card matches the selected specialty
    const matchesSpecialty =
      currentSpecialty === "all specialties" || specialty === currentSpecialty;

    // Show or hide the card based on filters
    const shouldShow = matchesSearch && matchesSpecialty;
    card.style.display = shouldShow ? "block" : "none";
  });

  // Update the visibility of the "no results" message
  updateNoResultsVisibility(
    document.querySelectorAll(".doctor-card-wrapper"),
    document.querySelector(".no-results")
  );
}

/**
 * Handle specialty button click: update state and style
 */
function handleSpecialtyClick(btn, buttons) {
  currentSpecialty = btn.textContent.trim().toLowerCase();

  // Reset styles for all buttons
  buttons.forEach((b) => toggleButtonStyle(b, false));

  // Activate the clicked button
  toggleButtonStyle(btn, true);

  // Apply filters after selection
  applyDoctorFilters();
}

/**
 * Toggle button appearance (active/inactive)
 */
function toggleButtonStyle(button, isActive) {
  const active = [
    "bg-medical-600",
    "text-white",
    "border-medical-500",
    "hover:bg-medical-400",
  ];
  const inactive = [
    "bg-background",
    "text-black",
    "hover:bg-medical-50",
    "hover:text-medical-600",
  ];

  active.forEach((cls) => button.classList.toggle(cls, isActive));
  inactive.forEach((cls) => button.classList.toggle(cls, !isActive));
}

/**
 * Initialize all filters and event listeners
 */
export function initDoctorFilters() {
  const searchInput = document.querySelector(".search-input");
  const allSpecialtyBtn = document.getElementById("all-specialties");
  const buttons = document.querySelectorAll(".specialty-button");

  // Set default specialty and style
  currentSpecialty = "all specialties";
  toggleButtonStyle(allSpecialtyBtn, true);

  // Add click listeners to each specialty button
  buttons.forEach((btn) => {
    btn.addEventListener("click", () => handleSpecialtyClick(btn, buttons));
  });

  // Search input event listener
  searchInput?.addEventListener("input", () => {
    currentSearchQuery = searchInput.value.trim().toLowerCase();
    applyDoctorFilters();
  });

  // Clear filters button functionality
  const clearBtn = document.querySelector(".clear-filters");
  clearBtn?.addEventListener("click", () => {
    // Reset inputs and filters
    document.querySelector(".search-input").value = "";
    currentSearchQuery = "";
    currentSpecialty = "all specialties";

    // Reset button styles
    document.querySelectorAll(".specialty-button").forEach((btn) => {
      toggleButtonStyle(btn, false);
    });
    toggleButtonStyle(document.getElementById("all-specialties"), true);

    // Re-apply filters to show all cards
    applyDoctorFilters();
  });

  // Initial filter application on page load
  applyDoctorFilters();
}
