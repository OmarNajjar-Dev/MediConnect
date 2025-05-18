import { hospitalsCardsData } from "./hospitals-data.js";

// Search filter by name or address
export function filterBySearch(query) {
  const cards = document.querySelectorAll(".hospital-card-wrapper");
  cards.forEach((card) => {
    const name = card.querySelector("h2").textContent.toLowerCase();
    const address = card
      .querySelector(".text-gray-600 span")
      .textContent.toLowerCase();
    card.parentElement.style.display =
      name.includes(query) || address.includes(query) ? "block" : "none";
  });
  updateNoResultsVisibility();
}

// Toggle emergency filter
export function filterByEmergency(active) {
  const cards = document.querySelectorAll(".hospital-card-wrapper");
  cards.forEach((card) => {
    const hasEmergency = card.getElementById("emergency") !== null;
    card.parentElement.style.display =
      active && !hasEmergency ? "none" : "block";
  });
  updateNoResultsVisibility();
}

// Toggle beds filter
export function filterByBeds(active) {
  const cards = document.querySelectorAll(".hospital-card-wrapper");
  cards.forEach((card, index) => {
    const hasBeds = hospitalsCardsData[index].availableBeds > 0;
    card.parentElement.style.display = active && !hasBeds ? "none" : "block";
  });
  updateNoResultsVisibility();
}

// Initialize filters
export function initHospitalFilters() {
  const searchInput = document.getElementById("search-input");
  let emergencyActive = false;
  let bedsActive = false;

  // Search
  searchInput.addEventListener("input", () => {
    filterBySearch(searchInput.value.trim().toLowerCase());
  });

  // Emergency
  const emergencyBtn = document.getElementById("emergency-btn");
  emergencyBtn.addEventListener("click", () => {
    emergencyActive = !emergencyActive;
    emergencyBtn.classList.toggle("bg-medical-600");
    emergencyBtn.classList.toggle("text-white");
    emergencyBtn.classList.toggle("hover:bg-medical-500");
    emergencyBtn.classList.toggle("bg-background");
    emergencyBtn.classList.toggle("text-heading");
    emergencyBtn.classList.toggle("hover:bg-medical-50");
    emergencyBtn.classList.toggle("hover:text-medical-500");
    filterByEmergency(emergencyActive);
  });

  // Available Beds
  const bedsBtn = document.getElementById("beds-btn");
  bedsBtn.addEventListener("click", () => {
    bedsActive = !bedsActive;
    bedsBtn.classList.toggle("bg-medical-600");
    bedsBtn.classList.toggle("text-white");
    bedsBtn.classList.toggle("hover:bg-medical-500");
    bedsBtn.classList.toggle("bg-background");
    bedsBtn.classList.toggle("text-heading");
    bedsBtn.classList.toggle("hover:bg-medical-50");
    bedsBtn.classList.toggle("hover:text-medical-500");
    filterByBeds(bedsActive);
  });
}
function updateNoResultsVisibility() {
  const cards = document.querySelectorAll(".hospital-card-wrapper");
  const anyVisible = Array.from(cards).some((card) => card.parentElement.style.display !== "none");
  document.getElementById("no-results").classList.toggle("hidden", anyVisible);
}
document.addEventListener("DOMContentLoaded", () => {
  const clearBtn = document.getElementById("clear-filters");

  if (clearBtn) {
    clearBtn.addEventListener("click", () => {
      document.getElementById("search-input").value = "";
      filterBySearch("");
      filterByEmergency(false);
      filterByBeds(false);
      updateNoResultsVisibility?.(); // Optional chaining in case the function isn't defined
    });
  }
});

