import { renderDoctors } from "./renderDoctors.js";
import { initDoctorFilters } from "./filter-doctors.js";

document.addEventListener("DOMContentLoaded", () => {
  renderDoctors(document.getElementById("doctors-cards-container"));
  initDoctorFilters();
});
