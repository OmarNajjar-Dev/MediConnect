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
      card.querySelector(".hospital-address")?.textContent.toLowerCase() ||
      "";

    const matchesSearch =
      name.includes(currentSearchQuery) || address.includes(currentSearchQuery);

    card.parentElement.style.display = matchesSearch ? "block" : "none";
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
