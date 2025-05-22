// Import hospital data and the utility function for showing/hiding the "no results" message
import { hospitalsCardsData } from "./hospitals-data.js";
import { updateNoResultsVisibility } from "../utils/updataNoResultsVisibility.js";

// Global state variables
let currentSearchQuery = "";
let isEmergencyActive = false;
let isBedsActive = false;

/**
 * Apply combined filters: search text + emergency availability + bed availability
 */
function applyAllFilters() {
  const cards = document.querySelectorAll(".hospital-card-wrapper");

  cards.forEach((card, index) => {
    // Extract data from card
    const name = card.querySelector("h2")?.textContent.toLowerCase() || "";
    const address =
      card.querySelector(".text-gray-600 span")?.textContent.toLowerCase() ||
      "";
    const hasEmergency = card.querySelector(".emergency-badge") !== null;
    const hasBeds = hospitalsCardsData[index]?.availableBeds > 0;

    // Check if the card matches the active filters
    const matchesSearch =
      name.includes(currentSearchQuery) || address.includes(currentSearchQuery);
    const matchesEmergency = !isEmergencyActive || hasEmergency;
    const matchesBeds = !isBedsActive || hasBeds;

    const shouldShow = matchesSearch && matchesEmergency && matchesBeds;

    // Show or hide the card based on filter result
    card.parentElement.style.display = shouldShow ? "block" : "none";
  });

  // Toggle visibility of the "no results" message
  updateNoResultsVisibility(
    document.querySelectorAll(".hospital-card-wrapper"),
    document.querySelector(".no-results")
  );
}

/**
 * Initialize filter functionality and event listeners
 */
export function initHospitalFilters() {
  const searchInput = document.querySelector(".search-input");
  const emergencyBtn = document.getElementById("emergency-btn");
  const bedsBtn = document.getElementById("beds-btn");
  const clearBtn = document.querySelector(".clear-filters");

  // Handle search input
  searchInput?.addEventListener("input", () => {
    currentSearchQuery = searchInput.value.trim().toLowerCase();
    applyAllFilters();
  });

  // Handle emergency filter toggle
  emergencyBtn?.addEventListener("click", () => {
    isEmergencyActive = !isEmergencyActive;
    toggleButtonStyle(emergencyBtn, isEmergencyActive);
    applyAllFilters();
  });

  // Handle beds filter toggle
  bedsBtn?.addEventListener("click", () => {
    isBedsActive = !isBedsActive;
    toggleButtonStyle(bedsBtn, isBedsActive);
    applyAllFilters();
  });

  // Handle "Clear Filters" button
  clearBtn?.addEventListener("click", () => {
    searchInput.value = "";
    currentSearchQuery = "";
    isEmergencyActive = false;
    isBedsActive = false;

    // Reset button styles
    toggleButtonStyle(emergencyBtn, false);
    toggleButtonStyle(bedsBtn, false);

    // Re-apply filters to show all cards
    applyAllFilters();
  });
}

/**
 * Apply visual styles to active/inactive filter buttons
 */
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
