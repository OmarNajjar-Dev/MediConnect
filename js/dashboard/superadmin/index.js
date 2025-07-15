import { setupTabNavigation } from "./setupTabNavigation.js";
import { setupModal } from "./setupModal.js";
import { renderRoles } from "./renderRoles.js";
import { renderHospitals } from "./renderHospitals.js";
import { setupDropdowns } from "./setupDropdowns.js";

window.addEventListener("DOMContentLoaded", () => {
  setupTabNavigation();
  setupModal();
  renderRoles();
  renderHospitals();
  setupDropdowns();
});
