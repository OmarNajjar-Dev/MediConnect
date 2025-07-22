import { renderHospitals } from "./renderHospitals.js";
import { initHospitalFilters } from "./filter-hospitals.js";

window.addEventListener("DOMContentLoaded", () => {
  renderHospitals(document.getElementById("hospitals-cards-container"));
  initHospitalFilters();
});
