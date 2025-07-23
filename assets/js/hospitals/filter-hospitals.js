import { updateNoResultsVisibility } from "../utils/updataNoResultsVisibility.js";

let currentSearchQuery = "";
let isEmergencyActive = false;
let isBedsActive = false;

function applyAllFilters() {
  const cards = document.querySelectorAll(".hospital-card-wrapper");

  cards.forEach((card) => {
    const name =
      card.querySelector(".hospital-name")?.textContent.toLowerCase() || "";
    const address =
      card.querySelector(".hospital-address")?.textContent.toLowerCase() || "";

    // Check for emergency services
    const hasEmergencyServices =
      card.querySelector(".emergency-badge") !== null;

    // Check for available beds
    const bedElement = card.querySelector(".bed-icon");
    const hasAvailableBeds = bedElement !== null;

    // Apply search filter
    const matchesSearch =
      name.includes(currentSearchQuery) || address.includes(currentSearchQuery);

    // Apply emergency filter
    const matchesEmergency = !isEmergencyActive || hasEmergencyServices;

    // Apply beds filter
    const matchesBeds = !isBedsActive || hasAvailableBeds;

    // Show card only if it matches all active filters
    const shouldShow = matchesSearch && matchesEmergency && matchesBeds;
    card.parentElement.style.display = shouldShow ? "block" : "none";
  });

  updateNoResultsVisibility(
    document.querySelectorAll(".hospital-card-wrapper"),
    document.querySelector(".no-results")
  );
}

export function initHospitalFilters() {
  const searchInput = document.querySelector(".search-input");
  const emergencyBtn = document.getElementById("emergency-btn");
  const bedsBtn = document.getElementById("beds-btn");
  const clearBtn = document.querySelector(".clear-filters");

  searchInput?.addEventListener("input", () => {
    currentSearchQuery = searchInput.value.trim().toLowerCase();
    applyAllFilters();
  });

  emergencyBtn?.addEventListener("click", () => {
    isEmergencyActive = !isEmergencyActive;
    toggleButtonStyle(emergencyBtn, isEmergencyActive);
    applyAllFilters();
  });

  bedsBtn?.addEventListener("click", () => {
    isBedsActive = !isBedsActive;
    toggleButtonStyle(bedsBtn, isBedsActive);
    applyAllFilters();
  });

  clearBtn?.addEventListener("click", () => {
    searchInput.value = "";
    currentSearchQuery = "";
    isEmergencyActive = false;
    isBedsActive = false;

    toggleButtonStyle(emergencyBtn, false);
    toggleButtonStyle(bedsBtn, false);

    applyAllFilters();
  });
}

function toggleButtonStyle(button, isActive) {
  if (isActive) {
    // Active state
    button.classList.remove(
      "bg-background",
      "text-heading",
      "hover:bg-medical-50",
      "hover:text-medical-500"
    );
    button.classList.add("bg-primary", "text-white", "hover:bg-medical-600");
  } else {
    // Inactive state
    button.classList.remove("bg-primary", "text-white", "hover:bg-medical-600");
    button.classList.add(
      "bg-background",
      "text-heading",
      "hover:bg-medical-50",
      "hover:text-medical-500"
    );
  }
}
