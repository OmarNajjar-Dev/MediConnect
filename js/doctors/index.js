import "../common/header.js";
import "../common/mobile-nav.js";
import { renderDoctors } from "./doctors-render.js";
import { initDoctorFilters } from "./filter.js";

document.addEventListener("DOMContentLoaded", () => {
  renderDoctors(document.getElementById("doctor-cards-container"));
  initDoctorFilters();
  lucide.createIcons();
});
