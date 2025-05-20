import { renderHospitals } from "./hospitals-render.js";
import { initHospitalFilters } from "./filter-hospitals.js";

document.addEventListener("DOMContentLoaded", () => {
  renderHospitals(document.getElementById("hospitals-cards-container"));
  initHospitalFilters();
  lucide.createIcons();
});
