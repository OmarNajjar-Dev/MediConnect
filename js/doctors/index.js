import { renderDoctors } from "./doctors-render.js";
import { initDoctorFilters } from "./filter-doctors.js";

document.addEventListener("DOMContentLoaded", () => {
  renderDoctors(document.getElementById("docotrs-cards-container"));
  initDoctorFilters();
  lucide.createIcons();
});
