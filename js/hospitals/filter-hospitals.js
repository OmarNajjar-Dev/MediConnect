import { hospitalsCardsData } from "./hospitals-data.js";

let currentSearchQuery = "";
let isEmergencyActive = false;
let isBedsActive = false;

// Apply combined filters: search + emergency + beds
function applyAllFilters() {
  const cards = document.querySelectorAll(".hospital-card-wrapper");

  cards.forEach((card, index) => {
    const name = card.querySelector("h2")?.textContent.toLowerCase() || "";
    const address = card.querySelector(".text-gray-600 span")?.textContent.toLowerCase() || "";
    const hasEmergency = card.querySelector(".emergency-badge") !== null;
    const hasBeds = hospitalsCardsData[index]?.availableBeds > 0;

    const matchesSearch =
      name.includes(currentSearchQuery) || address.includes(currentSearchQuery);
    const matchesEmergency = !isEmergencyActive || hasEmergency;
    const matchesBeds = !isBedsActive || hasBeds;

    const shouldShow = matchesSearch && matchesEmergency && matchesBeds;
    card.parentElement.style.display = shouldShow ? "block" : "none";
  });

  updateNoResultsVisibility();
}

function updateNoResultsVisibility() {
  const cards = document.querySelectorAll(".hospital-card-wrapper");
  const anyVisible = Array.from(cards).some(
    (card) => card.parentElement.style.display !== "none"
  );
  document.getElementById("no-results")?.classList.toggle("hidden", anyVisible);
}

export function initHospitalFilters() {
  const searchInput = document.querySelector(".search-input");
  const emergencyBtn = document.getElementById("emergency-btn");
  const bedsBtn = document.getElementById("beds-btn");
  const clearBtn = document.getElementById("clear-filters");

  // Search input
  searchInput?.addEventListener("input", () => {
    currentSearchQuery = searchInput.value.trim().toLowerCase();
    applyAllFilters();
  });

  // Emergency toggle
  emergencyBtn?.addEventListener("click", () => {
    isEmergencyActive = !isEmergencyActive;
    toggleButtonStyle(emergencyBtn, isEmergencyActive);
    applyAllFilters();
  });

  // Beds toggle
  bedsBtn?.addEventListener("click", () => {
    isBedsActive = !isBedsActive;
    toggleButtonStyle(bedsBtn, isBedsActive);
    applyAllFilters();
  });

  // Clear filters
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
  const active = ["bg-medical-600", "text-white", "hover:bg-medical-500"];
  const inactive = [
    "bg-background",
    "text-heading",
    "hover:bg-medical-50",
    "hover:text-medical-500",
  ];

  active.forEach((cls) => button.classList.toggle(cls, isActive));
  inactive.forEach((cls) => button.classList.toggle(cls, !isActive));
}

